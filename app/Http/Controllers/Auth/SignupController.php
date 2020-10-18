<?php
/**
 * User: MB
 * Date: 10/18/2020
 */

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\AppController;
use App\Models\Actor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SignupController extends AppController {

    public function signUp(Request $request) {
        $user = $this->validate($request, [
            'firstName' => 'required|string|min:5',
            'lastName' => 'required|string|min:5',
            'email' => 'required|email|unique:actors,email',
            'password' => 'required|string|min:8',
        ]);

        $user['email'] = strtolower($user['email']);
        $user['permission'] = 'client';
        $user['password'] = Hash::make($user['password']);
        $newUser = Actor::create($user);
        if (isset($newUser)) {
            return $this->success($newUser, "User has been signed up", [], 201);
        }
        return $this->error("Error in user creation");
    }
}
