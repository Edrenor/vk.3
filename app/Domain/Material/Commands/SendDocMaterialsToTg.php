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

class SendDocMaterialsToTg extends Job
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
        foreach ($this->materials as $key => $array) {
            $docParams = [
                'chat_id'  => $this->chat_id,
                'document' => $array->link
            ];
            $result    = $this->getTelegramInfo('sendDocument', $docParams);
        }
        if ($result['ok'] == true) {
            $send_tg   = session('send_tg', []);
            $send_tg[] = count($this->materials) . ' docs sended to tg';
            session(['send_tg' => $send_tg]);
        }
    }
}