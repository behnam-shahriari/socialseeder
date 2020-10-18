<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Actor extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $fillable = [
        'username',
        'firstName',
        'lastName',
        'phone',
        'permission'
    ];

    protected $hidden = [
        'password',
    ];

    public function products()
    {
        return $this->where('permission', 'user')->hasMany(Product::class, 'created_by', 'id');
    }


}
