<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return $user;
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if(!$user || !Hash::check($request->input('password'), $user->password)) {
            return response()->json(['message' => "Sorry, email or password doesn't match"], 401);
        }
        else if ($user && Hash::check($request->input('password'), $user->password)) {
            return $user;
        }

    }
}
