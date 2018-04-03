<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 03.04.2018
 * Time: 0:18
 */

namespace App\Domain\Post\Queries;

use App\CQRS\Job;
use App\Domain\Post\Models\Post;

class PostByPosIdAndOwnerIdQuery extends Job
{

    private $post_id;
    private $owner_id;

    public function __construct($post_id, $owner_id)
    {

        $this->post_id  = $post_id;
        $this->owner_id = $owner_id;
    }

    public function handle()
    {
        $post = Post::wherePostId($this->post_id)->whereOwnerId($this->owner_id)->first();

        return $post;
    }

}