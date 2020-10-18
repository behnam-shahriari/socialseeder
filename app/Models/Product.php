<?php


namespace App\Models;


use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use mysql_xdevapi\Exception;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'availability',
        'enable',
        'created_by'
    ];

    public function actor()
    {
        return $this->belongsTo(Actor::class, 'created_by', 'id');
    }

    public function activate():Product
    {
        $this->enable = 1;
        return $this->save();
    }

    public function removeFromStore(int $howMany = 1):?Product
    {
        if(!$this->availableFor($howMany)) {
            throw new \Exception('No enough product');
        }
        $this->decrement('availability',$howMany);
        return $this->fresh();
    }

    public function addToStore(int $howMany = 1):Product
    {
        $this->increment('availability',$howMany);
        return $this->fresh();
    }


    public function availableFor(int $quantity): bool
    {
        return $this->availability - $quantity > 0;
    }


}
