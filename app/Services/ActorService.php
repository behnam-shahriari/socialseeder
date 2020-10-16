<?php


namespace App\Services;


use App\Models\Actor;

class ActorService
{
    public function all()
    {
        return Actor::all();
    }
}
