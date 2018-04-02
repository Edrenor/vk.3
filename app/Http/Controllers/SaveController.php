<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Material;

class SaveController extends Controller
{
	var $TelegramToken = "562258307:AAF7ljfH87V1jhZ4jGonaLJZfcxdMG41vSs";
    var $chat_id = '404022092';//чат с лехой 185706999, мой чат 404022092, чаит группы -1001329091680.0
    var $theWay = 'C:\Users\PHEX\Desktop\docs\ ';

function getTelegramInfo($method, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot$this->TelegramToken/$method?".http_build_query($params));
        $result = curl_exec($ch);
        curl_close($ch);

        return $info = json_decode($result);
    }


    function sendTelegramMessage($method,$type,$url){
        $params = [
            'chat_id' => '404022092', //чат с лехой 185706999, мой чат 404022092 , чат группы -1001329091680
            $type => $url
            ];
        dump($this->getTelegramInfo('getUpdates',[]));
        dump($this->getTelegramInfo($method,$params));

    }


//СОХРАНЕНИЕ ЭЛЕМЕНТОВ ПОСТА
    public function save($id)
    {
        $post_id = $id;        
        $info = Material::where([
                ['post_id', $post_id]
            ])->get();
        $i = 0;
        $mediaArray = array();


        //dump($info);


        $data = json_decode(file_get_contents('php://input')); // получаем JSON

        foreach ($info as $array) {
            $subArray = array();

            if ($array->type == "photo") {
                $i++;

                $subArray['type'] = 'photo';
                $subArray['media'] = $array->link;

                
                $content = file_get_contents($array->link);file_put_contents($this->theWay . $post_id . "-" . $i . ".jpg", $content);
            }
            if ($array->type == "doc") {
                $i++;

                $docParams = [
                    'chat_id' => $this->chat_id,
                    'document' => $array->link
                ];
                $this->getTelegramInfo('sendDocument',$docParams);

                $content = file_get_contents($array->link);
                file_put_contents($this->theWay . $post_id . "-" . $i . ".gif", $content);
            }


            if ($array->type == "video") {
                $i++;
                $contentBox = file_get_contents($array->link);

                dump($array->link);

                $videoParams = [
                    'chat_id' => $this->chat_id,
                    'video' => $URL_string
                ];
                dump($this->getTelegramInfo('sendvideo',$videoParams) );

                $nachPosURL = strpos($contentBox, "https://cs");
                $promSrting = substr($contentBox, strpos($contentBox, "https://cs"));
                $URL_string = substr($promSrting, 0, strpos($promSrting, "\""));

                dump($URL_string);

                $subArray['type'] = 'video';
                $subArray['media'] = $URL_string;

                $content = file_get_contents($URL_string);
                file_put_contents($this->theWay . $post_id . "-" . $i . ".mp4", $content);
            }

            $mediaArray[] = $subArray;            
        }



        $params = [
            'chat_id' => $this->chat_id,
            'media' => json_encode($mediaArray)
            ];

        //dump($mediaArray);
        //dump($params);
        if ($params['media'] !== '[[]]' ){
            dump($this->getTelegramInfo('sendMediagroup',$params));
        }
        
        //echo("Спизжено!");
    }
}
