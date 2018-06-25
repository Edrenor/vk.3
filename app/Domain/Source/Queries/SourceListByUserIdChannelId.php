<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 03.04.2018
 * Time: 0:18
 */

namespace App\Domain\Source\Queries;

use App\CQRS\Job;
use App\Domain\Source\Models\Source;

class SourceListByUserIdChannelId extends Job
{
    private $user_id;
    private $channel_id;

    public function __construct($user_id,$channel_id)
    {
        $this->user_id = $user_id;
        $this->channel_id = $channel_id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $sources = Source::whereUserId($this->user_id)->whereChannelId($this->channel_id)->get();
        return $sources;
    }

}