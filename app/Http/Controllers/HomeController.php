<?php

namespace App\Http\Controllers;

use App\Domain\Channel\Queries\ChannelsListByUserId;
use App\Domain\Source\Queries\SourceListByUserIdChannelId;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
    public function index()
    {
        $channelsTg = $this->dispatch(new ChannelsListByUserId(Auth::id()));
        $sourcesForChannels = [];
        foreach ($channelsTg as $channelTg){
            $sources = $this->dispatch(new SourceListByUserIdChannelId( Auth::id(), $channelTg->id) );
            foreach ($sources as $source){
                $sourcesForChannels[$channelTg->name][] = $source->source;
            }

        }
        return view('home', compact('channelsTg', 'sourcesForChannels') );
    }
}
