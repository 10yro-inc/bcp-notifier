@extends('common.layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection
@section('content')
    
        @if (session('err_message'))
            <span style="display:none" id="err_message">{{ session('err_message')  }}  </span>
        @endif
  
    <div class="app-content flexCenter">
        <div>
            <h1 class="text-center">BCP通知管理システム</h1>
        </div>

        <div id="frmLogin" class="text-center">
            <form method="post" action="/" id="login_form">
                @csrf
                <input id="user_cd" name="user_cd" type="text" class="form-control size-large" placeholder="ユーザーID"
                    maxlength="10">
                <input id="password" name="password" type="password" class="form-control size-large" placeholder="パスワード"
                    jp-input="login.passWord" maxlength="20">
                <button type="submit" id="btnLogin" onclick="location.href='./CompanyList.html'"
                    class="btn btn-primary large">ログイン</button>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
