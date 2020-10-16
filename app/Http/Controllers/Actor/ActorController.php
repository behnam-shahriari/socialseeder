<?php

namespace App\Http\Controllers\Actor;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Services\ActorService;

class ActorController extends Controller
{
    /**
     * @var ActorService
     */
    private $actorService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ActorService $actorService)
    {
        //
        $this->actorService = $actorService;
    }

    public function all()
    {
        return response()->json([
            'data' => $actors = $this->actorService->all(),
            'extra' => [
                'count' => sizeof($actors)
            ]
        ]);
    }

    public function create()
    {
        
    }
}
