<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 02.04.2018
 * Time: 23:23
 */

namespace App\Domain\Material\Commands;

use App\CQRS\Job;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Domain\_Traits\TgTrait;
use Telegram;

class SendMediaGroupMaterialsToTg extends Job
{

    use DispatchesJobs, TgTrait;

    private $materials;
    private $chat_id;

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
        $mediaArray = [];
        foreach ($this->materials as $key => $array) {
            $subArray          = [];
            $subArray['type']  = 'photo';
            $subArray['media'] = $array->link;
            $mediaArray[]      = $subArray;
        }
        $params = [
            'chat_id' => $this->chat_id,
            'media'   => json_encode($mediaArray)
        ];
        $result = $this->getTelegramInfo('sendMediagroup', $params);
        dump($result);
        if ($result['ok'] == true) {
            $send_tg = session('send_tg', []);
            $send_tg[] = count($this->materials) . ' photo sended to tg';
            session(['send_tg' => $send_tg]);
        }
    }
}