<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        session()->forget('name');
        session()->forget('user_cd');
        return view('login');
    }

    public function login(Request $request)
    {
        $user = User::where('user_cd', $request->user_cd)->get();

        // 一致
        if (count($user) !== 0 && Hash::check($request->password, $user[0]->password)) {

            // セッション
            session()->put(['name'  => $user[0]->name]);
            session()->put(['user_cd' => $user[0]->user_cd]);

            // フラッシュ

            return redirect(url('/company'));
            // 不一致    
        } else {
            session()->flash('err_message', 'ユーザーIDまたはパスワードが違います。');

            return redirect(url('/'));
        }
    }

    public function logout(Request $request)
    {
        session()->forget('name');
        session()->forget('user_cd');
        return redirect(url('/'));
    }
}
