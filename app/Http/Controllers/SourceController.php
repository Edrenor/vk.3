<?php

namespace App\Http\Controllers;

use App\Domain\Source\Commands\UpdateSource;
use Illuminate\Http\Request;
use App\Domain\Source\Commands\DeleteSource;
use Illuminate\Support\Facades\Auth;

class SourceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update($channel_id, $source_id = null, Request $request)
    {
        $this->dispatch(new UpdateSource($source_id,
                $channel_id,
                Auth::id(),
                $request->link,
                $request->name,
                $request->owner,
                $request->input('images', true),
                $request->input('video', true),
                $request->input('gif', true),
                $request->input('text', true),
                $request->input('article', true)
            )
        );

        return redirect()->route('channel', ['id' => $channel_id, 'source_id' => $source_id]);
    }

    public function delete($source_id, $channel_id)
    {
        $this->dispatch(new DeleteSource($source_id));

        return redirect()->route('channel', ['id' => $channel_id]);
    }
}
