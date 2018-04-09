<?php

namespace App\Domain\_Traits;

/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 03.04.2018
 * Time: 15:45
 */

trait TgTrait
{

    function getTelegramInfo($method, $params = null,$postdata = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if($postdata){
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch,
            CURLOPT_URL,
            "https://api.telegram.org/bot$this->TelegramToken/$method?"
            );
        }
        if($params){
            curl_setopt($ch,
            CURLOPT_URL,
            "https://api.telegram.org/bot$this->TelegramToken/$method?" . http_build_query($params)
            );
        }
        
        $result = curl_exec($ch);
        curl_close($ch);

        return $info = json_decode($result, true);
    }
}