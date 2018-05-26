<?php
/**
 * Created by PhpStorm.
 * User: PHEX
 * Date: 17.05.2018
 * Time: 23:07
 */

namespace App\Domain\StopWord\Queries;

use App\CQRS\Job;
use App\Domain\StopWord\Models\StopWord;

class StopWordsByOwnersId extends Job
{
    private $owner_id;

    public function __construct($owner_id)
    {
        $this->owner_id = $owner_id;
    }

    public function handle()
    {
        $stopWordsArray = StopWord::whereOwnerId($this->owner_id)->first();

        return $stopWordsArray;
    }

}