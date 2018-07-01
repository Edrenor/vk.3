<?php

namespace App\Http\Controllers;

use App\Domain\Channel\Commands\UpdateChannel;
use App\Domain\Source\Commands\AddSource;
use App\Domain\Channel\Queries\ChannelById;
use App\Domain\Channel\Queries\ChannelFindOrNewById;
use App\Domain\Source\Queries\SourceListByUserIdChannelId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $channel = $this->dispatch(new ChannelFindOrNewById($id));
        $sourceForChannel = [];
        $sources = $this->dispatch(new SourceListByUserIdChannelId(Auth::id(), $channel->id));
        foreach ($sources as $source) {
            $sourceForChannel[$channel->name][] = $source->source;
        }

        return view('content.channel.add', compact('channel', 'sourceForChannel'));
    }

    public function update($id = null, Request $request)
    {
        $this->dispatch(new UpdateChannel($id, $request->name, $request->token, $request->link, Auth::id()));

        $channel_id = session('channel');

        return redirect()->route('channel', ['id' => $channel_id]);
    }

}
