<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\AppController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends AppController {


    public function login(Request $request) {

        $request->only(['email', 'password']);
        $credentials = $this->validate($request, [
            'email' => 'required|email|min:5|max:150',
            'password' => [
                'required',
                'string',
                'min:8',
            ],
        ]);

        $credentials['email'] = strtolower($credentials['email']);
        $token = Auth::attempt($credentials);
        return $this->success([
            'token' => $token,
            'time' => Carbon::now()->toDateTimeString(),
        ], "Logged in", [], 200);
    }
}
