@extends('common.layout_header')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/company.css') }}">
@endsection
@section('title')
    BCPユーザー一覧
@endsection
@section('content')
    <div class="app-content">
        <div class="row table-count">

            <div class="text-right resultStats ng-binding">
                {{ count($list) }}件
            </div>
        </div>
        <input id="company_id" type="hidden" value="{{ $company_id }}">
        <div id="listData" class="stickyTable mBottom">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>会社コード</th>
                        <th>ユーザー名</th>
                        <th>通知先震度</th>
                        <th>通知先都道府県1</th>
                        <th>通知先都道府県2</th>
                        <th>通知先都道府県3</th>
                        <th>通知先都道府県4</th>
                        <th>通知先都道府県5</th>
                        <th>最終アクセス</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($list as $index => $bcpuser)
                        <tr>
                            <td class="text-right">{{ $index + 1 }}</td>
                            <td>{{ $bcpuser->company_cd }}</td>
                            <td>{{ $bcpuser->user_cd }}</td>
                            <td>{{ $bcpuser->earthquake }}</td>
                            <td>{{ $bcpuser->pref1 }}</td>
                            <td>{{ $bcpuser->pref2 }}</td>
                            <td>{{ $bcpuser->pref3 }}</td>
                            <td>{{ $bcpuser->pref4 }}</td>
                            <td>{{ $bcpuser->pref5 }}</td>
                            <td>{{ $bcpuser->accessed_at }}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row flexBottom mBottom">
            <div class="col-xs-12  text-center wrap_btn">
                <button type="button" onclick="history.back()" class="btn btn-primary large">戻る</button>
                <button type="button" onclick="exportClick()" class="btn btn-primary large">CSV出力</button>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/list.js') }}"></script>
    <script src="{{ asset('js/bcpuserlist.js') }}"></script>
@endsection
