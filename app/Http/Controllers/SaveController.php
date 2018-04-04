<?php

namespace App\Http\Controllers;

use App\Domain\_Traits\TgTrait;
use App\Domain\Material\Commands\SendDocMaterialsToTg;
use App\Domain\Material\Commands\SendMediaGroupMaterialsToTg;
use App\Domain\Material\Queries\MaterialListByPosId;

/**
 * Class SaveController
 *
 * @package App\Http\Controllers
 */
class SaveController extends Controller
{

    use TgTrait;
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
    /**
     * @var string
     */
    var $chat_id = '-1001329091680.0';//чат с лехой 185706999, мой чат 404022092, чаит группы -1001329091680.0
    /**
     * @var null|string
     */
    var $theWay = null;
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->TelegramToken = getenv('TelegramToken');
        $this->token         = getenv('VkToken');
        $this->apiVersion    = getenv('ApiVkVersion');
        $this->theWay        = storage_path('app/attachments/');
    }

    /**
     * @param $method
     * @param $type
     * @param $url
     */
    function sendTelegramMessage($method, $type, $url)
    {
        $params = [
            'chat_id' => '404022092', //чат с лехой 185706999, мой чат 404022092 , чат группы -1001329091680
            $type     => $url
        ];
        dump($this->getTelegramInfo('getUpdates', []));
        dump($this->getTelegramInfo($method, $params));
    }

//СОХРАНЕНИЕ ЭЛЕМЕНТОВ ПОСТА

    /**
     * @param $id
     */
    public function save($id)
    {
        $post_id     = $id;
        $info        = $this->dispatch(new MaterialListByPosId($post_id));
        $sortByTypes = $this->sortByTypes($info);

        foreach ($sortByTypes as $key_type => $type) {
            if (count($type) != 0) {
                if ($key_type == "photo") {
                    $this->dispatch(new SendMediaGroupMaterialsToTg($type, $this->chat_id, $this->TelegramToken));
                }
                if ($key_type == "doc") {
                    $this->dispatch(new SendDocMaterialsToTg($type, $this->chat_id, $this->TelegramToken));
                }
                if ($key_type == "video") {
                    dump($type);
                    //$i++;
                    $contentBox = file_get_contents($type['0']->link);

//                    $videoParams = [
//                        'chat_id' => $this->chat_id,
//                        'video'   => $URL_string
//                    ];
//                    dump($this->getTelegramInfo('sendvideo', $videoParams));

                    $nachPosURL = strpos($contentBox, "https://cs");
                    $promSrting = substr($contentBox, strpos($contentBox, "https://cs"));
                    $URL_string = substr($promSrting, 0, strpos($promSrting, "\""));

//                    dump($URL_string);
                    $subArray['type']  = 'video';
                    $subArray['media'] = $URL_string;

                    $content = file_get_contents($URL_string);

                    $data = [
                            'chat_id' => '404022092',
                            'document' => fopen('C:\Users\администратор\Desktop\docs\195-1.mp4 ', "r"),
                            ];

                    dump($this->getTelegramInfo('sendDocument',$data));
                    //file_put_contents('C:\Users\администратор\Desktop\docs\ ' . $post_id . "-" . $i . ".mp4", $content);
                }
            }
        }
        dd(session('send_tg'));
    }

    /**
     * @param $info
     *
     * @return array
     */
    public function sortByTypes($info)
    {
        $sortByTypes = [
            'photo' => [],
            'video' => [],
            'doc'   => [],
        ];
        foreach ($info as $array) {
            switch ($array->type) {
                case "photo":
                    $sortByTypes['photo'][] = $array;
                    break;
                case "video":
                    $sortByTypes['video'][] = $array;
                    sleep(1);
                    break;
                case "doc":
                    $sortByTypes['doc'][] = $array;
                    break;
            }
        }

        return $sortByTypes;
    }
}
