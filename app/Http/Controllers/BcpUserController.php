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
                $json = json_decode($user->BcpUserSetting->setting_json_value);
              
                fputcsv($stream, [
                    $user->user_cd,
                    array_key_exists($json->earthquake ,BcpConsts::EarthquakeList) ? BcpConsts::EarthquakeList[$json->earthquake] :"",   
                    array_key_exists($json->pref1 ,BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$json->pref1] :"", 
                    array_key_exists($json->pref2 ,BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$json->pref2] :"", 
                    array_key_exists($json->pref3 ,BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$json->pref3] :"", 
                    array_key_exists($json->pref4 ,BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$json->pref4] :"", 
                    array_key_exists($json->pref5 ,BcpConsts::PrefecturesList) ? BcpConsts::PrefecturesList[$json->pref5] :"", 
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
}
