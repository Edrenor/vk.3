<?php

namespace App\Http\Controllers;

use App\Domain\_Traits\TgTrait;
use App\Domain\Post\Queries\PostByPostID;
use App\Domain\Material\Commands\SendDocMaterialsToTg;
use App\Domain\Material\Commands\SendMediaGroupMaterialsToTg;
use App\Domain\Material\Commands\SendVideoToTg;
use App\Domain\Material\Queries\SourseListByUserIdChannelId;
use Telegram;

/**
 * Class SaveController
 *
 * @package App\Http\Controllers
 */
class SaveController extends Controller
{

    use TgTrait;
    /**
     * @var array|false|null|string
     */
    var $token = null;
    /**
     * @var array|false|null|string
     */
    var $TelegramToken = null;
    /**
     * @var array|false|null|string
     */
    var $apiVersion = null;
    /**
     * @var string
     */
    var $chat_id = '-1001329091680.0';//чат с лехой 185706999, мой чат 404022092, чаит группы -1001329091680.0
    /**
     * @var null|string
     */
    var $theWay = null;
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        $this->TelegramToken = getenv('TelegramToken');
        $this->token         = getenv('VkToken');
        $this->apiVersion    = getenv('ApiVkVersion');
        $this->theWay        = storage_path('app/attachments/');
    }

//СОХРАНЕНИЕ ЭЛЕМЕНТОВ ПОСТА

    /**
     * @param $id
     */
    public function save($id)
    {
        $post_id     = $id;
        $info        = $this->dispatch(new SourseListByUserIdChannelId($post_id));
        $sortByTypes = $this->sortByTypes($info);
        $post = $this->dispatch(new PostByPostID($post_id));

        //dump($post->text);

        foreach ($sortByTypes as $key_type => $type) {
            if (count($type) != 0) {

                if ($key_type == "photo") {
                    $this->dispatch(new SendMediaGroupMaterialsToTg($type, $post->text, $this->chat_id, $this->TelegramToken));
                }
                if ($key_type == "doc") {
                    $this->dispatch(new SendDocMaterialsToTg($type, $post->text, $this->chat_id, $this->TelegramToken));
                }
                if ($key_type == "video") {
                    $this->dispatch(new SendVideoToTg($type, $post->text, $this->chat_id, $this->TelegramToken));
                }
            }
        }
        //dd(session('send_tg'));
    }

    /**
     * @param $info
     *
     * @return array
     */
    public function sortByTypes($info)
    {
        $sortByTypes = [
            'photo' => [],
            'video' => [],
            'doc'   => [],
        ];
        foreach ($info as $array) {
            switch ($array->type) {
                case "photo":
                    $sortByTypes['photo'][] = $array;
                    break;
                case "video":
                    $sortByTypes['video'][] = $array;
                    sleep(1);
                    break;
                case "doc":
                    $sortByTypes['doc'][] = $array;
                    break;
            }
        }

        return $sortByTypes;
    }
}
