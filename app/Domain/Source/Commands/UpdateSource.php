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
use App\Domain\Source\Queries\SourceListByUserIdChannelId;

/**
 * Class UpdateSource
 *
 * @package App\Domain\Source\Commands
 */
class UpdateSource extends Job
{

    use DispatchesJobs;

    /**
     * @var
     */
    private $source_id;
    /**
     * @var null
     */
    private $channel_id;
    /**
     * @var
     */
    private $user_id;
    /**
     * @var
     */
    private $link;
    /**
     * @var
     */
    private $name;
    /**
     * @var
     */
    private $owner;
    /**
     * @var bool
     */
    private $images;
    /**
     * @var bool
     */
    private $video;
    /**
     * @var bool
     */
    private $gif;
    /**
     * @var bool
     */
    private $text;

    /**
     * UpdateSource constructor.
     *
     * @param      $source_id
     * @param null $channel_id
     * @param      $user_id
     * @param      $link
     * @param      $name
     * @param      $owner
     * @param bool $images
     * @param bool $video
     * @param bool $gif
     * @param bool $text
     * @param bool $article
     */
    public function __construct(
        $source_id,
        $channel_id = null,
        $user_id,
        $link,
        $name,
        $owner,
        $images = true,
        $video = true,
        $gif = true,
        $text = true,
        $article = true
    ) {
        $this->channel_id = $channel_id;
        $this->source_id  = $source_id;
        $this->user_id    = $user_id;
        $this->link       = $link;
        $this->name       = $name;
        $this->owner      = $owner;
        $this->images     = boolval($images);
        $this->video      = boolval($video);
        $this->gif        = boolval($gif);
        $this->text       = boolval($text);
        $this->article    = boolval($article);
    }

    /**
     * @return mixed
     */
    public function handle()
    {
        if ($this->source_id) {
            $source = Source::find($this->source_id);
        } else {
            $source = new Source();
        }

        $source->channel_id = $this->channel_id;
        $source->user_id    = $this->user_id;
        $source->link       = $this->link;
        $source->name       = $this->name;
        $source->owner      = $this->owner;
        $source->images     = $this->images;
        $source->video      = $this->video;
        $source->gif        = $this->gif;
        $source->text       = $this->text;
        $source->article    = $this->article;
        $source->save();
    }
}