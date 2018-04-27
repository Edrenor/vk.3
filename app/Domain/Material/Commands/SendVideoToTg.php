<?php
namespace App\Domain\Material\Commands;

use App\CQRS\Job;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Domain\_Traits\TgTrait;
use Telegram\Bot\Api;
use Telegram;

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
        $i=0;
        foreach ($this->materials as $key => $array) {
            if (stripos($array->link, 'youtube')){
                Telegram::bot()->sendMessage([
                    'chat_id' => $this->chat_id,
                    'text' => $array->link
                ]);
            }
            else{
                $i++;
                $contentBox = file_get_contents($array->link);
                $nachPosURL = strpos($contentBox, "https://cs");
                $promSrting = substr($contentBox, strpos($contentBox, "https://cs"));
                $URL_string = substr($promSrting, 0, strpos($promSrting, "\""));
                $content = file_get_contents($URL_string);

                $filePath = "C:\Users\PHEX\Desktop\docs\\" . $array->post_id . "-" . $i . ".mp4";

                file_put_contents($filePath, $content);

                //$fileToload = new \CURLFile(realpath($filePath));

                Telegram::bot()->sendVideo([
                    'chat_id' => $this->chat_id,
                    'video' => $filePath
                ]);
            }

        }









//        foreach ($this->materials as $key => $array) {
//            $telegram = new Api($this->TelegramToken);
//            $result = $telegram->sendVideo([
//                'chat_id' => $this->chat_id,
//                'video' => $array->link,
//                'caption' => 'This is a video'
//            ]);
//            dump($result);
//            echo "Отправлено";
//        }
        echo "Отправлено";
        // if ($result['ok'] == true) {
        //     $send_tg   = session('send_tg', []);
        //     $send_tg[] = count($this->materials) . ' docs sended to tg';
        //     session(['send_tg' => $send_tg]);
        // }
    }
}