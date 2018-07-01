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

    public function __construct($user_id, $channel_id)
    {
        $this->user_id    = $user_id;
        $this->channel_id = $channel_id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        if ($this->user_id || $this->channel_id) {
            $sources = new Source();
            if ($this->user_id) {
                $sources = $sources->whereUserId($this->user_id);
            }
            if ($this->channel_id) {
                $sources = $sources->whereChannelId($this->channel_id);
            }
            return $sources->get();

        }
        return null;
    }

}