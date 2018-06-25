<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 03.04.2018
 * Time: 0:18
 */

namespace App\Domain\Channel\Queries;

use App\CQRS\Job;
use App\Domain\Channel\Models\Channel;

class ChannelsListByUserId extends Job
{
    private $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $channel = Channel::where('user_id', $this->user_id)->get();

        return $channel;
    }
}