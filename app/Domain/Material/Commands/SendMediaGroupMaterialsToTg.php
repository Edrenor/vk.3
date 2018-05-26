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
    private $text;
    private $chat_id;
    private $TelegramToken;

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
        $mediaArray = [];
        foreach ($this->materials as $key => $array) {
            $subArray          = [];
            $subArray['type']  = 'photo';
            $subArray['media'] = $array->link;
            $mediaArray[]      = $subArray;
        }
        $mediaParams = [
            'chat_id' => $this->chat_id,
            'media'   => json_encode($mediaArray),
        ];
        if ($this->text){
            $messageParams = [
                'chat_id' => $this->chat_id,
                'text'   => $this->text,
            ];
            Telegram::bot()->sendMessage($messageParams);
        }


        $this->getTelegramInfo('sendMediaGroup',$mediaParams);
    }
}