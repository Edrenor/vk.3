<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 03.04.2018
 * Time: 0:18
 */

namespace App\Domain\Source\Commands;

use App\CQRS\Job;
use App\Domain\Source\Models\Source;
use Illuminate\Foundation\Bus\DispatchesJobs;

class DeleteSource extends Job
{

    use DispatchesJobs;

    private $id;

    public function __construct($source_id)
    {
        $this->id = $source_id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        Source::whereId($this->id)->delete();
    }

}