<?php
/**
 * Created by ручки.
 * User: хуевый программист
 * Date: 09.04.2018
 * Time: 20:45
 */

namespace App\Domain\Material\Commands;

use App\CQRS\Job;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Domain\_Traits\TgTrait;

class SendVideoToTg extends Job
{

    use DispatchesJobs, TgTrait;
    private $chat_id;
    private $materials;

    /**
     * SendMediaGroupMaterialsToTg constructor.
     *
     * @param $materials
     * @param $chat_id
     */
    public function __construct($materials, $chat_id, $TelegramToken)
    {
        $this->materials     = $materials;
        $this->chat_id       = $chat_id;
        $this->TelegramToken = $TelegramToken;
    }

    /**
     *
     */
    public function handle()
    {
        $contentBox = file_get_contents($type['0']->link);
        $nachPosURL = strpos($contentBox, "https://cs");
        $promSrting = substr($contentBox, strpos($contentBox, "https://cs"));
        $URL_string = substr($promSrting, 0, strpos($promSrting, "\""));
        $subArray['type']  = 'video';
        $subArray['media'] = $URL_string;
        $content = file_get_contents($URL_string);

        $filePath = "C:\Users\PHEX\Desktop\docs\\" . $post_id . ".mp4";

        file_put_contents($filePath, $content);

        $fileToload = new \CURLFile(realpath($filePath));
        dump($fileToload);
        $postdata = [
                    'chat_id' => $this->chat_id,
                    'video' => $fileToload
                ];
        $request = $this->curlRequest("https://api.telegram.org/bot$this->TelegramToken/sendVideo?",$postdata);
        dump($request);
        if ($request['ok'] == true) {
            $send_tg   = session('send_tg', []);
            $send_tg[] = count($this->materials) . ' videos sended to tg';
            session(['send_tg' => $send_tg]);
        }
        
    }

    public function curlRequest($url, $postdata){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type:multipart/form-data'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

}