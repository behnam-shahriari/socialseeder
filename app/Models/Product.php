<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'enable',
        'actor_username'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'actor_username');
    }
}
