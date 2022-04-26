<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Services\BcpUserService;
use App\Consts\BcpConsts;
use Illuminate\Support\Str;

class BcpUserController extends Controller
{

    private $companyService;
    private $bcpUserService;
    public function __construct()
    {

        $this->companyService = new CompanyService();
        $this->bcpUserService = new BcpUserService();
    }
    public function index(Request $request)
    {

        $result = ['aes_error' => false];
        try {
            // 複合する
            $param = openssl_decrypt($request->param, 'AES-256-ECB', BcpConsts::CryptKey, 0);
            if ($param  === false) {
                $result['aes_error'] = true;
            }

            $segments = Str::of($param)->split('/,/');

            if ($segments->count() !== 2) {
                $result['aes_error'] = true;
            }

            $company_cd = $segments[0];

            $user_cd = $segments[1];
            $companies = $this->companyService->getCompany($company_cd);

            if (count($companies) !== 1) {
                $result['aes_error'] = true;
            }

            $bcpUser =  $this->bcpUserService->getUser($user_cd);
            $bcpUserSetting = $bcpUser->BcpUserSetting;

            if (!is_null($bcpUser)  && !is_null($bcpUserSetting)) {
                $settings = json_decode($bcpUserSetting->setting_json_value, true);
                $result = array_merge($result, $settings);
            }

            $result['param'] = $request->param;
            $result['company_cd'] = $company_cd;
            $result['user_cd'] = $user_cd;
        } catch (\Exception $e) {
            $result['aes_error'] = true;
            throw $e;
        }


        return view('bcpuser', $result);
    }

    public function register(Request $request)
    {
        try {
            $bcpUser =  $this->bcpUserService->saveUser($request);
            session()->flash('message', ' 登録しました。');
        } catch (\Exception $e) {
            session()->flash('message', ' 登録に失敗しました。');
        }



        return redirect(url('/bcp/setting?param=' . $request->prame));
    }
}
