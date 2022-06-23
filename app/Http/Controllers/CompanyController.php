<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    private $companyService;
    public function __construct()
    {

        $this->companyService = new CompanyService();
    }
    public function index(Request $request)
    {
        $user = session()->get('user');

        $list = $this->companyService->getComanies($user->id, $user->company_group_id, $user->is_super);

        $companyGroupList = $this->companyService->getComanyGroups();

        return view('company', ['list' => $list, 'companyGroupList' => $companyGroupList, 'is_super' => $user->is_super]);
    }


    public function add(Request $request)
    {
        $result  = [];

        if ($this->companyService->createCompany($request)) {
            session()->flash('err_message', '登録しました。');
        } else {
            session()->flash('err_message', '登録に失敗しました。');
        }
        return redirect(url('/company'));
    }

    public function update(Request $request)
    {
        $result  = [];

        if ($this->companyService->updateCompany($request)) {
            session()->flash('err_message', '更新しました。');
        } else {
            session()->flash('err_message', '更新に失敗しました。');
        }
        return redirect(url('/company'));
    }


    public function delete(Request $request)
    {
        $result  = [];

        if ($this->companyService->deleteCompany($request)) {
            session()->flash('err_message', '削除しました。');
        } else {
            session()->flash('err_message', '削除に失敗しました。');
        }
        return redirect(url('/company'));
    }
}
