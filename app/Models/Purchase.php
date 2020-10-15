<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'actor_username',
        'product_id'
    ];
}
