@extends('common.layout')
@php
use App\Consts\BcpConsts;
@endphp
@section('css')
    <link rel="stylesheet" href="{{ asset('css/bcpuser.css') }}">
@endsection

@if (isset($aes_error) && $aes_error)
    @section('content')
        <div class="app-content flexCenter">
            URLが正しくありません。
        </div>
    @endsection
@else

    @section('content')
      <div class="flexleft"><a target="new" href="{{ asset('files/BCP通知管理ユーザーマニュアル_v1.pdf')}}" > 操作マニュアル</a></div>
        @if (session('message'))
            <span style="display:none" id="message">{{ session('message') }} </span>
        @endif

        <div class="app-content flexCenter">
            <form method="post" action="/bcp/setting" id="bcp_form">
                @csrf
                <h1 class="flexCenter">通知設定</h1>
                               <div class="row">
                    <div class="col-xs-2">
                        <label class="control-label">会社名</label>
                    </div>
                    <div class="col-xs-10">
                        <label>{{ $company_name }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-2">
                        <label class="control-label">会社コード</label>
                    </div>
                    <div class="col-xs-10">
                        <label>{{ $company_cd }}</label>
                        <input type="hidden" name="company_cd" value="{{ $company_cd }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-2">
                        <label class="control-label">ログイン名</label>
                    </div>
                    <div class="col-xs-10">
                        <label>{{ $user_cd }}</label>
                        <input type="hidden" name="user_cd" value="{{ $user_cd }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-2">
                        <label class="control-label">通知震度</label>
                    </div>
                    <div class="col-xs-10">
                        <select class="form-control" name="earthquake">
                            @foreach (BcpConsts::EarthquakeList as $no => $value)
                                @if (isset($earthquake) && $earthquake == $no)
                                    <option value="{{ $no }}" selected>{{ $value }}</option>
                                @else
                                    <option value="{{ $no }}">{{ $value }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

                @for ($i = 1; $i <= 5; $i++)
                    <div class="row">
                        <div class="col-xs-2">
                            <label class="control-label">通知都道府県{{ $i }}</label>
                        </div>
                        <div class="col-xs-10">
                            <select class="form-control" name="pref{{ $i }}">
                                <option value="">設定なし</option>
                                @foreach (BcpConsts::PrefecturesList as $no => $pref)
                                    @if (isset(${'pref' . $i}) && ${'pref' . $i} == $no)
                                        <option value="{{ $no }}" selected>{{ $pref }}</option>
                                    @else
                                        <option value="{{ $no }}">{{ $pref }}</option>
                                    @endif
                                @endforeach
                            </select>
                            </select>
                        </div>
                    </div>
                @endfor
                <input type="hidden" name="prame" value="{{ $param }}">
                <div id="frmLogin" class="text-center">
                    <button type="submit" class="btn btn-primary large">登録</button>
                </div>
                <div id="btn_test_notifiy" class="text-center">
                    <button type="button" class="btn btn-primary large" onclick="testNotifyClick()">テスト通知</button>
                </div>
            </form>
            

        </div>
    @endsection
@endif
@section('javascript')
    <script src="{{ asset('js/request.js') }}"></script>
    <script src="{{ asset('js/bcpuser.js') }}"></script>
    
@endsection
