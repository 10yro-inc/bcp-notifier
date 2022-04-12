<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index () 
    {
        $hello = 'Hello,World!';
        $hello_array = ['Hello', 'こんにちは', 'ニーハオ'];
        $result = [];
        $result["param1"] = "test1";
        $result["param2"] = "test2";

        return view('login', $result);
    }
    
}
