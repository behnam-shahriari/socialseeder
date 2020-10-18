<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    use HttpResponse;
    public function user()
    {
       return Auth::user();
    }
}
