<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $req)
    {
        if (!isset($req->password) || $req->password !== $req->confirm) {
            return response(json_encode(["error" => "bad request"]), 400);
        }
        $exists = User::where('email', $req->email)->first();
        if (isset($exists)) {
            return response(json_encode(["error" => "already registered"]), 409);
        }
        $user = new User;
        $user->email = $req->email;
        $user->password = $req->password;
        $user->save();
        return $user->toJson();
    }

    public function login(Request $req)
    {
        $user = User::where('email', $req->email)->where('password', $req->password)->first();
        if (isset($user)) {
            $user->token = Str::random(100);
            $user->save();
            return json_encode(["token" => $user->token, "message" => $user]);
        }
        return response(null, 500);
    }

    public function getCurrent(Request $req)
    {
        return json_encode(['email' => 'test@mail.ru']);
    }
}
