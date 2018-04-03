<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 02.04.2018
 * Time: 23:23
 */

namespace App\Domain\Material\Commands;

use App\CQRS\Job;
use App\Domain\Material\Models\Material;
use Illuminate\Foundation\Bus\DispatchesJobs;

class MaterialCreateCommand extends Job
{
    use DispatchesJobs;

    private $id;
    private $type;
    private $url;

    public function __construct($id, $type, $url)
    {
        $this->id   = $id;
        $this->type = $type;
        $this->url  = $url;
    }

    /**
     *
     */
    public function handle()
    {

        $material          = new Material;
        $material->post_id = $this->id;
        $material->type    = $this->type;
        $material->link    = $this->url;

        $material->save();
    }
}