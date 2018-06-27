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

class ChannelById extends Job
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $channel = Channel::find($this->id);

        return $channel;
    }

}