<?php

namespace App\Http\Controllers;

use App\Domain\Material\Queries\MaterialListByPosId;
use App\Domain\Post\Commands\PostCreateCommand;
use App\Domain\Post\Queries\PostByPosIdAndOwnerIdQuery;

/**
 * Class BasicController
 *
 * @package App\Http\Controllers
 */
class BasicController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('index')->render();
    }
}
