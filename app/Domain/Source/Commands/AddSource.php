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

class AddSource extends Job
{

    use DispatchesJobs;

    private $channel_id;
    private $user_id;
    private $source;

    public function __construct($channel_id = null, $user_id, $source)
    {
        $this->channel_id      = $channel_id;
        $this->user_id = $user_id;
        $this->source    = $source;
    }

    /**
     * @return mixed
     */
    public function handle()
    {


//        $sources = $this->dispatch(new SourceListByUserIdChannelId( $this->user_id, $this->channel_id) );

//        foreach ($sources as $source){
//            if (!in_array($this->source,$source) ){
//                echo 'Такая запись уже существует';//todo сделать тут алерт
//            }
//            else{
                $source = new Source();
                $source->channel_id  = $this->channel_id;
                $source->user_id     = $this->user_id;
                $source->source      = $this->source;
                $source->save();
//            }
//        }
    }

}