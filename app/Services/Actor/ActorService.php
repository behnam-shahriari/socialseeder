<?php


namespace App\Services\Actor;


use App\Models\Actor;

class ActorService
{
    public function all()
    {
        return Actor::all();
    }
}
