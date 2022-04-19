<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
    public function index (Request $request) 
    {

        if(!$request->isMethod('post'))
        {
            return view('login');
        }
        $user = User::where('email', $request->email)->get();
        if (count($user) === 0){
            return view('login', ['login_error' => '1']);
        }
        
        // 一致
        if (Hash::check($request->password, $user[0]->password)) {
            
            // セッション
            session(['name'  => $user[0]->name]);
            session(['email' => $user[0]->email]);
            
            // フラッシュ
            session()->flash('flash_flg', 1);
            session()->flash('flash_msg', 'ログインしました。');
                  
            return redirect(url('/'));
        // 不一致    
        }else{
            return view('login', ['login_error' => '1']);
        }

        return view('login', $result);
    }
    
}
