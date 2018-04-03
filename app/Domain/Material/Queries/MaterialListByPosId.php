<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 03.04.2018
 * Time: 0:18
 */

namespace App\Domain\Material\Queries;

use App\CQRS\Job;
use App\Domain\Material\Models\Material;

class MaterialListByPosId extends Job
{
    private $post_id;

    public function __construct($post_id)
    {
        $this->post_id = $post_id;
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        $post = Material::wherePostId($this->post_id)->get();

        return $post;
    }

}