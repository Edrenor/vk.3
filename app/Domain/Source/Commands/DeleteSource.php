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

    private $source;

    public function __construct($source)
    {
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        Source::whereSource($this->source)->delete();
    }

}