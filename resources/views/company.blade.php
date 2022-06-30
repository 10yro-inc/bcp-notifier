@extends('common.layout_header')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/company.css') }}">
@endsection
@section('title')
    会社一覧
@endsection
@section('content')
    <div class="app-content">
        <div class="row table-count">
            <div class="text-right resultStats ng-binding">
                {{ count($list) }}件
            </div>
        </div>

        <div id="listData" class="stickyTable mBottom">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>会社グループ</th>
                        <th>会社名</th>
                        <th>会社コード</th>
                        <th>PUSH通知API</th>
                        <th>PUSH通知文章</th>
                        <th>お知らせページ</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($list as $index => $company)
                        <tr class="" data-company_group_id="{{ $company->company_group_id }}"
                            data-company_id="{{ $company->company_id }}"
                            data-company_settings_id="{{ $company->company_settings_id }}"
                            data-cooperation_password="{{ $company->cooperation_password }}">
                            <td class="text-right">{{ $index + 1 }}</td>
                            <td id="group_name">{{ $company->company_group_name }}</td>
                            <td id="company_name">{{ $company->company_name }}</td>
                            <td id="company_cd">{{ $company->company_cd }}</td>
                            <td id="api_url">{{ $company->api_url }}</td>
                            <td id="push_notification">{{ $company->push_notification }}</td>
                            <td id="info_page_url">{{ $company->info_page_url }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="row flexBottom mBottom">
            <div class="col-xs-12  text-center wrap_btn">
                <button type="button" onclick="openAddDialog()" class="btn btn-primary large">新規作成</button>
                <button type="button" onclick="openModDialog()" class="btn btn-primary large">変更</button>
                <button type="button" onclick="openDeleteDialog()" class="btn btn-primary large">削除</button>
                <button type="button" onclick="userListClick()" class="btn btn-primary large">ユーザー一覧</button>
                <button type="button" onclick="accessesClick()" class="btn btn-primary large">アクセス履歴</button>
            </div>
        </div>

    </div>
@endsection
@section('dialog')
    <div ui-yield-to="modals" id="addDialog">
        <div id="modalRefine" class="modal hasJudeg ng-scope" ui-if="modalRefine" ui-state="modalRefine">
            <div class="modal-backdrop in"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">登録</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">会社グループ</label>
                            </div>
                            <div class="col-xs-10">
                                <select id="company_group_id" class="form-control" {{ $is_super ? '' : 'disabled' }}>
                                    @foreach ($companyGroupList as $index => $companyGroup)
                                        <option value="{{ $companyGroup->id }}">{{ $companyGroup->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">会社名</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="company_name" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">会社コード</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="company_cd" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">PUSH通知API</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="api_url" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">連携パスワード</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="password" id="cooperation_password" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">PUSH通知文章</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="push_notification" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">お知らせページURL</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="info_page_url" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer text-center">
                        <button onclick="addRegistClick()" class="btn btn-primary">登録</button>
                        <button onclick="cancelClick()" class="btn btn-default">キャンセル</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div ui-yield-to="modals" id="modDialog">
        <div id="modalRefine" class="modal hasJudeg ng-scope" ui-if="modalRefine" ui-state="modalRefine">
            <div class="modal-backdrop in"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">変更</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">会社グループ</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="group_name" class="form-control" disabled>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">会社名</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="company_name" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">会社コード</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="company_cd" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">PUSH通知API</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="api_url" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">連携パスワード</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="password" id="cooperation_password" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">PUSH通知文章</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="push_notification" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-2">
                                <label class="control-label">お知らせページURL</label>
                            </div>
                            <div class="col-xs-10">
                                <input type="text" id="info_page_url" class="form-control">
                            </div>
                        </div>
                        <input type="hidden" id="company_id" value="">
                        <input type="hidden" id="company_settings_id" value="">
                        <input type="hidden" id="company_group_id" value="">
                    </div>
                    <div class="modal-footer text-center">
                        <button onclick="modRegistClick()" class="btn btn-primary">更新</button>
                        <button onclick="cancelClick()" class="btn btn-default">キャンセル</button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div ui-yield-to="modals" id="deleteDialog">
        <div id="modalRefine" class="modal hasJudeg ng-scope" ui-if="modalRefine" ui-state="modalRefine">
            <div class="modal-backdrop in"></div>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">削除</h4>
                    </div>
                    <div class="modal-body">
                        <div id="delete_message">削除しますが、よろしいですか？</div>
                    </div>
                    <div class="modal-footer text-center">
                        <button onclick="deleteClick()" class="btn btn-primary">OK</button>
                        <button onclick="cancelClick()" class="btn btn-default">キャンセル</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script src="{{ asset('js/list.js') }}"></script>
    <script src="{{ asset('js/company.js') }}"></script>
@endsection
