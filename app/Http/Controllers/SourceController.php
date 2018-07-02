<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Domain\Source\Commands\AddSource;
use App\Domain\Source\Commands\DeleteSource;
use App\Domain\Source\Queries\SourceListByUserIdChannelId;
use Illuminate\Support\Facades\Auth;

class SourceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function update($channel_id, $source_id = null, Request $request)
    {

        $this->dispatch(new AddSource($channel_id, Auth::id(), $request->source));

        return redirect()->route('channel', ['id' => $channel_id, 'source_id' => $source_id]);
    }

    public function delete($source_id, $channel_id)
    {
        $this->dispatch(new DeleteSource($source_id));

        return redirect()->route('channel', ['id' => $channel_id]);

    }
}
