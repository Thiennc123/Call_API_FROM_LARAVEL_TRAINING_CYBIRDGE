<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class AuthController extends Controller
{
    public function check(Request $request)
    {
        
        $response = Http::post('http://bt_training.example.com/api/auth/login', [
            'email'     => $request->email,
            'password'  => $request->password,
        ]);
        if($response['status'])
        {
            session(['token' => $response['token']]);
            return redirect()->route('users.index');
        }else{
            dd("false");
        }
    }

    public function logout()
    {
        $response = Http::withToken(session('token')['accessToken'])->post('http://bt_training.example.com/api/auth/logout');

        Session::flush();
        return redirect()->route('loginView');
    }
}