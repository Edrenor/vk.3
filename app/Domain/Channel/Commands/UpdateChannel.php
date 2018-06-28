<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 03.04.2018
 * Time: 0:18
 */

namespace App\Domain\Channel\Commands;

use App\CQRS\Job;
use App\Domain\Channel\Models\Channel;
use App\Domain\Channel\Queries\ChannelById;
use Illuminate\Foundation\Bus\DispatchesJobs;

class UpdateChannel extends Job
{

    use DispatchesJobs;

    private $id;
    private $name;
    private $token;
    private $link;
    private $user_id;

    public function __construct($id = null, $name, $token, $link = null, $user_id)
    {
        $this->id      = $id;
        $this->name    = $name;
        $this->token   = $token;
        $this->link    = $link;
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        if ($this->id) {
            $channel = $this->dispatch(new ChannelById($this->id));
        } else {
            $channel = new Channel();
        }

        $channel->name    = $this->name;
        $channel->token   = $this->token;
        $channel->link    = $this->link;
        $channel->user_id = $this->user_id;
        $channel->save();

        session(['channel'=> $channel->id]);
    }

}