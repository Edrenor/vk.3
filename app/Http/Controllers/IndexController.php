<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//имена моделей, с которыми можно работать
use App\Post;
use App\Material;

class IndexController extends Controller
{
    //проверка git
    var $count = "50";
    var $token = "e24083c01eb68fb4eac1540128ff9bcf180cbbb01f2f790bbbf4331e83f05661f9ab60faddd5186b5ffb4";
    var $apiVersion = "5.52";
    var $domains = array('igromania', 'vinevinevine', 'bestad', 'igm', 'mrzlk', 'countryballs_re');   // 'vinevinevine', 'bestad', 'igm','mrzlk', 'countryballs_re'

    



//ФУНКЦИЯ ЗАПРОСА К API ВКОНТАКТЕ
    function getInfo($method, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "https://api.vk.com/method/" . $method . "?" . $params . "&access_token=$this->token&v=$this->apiVersion");
        $result = curl_exec($ch);
        curl_close($ch);
        //echo ("https://api.vk.com/method/" . $method . "?".$params."&access_token=$this->token&v=$this->apiVersion<br>");
        return $info = json_decode($result, true);
    }

//ПОЛУЧЕНИЕ МАССИВА ДЛЯ ПРЕДСТАВЛЕНИЯ
    function getArray()
    {

        $outputArray = array();


        $yesterdayDate = new \DateTime();
        $yesterdayDate->add(\DateInterval::createFromDateString('yesterday'));


        foreach ($this->domains as $domain) {
            $response = $this->getInfo("wall.get", "domain=$domain&count=$this->count");

            foreach ($response["response"]["items"] as $items) {
                $array = array();
                if (date('F j, Y', $items["date"]) == $yesterdayDate->format('F j, Y')) {
                    //dump($items);
                    if ($this->check($items)) {


                        if (array_key_exists("attachments", $items)) {

                            $itemLength = count($items['attachments']);

                            if ($itemLength = '1' && array_key_exists("link", $items['attachments']['0'])) {
                            } else {
                                foreach ($items["attachments"] as $attachments) {
                                    $array['date'] = date('Y-m-d H:i:s', $items["date"]);
                                    $array['id'] = $items["id"];
                                    $array['owner_id'] = $items["owner_id"];
                                    $array['text'] = $items['text'];
                                    if ($attachments["type"] == "photo") {
                                        $subArray = array();
                                        $subArray["type"] = "photo";
                                        $subArray["url"] = $attachments["photo"]["photo_604"];
                                        $array["attachments"][] = $subArray;
                                    }
                                    if ($attachments["type"] == "video") {
                                        $videoResponse = $this->getInfo('video.get', 'owner_id=' . $attachments['video']['owner_id'] . '&videos=' . $attachments['video']['owner_id'] . '_' . $attachments['video']['id'] . '');

                                        if (array_key_exists("response", $videoResponse)) {
                                            $subArray = array();
                                            $subArray["type"] = "video";
                                            $subArray["url"] = $videoResponse["response"]["items"]["0"]["player"];
                                            $array["attachments"][] = $subArray;
                                            sleep(1);
                                        }


                                    }
                                    if ($attachments["type"] == "doc") {
                                        $subArray = array();
                                        $subArray["type"] = "doc";
                                        $subArray["url"] = $attachments["doc"]["url"];
                                        $array["attachments"][] = $subArray;
                                    }
                                }
                                $this->insert($array);
                                //$outputArray[$array['date']] = $array;
                                $outputArray[date('Y-m-d H:i:s', $items["date"])] = $this->output($items);
                            }

                        }
                    } else {
                        $outputArray[date('Y-m-d H:i:s', $items["date"])] = $this->output($items);
                    }
                }
            }
        }
        krsort($outputArray);
        //dump($outputArray);
        return $outputArray;
    }


//СОЗДАНИЕ МАССИВА ИЗ ВЛОЖЕНИЙ
    function output($item)
    {
        $outputArray = array();

        $post_info = Post::where([
                ['post_id', $item['id']],
                ['owner_id', $item['owner_id']]
            ])->get();
        $outputArray['date'] = $post_info["0"]->created_at;
        $outputArray['id'] = $post_info["0"]->id;
        $outputArray['owner'] = $post_info["0"]->owner_id;
        $outputArray['text'] = $post_info["0"]->text;
        $info = Material::where('post_id', $post_info["0"]->id)->get();

        foreach ($info as $array) {
            $subArray = array();
            $subArray['type'] = $array->type;
            $subArray['url'] = $array->link;
            $outputArray["attachments"][] = $subArray;
        }
        return $outputArray;
    }


//ПРОВЕРКА НА ПРИСУТСТВИЕ В БД
    function check($item)
    {
        $select = Post::where('post_id', $item['id'])->value('id');
        //dump($select);
        if (empty($select)) {
            return true;
        } else return false;
    }


//ВСТАВКА В БД
    function insert($item)
    {
    	$post = new Post;
    	$post->owner_id = $item['owner_id'];
    	$post->post_id = $item['id'];
    	$post->created_at = $item['date'];
    	$post->text = $item['text'];
    	$post->save();

        if (array_key_exists("attachments", $item) && !empty($item["attachments"])) {
            foreach ($item["attachments"] as $attachment) {
                $select = Post::where([
                    ['owner_id', $item['owner_id']],
                    ['post_id', $item['id']]
                ])->value('id');

                $material = new Material;
                $material->post_id = $select;
                $material->type = $attachment['type'];
                $material->link = $attachment['url'];
                $material->save();
            }
        }

    }

    








//СОХРАНЕНИЕ ЭЛЕМЕНТОВ ПОСТА

    


//ПРЕДСТАВЛЕНИЕ
    public function index()
    {
        $array = $this->getArray();
        //dd($array);
        return view('entryPoint')->with(['array' => $array]);
    }
}
