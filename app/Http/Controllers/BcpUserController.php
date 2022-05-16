<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CompanyService;
use App\Services\BcpUserService;
use App\Consts\BcpConsts;
use Illuminate\Support\Facades\Http;
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
            //$param = base64_decode($request->param);
            //if ($param  === false) {
            //    $result['aes_error'] = true;
            //}

            $param = $request->param;
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
            if (!is_null($bcpUser)) {
                $bcpUserSetting = $bcpUser->BcpUserSetting;
                if (!is_null($bcpUserSetting)) {

                    $result['earthquake'] = $bcpUserSetting->earthquake_cd;
                    $result['pref1'] = $bcpUserSetting->pref1;
                    $result['pref2'] = $bcpUserSetting->pref2;
                    $result['pref3'] = $bcpUserSetting->pref3;
                    $result['pref4'] = $bcpUserSetting->pref4;
                    $result['pref5'] = $bcpUserSetting->pref5;
                }
            }




            $result['param'] = $request->param;
            $result['company_cd'] = $company_cd;
            $result['user_cd'] = $user_cd;
        } catch (\Exception $e) {
            $result['aes_error'] = true;
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
            throw $e;
        }

        return redirect(url('/bcp/setting?param=' . $request->prame));
    }

    public function test_notify(Request $request)
    {

        $companies = $this->companyService->getCompany($request->company_cd);

        if (count($companies) !== 1) {
            $result['aes_error'] = true;
        }
        $company = $companies[0];

        $data['tenantCode'] =  $company->company_cd;
        $data['cooperationPassword'] = $company->CompanySetting->cooperation_password;
        $data["message"] =  $company->CompanySetting->push_notification;
        $data["notifications"][] = ['loginName' => $request->user_cd];
        //  $data['data'][] = ['url' =>  $company->CompanySetting->info_page_url];
        $response = Http::post($company->CompanySetting->api_url,  $data);
        session()->flash('message', ' テスト通知しました。');
        return redirect(url('/bcp/setting?param=' . $request->prame));
    }

    public function user_export(Request $request)
    {


        $callback = function () use ($request) {
            // 出力バッファをopen
            $stream = fopen('php://output', 'w');
            // 文字コードをShift-JISに変換
            stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
            // データ
            $users = $this->bcpUserService->getUserExportList($request->company_id);
            fputcsv($stream, [
                'ユーザー名',
                '通知震度',
                '通知都道府県1',
                '通知都道府県2',
                '通知都道府県3',
                '通知都道府県4',
                '通知都道府県5',
            ]);
            foreach ($users->cursor() as $user) {
                $setting = $user->BcpUserSetting;

                fputcsv($stream, [
                    $user->user_cd,
                    array_key_exists($setting->earthquake_cd, BcpConsts::EarthquakeList) ? BcpConsts::EarthquakeList[$setting->earthquake_cd] : "",
                    array_key_exists($setting->pref1, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref1] : "",
                    array_key_exists($setting->pref2, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref2] : "",
                    array_key_exists($setting->pref3, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref3] : "",
                    array_key_exists($setting->pref4, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref4] : "",
                    array_key_exists($setting->pref5, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref5] : "",
                ]);
            }
            fclose($stream);
        };


        // 保存するファイル名
        $filename = sprintf('userlist-%s.csv', date('YmdHis'));

        // ファイルダウンロードさせるために、ヘッダー出力を調整
        $header = [
            'Content-Type' => 'application/octet-stream',
        ];

        return response()->streamDownload($callback, $filename, $header);
    }


    public function user_list(Request $request)
    {

        $list = [];
        $users = $this->bcpUserService->getUserExportList($request->company_id);
        $company = $this->companyService->getCompanyById($request->company_id);


        foreach ($users->cursor() as $user) {
            $setting = $user->BcpUserSetting;

            $list[] = (object) [
                'earthquake' => array_key_exists($setting->earthquake_cd, BcpConsts::EarthquakeList) ? BcpConsts::EarthquakeList[$setting->earthquake_cd] : "",
                'user_cd' => $user->user_cd,
                'company_cd' => $company->company_cd,
                'pref1' =>  array_key_exists($setting->pref1, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref1] : "",
                'pref1' =>  array_key_exists($setting->pref1, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref1] : "",
                'pref2' =>  array_key_exists($setting->pref2, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref2] : "",
                'pref3' =>  array_key_exists($setting->pref3, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref3] : "",
                'pref4' =>  array_key_exists($setting->pref4, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref4] : "",
                'pref5' => array_key_exists($setting->pref5, BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$setting->pref5] : "",
            ];
        }

        return view('bcpuserlist', ['list' => $list, 'company_id' => $request->company_id]);
    }
}
