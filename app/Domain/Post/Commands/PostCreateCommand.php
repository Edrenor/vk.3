<?php
/**
 * Created by PhpStorm.
 * User: алексей
 * Date: 02.04.2018
 * Time: 23:23
 */

namespace App\Domain\Post\Commands;

use App\CQRS\Job;
use App\Domain\Material\Commands\MaterialCreateCommand;
use App\Domain\Post\Models\Post;
use Illuminate\Foundation\Bus\DispatchesJobs;

class PostCreateCommand extends Job
{
    use DispatchesJobs;

    private $id;
    private $owner_id;
    private $date;
    private $text;
    private $post_id;
    private $attachments;

    public function __construct($id, $owner_id, $post_id, $date, $text, $attachments)
    {
        $this->id          = $id;
        $this->owner_id    = $owner_id;
        $this->post_id     = $post_id;
        $this->date        = $date;
        $this->text        = $text;
        $this->attachments = $attachments;
    }

    /**
     *
     */
    public function handle()
    {
        $post             = new Post;
        $post->owner_id   = $this->owner_id;
        $post->post_id    = $this->post_id;
        $post->created_at = $this->date;
        $post->text       = $this->text;
        $post->save();
//        if ($this->attachments && is_array($this->attachments) && count($this->attachments) != 0) {
            foreach ($this->attachments as $attachment) {
                $this->dispatch(new MaterialCreateCommand($post->id, $attachment['type'], $attachment['url']));
//            }
        }
    }
}