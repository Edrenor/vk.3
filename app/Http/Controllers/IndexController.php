<?php

namespace App\Http\Controllers;

use App\Domain\Material\Queries\MaterialListByPosId;
use App\Domain\Post\Commands\PostCreateCommand;
use App\Domain\Post\Queries\PostByPosIdAndOwnerIdQuery;
use App\Domain\StopWord\Queries\StopWordsByOwnersId;
use Illuminate\Support\Facades\Auth;

//имена моделей, с которыми можно работать

/**
 * Class IndexController
 *
 * @package App\Http\Controllers
 */
class IndexController extends Controller
{

    /**
     * @var array|false|null|string
     */
    var $token = null;
    /**
     * @var array|false|null|string
     */
    var $TelegramToken = null;
    /**
     * @var array|false|null|string
     */
    var $apiVersion = null;

    //проверка git
    /**
     * @var string
     */
    var $count = "10";
    /**
     * @var array
     */
    var $domains = [
        'bestad',
        'igm',
        'igromania',
        'vinevinevine',
        'leprum',
        'mudakoff',
    ];   // 'videosos', 'vinevinevine', 'bestad', 'igm','mrzlk', 'countryballs_re', 'leprum', 'mudakoff',

    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->TelegramToken = getenv('TelegramToken');
        $this->token = getenv('VkToken');
        $this->apiVersion = getenv('ApiVkVersion');
    }

    /** ФУНКЦИЯ ЗАПРОСА К API ВКОНТАКТЕ
     *
     * @param $method
     * @param $params
     *
     * @return mixed
     */
    function getInfo($method, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,
            CURLOPT_URL,
            "https://api.vk.com/method/" . $method . "?" . $params . "&access_token=$this->token&v=$this->apiVersion"
        );
        $result = curl_exec($ch);
        curl_close($ch);

        //echo ("https://api.vk.com/method/" . $method . "?".$params."&access_token=$this->token&v=$this->apiVersion<br>");
        return $info = json_decode($result, true);
    }

    /** ПОЛУЧЕНИЕ МАССИВА ДЛЯ ПРЕДСТАВЛЕНИЯ
     *
     * @return array
     */
    function getArray()
    {
        $outputArray = [];

        $yesterdayDate = new \DateTime();
        $yesterdayDate->add(\DateInterval::createFromDateString('yesterday'));

        foreach ($this->domains as $domain) {
            $response = $this->getInfo("wall.get", "domain=$domain&count=$this->count");
            if(! isset($response["response"]["items"])){
                dd($response);
            }
            foreach ($response["response"]["items"] as $items) {

                if ($this->postValidation($items)) {
//                    echo 'Пост подходит<br>';
                    $array = [];
                    $array["attachments"] = [];

                    $array['date'] = date('Y-m-d H:i:s', $items["date"]);
                    $array['post_id'] = $items["id"];
                    $array['owner_id'] = $items["owner_id"];
                    $array['text'] = $items['text'];
                    $post = $this->dispatch(new PostByPosIdAndOwnerIdQuery($array['post_id'], $array['owner_id']));
                    if ($post == null) {
                        foreach ($items["attachments"] as $attachments) {
                            $attachment = null;
                            switch ($attachments["type"]) {
                                case "photo":
                                    $attachment = $this->photoAttachment($attachments);
                                    break;
                                case "video":
                                    $attachment = $this->videoAttachment($attachments);
//                                    dump($attachment);
                                    sleep(1);
                                    break;
                                case "doc":
                                    $attachment = $this->docAttachment($attachments);
                                    break;
                            }
                            if ($attachment) {
                                $array["attachments"][] = $attachment;
                            }
                        }
                        $this->dispatch(new PostCreateCommand(null,
                                $array['owner_id'],
                                $array['post_id'],
                                $array['date'],
                                $array['text'],
                                $array['attachments']
                            )
                        );

                        $outputArray[date('Y-m-d H:i:s', $items["date"])] = $this->output($array);
                    }
                    else {
                        $outputArray[date('Y-m-d H:i:s', $items["date"])] = $this->output($array);
                    }
                }
//                else {
//                    echo 'Пост не подходит<br>';
//                    dump($items);
//                }
            }
        }
        krsort($outputArray);
//        dump($outputArray);
        return $outputArray;
    }

    public function postValidation($post)
    {
//        dump($post);
        $stopWordsCollection = $this->dispatch(new StopWordsByOwnersId($post["owner_id"]));
//        dump($stopWordsCollection);
        if ( !empty($stopWordsCollection) ) {
            echo empty($stopWordsCollection);
            $stopWordsArray = unserialize($stopWordsCollection->stopWords);
            foreach ($stopWordsArray as $stopWord) {
                if (stripos($post['text'], $stopWord)) {
//                    echo 'stopWord in the text';
                }
                else {
                    if($this->postScreening($post)){
                        return true;
                    }
                }
            }
        }
        else {
//            echo 'no stopWordCollection';
            if($this->postScreening($post)){
                return true;
            }
        }

    }

    public function postScreening($post){
        if (array_key_exists("attachments", $post)) {
            if ($post["date"] >= date('U') - 86400) {
                foreach ($post['attachments'] as $attachment) {
                    if (!array_key_exists("link", $attachment)) {
                        return true;
                    }
//                    else {
//                        echo 'link in attachment';
//                    }
                }
            }
//            else {
//                echo 'wrong date';
//            }
        }
//        else {
//            echo 'no attachments in the post';
//        }
    }

    public function photoAttachment($item)
    {
        $subArray["type"] = "photo";
        $subArray["url"] = $item["photo"]["photo_604"];

        return $subArray;
    }

    public function docAttachment($item)
    {
        $subArray = [];
        $subArray["type"] = "doc";
        $subArray["url"] = $item["doc"]["url"];

        return $subArray;
    }

    public function videoAttachment($item) //todo придумать что можно сделать с видео
    {
        $videoResponse = $this->getInfo('video.get',
            'owner_id=' . $item['video']['owner_id'] . '&videos=' . $item['video']['owner_id'] . '_'
            . $item['video']['id'] . ''
        );
//        dump($videoResponse);


        if (array_key_exists("response", $videoResponse)) {
            $subArray = [];
            $subArray["type"] = "video";
            $subArray["url"] = $videoResponse["response"]["items"]["0"]["player"];
            return $subArray;
        }

    }

    /** СОЗДАНИЕ МАССИВА ИЗ ВЛОЖЕНИЙ
     *
     * @param $item
     *
     * @return array
     */
    function output($item)
    {
        $outputArray = [];
        $post_info = $this->dispatch(new PostByPosIdAndOwnerIdQuery($item['post_id'], $item['owner_id']));

        $outputArray['date'] = $post_info->created_at;
        $outputArray['id'] = $post_info->id;
        $outputArray['owner'] = $post_info->owner_id;
        $outputArray['text'] = $post_info->text;

        $info = $this->dispatch(new MaterialListByPosId($post_info->id));
//        dump($info);
        foreach ($info as $array) {
            $subArray = [];
            $subArray['type'] = $array->type;
            $subArray['url'] = $array->link;
            $outputArray["attachments"][] = $subArray;
        }

        return $outputArray;
    }

    /** ПРОВЕРКА НА ПРИСУТСТВИЕ В БД
     *
     * @param $item
     *
     * @return bool
     */
    function check($item)
    {
        $select = $this->dispatch(new PostByPosIdAndOwnerIdQuery($item['post_id'], $item['owner_id']));

        if ($select) {
            return false;
        }

        return true;
    }

    /** ПРЕДСТАВЛЕНИЕ
     *
     * @return $this
     */
    public function index()
    {
        $array = $this->getArray();

        return view('entryPoint', compact('array'));
    }
}
