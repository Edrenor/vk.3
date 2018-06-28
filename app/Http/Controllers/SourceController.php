<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Source\Commands\AddSource;
use App\Domain\Source\Queries\SourceListByUserIdChannelId;
use Illuminate\Support\Facades\Auth;

class SourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add($id = null, Request $request)
    {

        $channel_id = session('channel');

        $this->dispatch(new AddSource($channel_id, Auth::id(), $request->source));

        return redirect()->route('channel', ['id' => $channel_id]);
    }
}
