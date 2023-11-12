<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view("welcome");
    }

    public function login(Request $request){
        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://127.0.0.1:8000/oauth/token', [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => '1',
                'client_secret' => 'wDxc1QVYu6aXjRlVSgrhqCqdHIZeUzRaja5qU3ko',
                'username' => $request->input('email'),
                'password' => $request->input('password'),
                'scope' => '',
            ],
        ]);

        $token = json_decode((string) $response->getBody(), true);

        session()->put("token", $token);

        return redirect()->route('app.index');
    }

    public function logout()
    {
        $http = new \GuzzleHttp\Client;

        $response = $http->post('http://localhost:8000/api/logout', [
            'headers' => [ 'Authorization' => 'Bearer ' . session()->get("token")["access_token"] , 'Accept' => 'application/json',],
        ]);

        session()->forget("token");

        return redirect()->route('login.index');
    }
}
