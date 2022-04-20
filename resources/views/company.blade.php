@extends('common.layout_header')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/company.css') }}">
@endsection
@section('content')
    <div class="app-content">
        <div class="row table-count">
            <div class="col-xs-6 wrap_btn" ui-shared-state="">
                <button type="button" onclick="openFilterDialog()" class="btn btnOutlinePrimary"
                    ui-turn-on="modalRefine">ユーザー設定</button>
            </div>
            <div class="text-right resultStats ng-binding">
                20件
            </div>
        </div>

        <div id="listData" class="stickyTable mBottom">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>会社グループ</th>
                        <th>会社名</th>
                        <th>PUSH通知API</th>
                        <th>PUSH通知文章</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="">
                        <td class="text-right">1</td>
                        <td>組織A</td>
                        <td>会社A</td>
                        <td>https://example.com/api</td>
                        <td>震度5強以上、または大雨警報が発令されました</td>
                    </tr>
                    <tr class="">
                        <td class="text-right">2</td>
                        <td>組織A</td>
                        <td>会社B</td>
                        <td>https://example.com/api</td>
                        <td>震度5強以上、または大雨警報が発令されました</td>
                    </tr>
                    <tr class="">
                        <td class="text-right">3</td>
                        <td>組織A</td>
                        <td>会社C</td>
                        <td>https://example.com/api</td>
                        <td>震度5強以上、または大雨警報が発令されました</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row flexBottom mBottom">
            <div class="col-xs-12  text-center wrap_btn">
                <button type="button" onclick="openAddDialog()" class="btn btn-primary large">新規作成</button>
                <button type="button" onclick="openModDialog()" class="btn btn-primary large">変更</button>
                <button type="button" class="btn btn-primary large">削除</button>
            </div>
        </div>

    </div>
@endsection

@section('javascript')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection
