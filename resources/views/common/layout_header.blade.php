<!DOCTYPE html>

<html lang="ja" class="overthrow-enabled has-navbar-top">
<!-- ***************** -->
<!-- meta              -->
<!-- ***************** -->

<meta name="viewport" content="width=1112">


<!-- キャッシュ無効 -->
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="0">
<!-- 電話番号リンク無効 -->
<meta name="format-detection" content="telephone=no">

<!-- ***************** -->
<!-- CSSファイル       -->
<!-- ***************** -->

<!-- 共通CSS -->
<link rel="stylesheet" href="{{ asset('css/ui-base.css') }}">
<link rel="stylesheet" href="{{ asset('css/ui-hover.css') }}">
<link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css') }}">
<link rel="stylesheet" href="{{ asset('css/spinner.css') }}">
@yield('css')


<!-- ***************** -->
<!-- その他            -->
<!-- ***************** -->
<title>BCP通知管理システム</title>

<body>
    <div class="spinner-backdrop">
        <div class="spinner-wrapper">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- 各ページ読み込み -->
    <div class="app">

        <div class="navbar navbar-app navbar-absolute-top">

            <!-- タイトル -->
            <div class="navbar-brand navbar-brand-center">
                <strong class="ng-binding">会社BCP設定一覧</strong>
            </div>

            <!-- 戻る
                <div id="headerBackLink" class="btn-group pull-left">
                    <div class="btn">
                        <a><img src="./img/arrow_left.svg"> 戻る</a>
                    </div>
                </div>
 -->
            <!-- ログアウト -->
            <div class="btn-group pull-right">
                <div class="btn">
                    <a href="/logout">ログアウト</a>
                </div>
            </div>

            <!-- 部署名 -->
            <div id="loginUser" class="btn-group pull-right">
                <div ng-bind="pHeader.userName" class="ng-binding">{{ session('name') }}</div>
            </div>

        </div>


        <div class="app-body ng-scope">
            @yield('content')

        </div>
    </div>
    @if (session('err_message'))
        <span style="visibility:hidden" id="err_message">{{ session('err_message') }} </span>
    @endif
    <div id="alertDialog">
        <div id="modalRefine" class="modal hasJudeg ng-scope" ui-if="modalRefine" ui-state="modalRefine">
            <div class="modal-backdrop in"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="alert_title" class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <div id="alert_message" class="message"></div>
                        <div class="modal-footer text-center">
                            <button onclick="closeAlertDialog()" class="btn btn-primary">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('dialog')
    <script src="{{ asset('js/spinner.js') }}"></script>
    <script src="{{ asset('js/dialog.js') }}"></script>
    <script src="{{ asset('js/request.js') }}"></script>
    <input type=hidden id="csrf_token" value="{{ csrf_token() }}">
    @yield('javascript')
</body>

</html>
