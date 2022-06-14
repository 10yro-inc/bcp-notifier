@extends('common.layout_header')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/info-page-access-list.css') }}">
@endsection
@section('title')
    アクセス履歴
@endsection
@section('content')
    <div class="app-content">
        <div class="row table-count">

            <div class="text-right resultStats">
                {{ count($list) }}件
            </div>
        </div>
        <input id="company_id" type="hidden" value="{{ $company_id }}">
        <div id="listData" class="stickyTable mBottom">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>アクセス日時</th>
                        <th>会社コード</th>
                        <th>ユーザー名</th>
                        <th>メッセージ</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($list as $index => $l)
                        <tr>
                            <td>{{ $l->accessed_at }}</td>
                            <td>{{ $l->company_cd }}</td>
                            <td>{{ $l->user_cd }}</td>
                            <td>{{ $l->message }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row flexBottom mBottom">
            <div class="col-xs-12  text-center wrap_btn">
                <button type="button" onclick="history.back()" class="btn btn-primary large">戻る</button>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/list.js') }}"></script>
    <script src="{{ asset('js/bcpuserlist.js') }}"></script>
@endsection
