<!DOCTYPE html>

<html lang="ja">
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

        <div class="app-body ng-scope">
            @yield('content')

        </div>
    </div>


    <div id="alertDialog">
        <div id="modalRefine" class="modal hasJudeg ng-scope" ui-if="modalRefine" ui-state="modalRefine">
            <div class="modal-backdrop in"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 id="alert_title" class="modal-title">認証エラー</h4>
                    </div>
                    <div class="modal-body">
                        <div id="alert_message" class="message">aaa</div>
                        <div class="modal-footer text-center">
                            <button onclick="closeAlertDialog()" class="btn btn-primary">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/spinner.js') }}"></script>
    <script src="{{ asset('js/dialog.js') }}"></script>
    @yield('javascript')
</body>

</html>
