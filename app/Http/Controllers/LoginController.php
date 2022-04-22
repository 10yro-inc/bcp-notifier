<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Services\UserService;

class LoginController extends Controller
{
    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index(Request $request)
    {
        $this->removeSession();
        return view('login');
    }

    public function login(Request $request)
    {

        $user = $this->userService->getUser($request->user_cd);

        // 一致
        if (count($user) !== 0 && Hash::check($request->password, $user[0]->password)) {

            // セッション
            session()->put(['name'  => $user[0]->name]);
            session()->put(['user_cd' => $user[0]->user_cd]);
            session()->put(['user' => $user[0]]);


            return redirect(url('/company'));
            // 不一致    
        } else {
            session()->flash('err_message', 'ユーザーIDまたはパスワードが違います。');

            return redirect(url('/'));
        }
    }

    public function logout(Request $request)
    {
        $this->removeSession();
        return redirect(url('/'));
    }

    private function removeSession()
    {
        session()->forget('name');
        session()->forget('user_cd');
        session()->forget('user');
    }
}
