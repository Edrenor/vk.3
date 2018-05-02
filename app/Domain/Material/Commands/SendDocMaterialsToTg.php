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
use Telegram\Bot\Api;
use Telegram;

class SendDocMaterialsToTg extends Job
{

    use DispatchesJobs, TgTrait;
    private $chat_id;
    private $materials;

    /**
     * SendMediaGroupMaterialsToTg constructor.
     *
     * @param $materials
     * @param $text
     * @param $chat_id
     * @param $TelegramToken
     */
    public function __construct($materials, $text, $chat_id, $TelegramToken)
    {
        $this->materials     = $materials;
        $this->text          = $text;
        $this->chat_id       = $chat_id;
        $this->TelegramToken = $TelegramToken;
    }

    /**
     *
     */
    public function handle()
    {
        foreach ($this->materials as $key => $array) {
            $telegram = new Api($this->TelegramToken);

            if (strlen($this->text) <= 200){
                $captin = $this->text;
            }
            else{
                $captin = '';
                $messageParams = [
                    'chat_id' => $this->chat_id,
                    'text'   => $this->text,
                ];
                $this->getTelegramInfo('sendMessage', $messageParams);
            }

            $telegram->sendVideo([
                        'chat_id' => $this->chat_id,
                        'video' => $array->link,
                        'caption' => $this->text,
                    ]);
        }
    }
}