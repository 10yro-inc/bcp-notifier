
<?php $is_production = env('APP_ENV') === 'production' ? true : false; ?>
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
	<link rel="stylesheet" href="{{ asset('css/normalize.css',  $is_production ) }}">
    <link rel="stylesheet" href="{{ asset('css/common.css', $is_production ) }}">



	<!-- ***************** -->
	<!-- その他            -->
	<!-- ***************** -->
	<title>BCP通知管理システム</title>

<body>
	<!-- 各ページ読み込み -->


    

	<div class="app">
    
		<div class="app-body ng-scope">
        @yield('content')

		</div>
	</div>

</div>


	
	<!-- ***************** -->
	<!-- javascript        -->
	<!-- ***************** -->
	
	<script src="./js/mockoup.js"></script>
</body>


</html>