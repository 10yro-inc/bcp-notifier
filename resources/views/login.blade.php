@extends('common.layout')
@section('content')
<?php $is_production = env('APP_ENV') === 'production' ? false : false; ?>
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <div class="app-content flexCenter">
        <div>
            <div class="text-center"></div>
            <h1 class="text-center">BCP通知管理システム</h1></div>

            <div id="frmLogin" class="text-center">
                <input id="login_ctrl_user_id" type="text" class="form-control size-large" placeholder="ユーザーID" maxlength="10">
                <input id="login_ctrl_password" type="password" class="form-control size-large" placeholder="パスワード" jp-input="login.passWord" maxlength="20">
                <button id="btnLogin" onclick="location.href='./CompanyList.html'"class="btn btn-primary large">ログイン</button>
            </div>
        
        <div>
    </div>
@endsection