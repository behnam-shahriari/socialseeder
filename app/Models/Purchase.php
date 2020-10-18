<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'actor_id',
        'product_id',
        'price',
        'quantity',
        'status'
    ];


    public function client()
    {
        return $this->belongsTo(Actor::class, 'actor_id')->where('permission', 'client');
    }

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id');
    }

    public function acceptIt():Purchase
    {
        if($this->status == 'pending') {
            $this->status = 'accepted';
            $this->save();
        }
        return $this;
    }
}
