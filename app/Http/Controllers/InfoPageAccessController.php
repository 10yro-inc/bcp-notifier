<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use App\Services\BcpUserService;
use App\Services\InfoPageAccessService;
use Illuminate\Http\Request;

class InfoPageAccessController extends Controller
{
    private $companyService;
    private $bcpUserService;
    private $infoPageAccessService;

    //
    public function __construct()
    {
        $this->companyService = new CompanyService();
        $this->bcpUserService = new BcpUserService();
        $this->infoPageAccessService = new InfoPageAccessService();
    }

    /**
     * アクセログを記録し、お知らせページへリダイレクトする
     */
    public function log(Request $request)
    {
        $companies = $this->companyService->getCompany($request->company_cd);
        if (count($companies) !== 1) {
            return;
        }

        $bcpUser = $this->bcpUserService->getUser($request->user_cd,$request->company_cd);
        if ($bcpUser) {
            // userが取得できたらアクセスログを登録する
            try {
                $this->infoPageAccessService->save(['company_id' => $companies[0]->id, 'bcp_user_id' => $bcpUser->id, 'notification_log_id' => $request->notification_log_id]);
            } catch (\Exception $e) {
                error_log('error {$e}');
            }
        }

        // info page urlを取得
        $info_page_url = $companies[0]->CompanySetting->info_page_url;

        return redirect($info_page_url); 
    }

    /**
     * アクセログの検索
     */
    public function search(Request $request)
    {
        $list = [];
        
        // 検索
        $searchResults = $this->infoPageAccessService->search($request);

        foreach ($searchResults as $r)
        {
            $list[] = (object)[
                'company_cd' => $r->company->company_cd,
                'user_cd' => $r->bcpUser->user_cd,
                'accessed_at' => $r->accessed_at,
                'message' => $this->getMessage($r)
            ];
        }

        return view('info_page_access_list', ['list' => $list, 'company_id' => $request->company_id]);
        //return view('info_page_access_list', ['list' => collect($list)->paginate(env('PAGE_COUNT', 10)), 'company_id' => $request->company_id]);
    }

    /**
     * メッセージ取得
     */
    private function getMessage($searchResult)
    {
        if ($searchResult->notification_log_id == 0)
        {
            return 'テスト通知';
        }

        return $searchResult->notificationLog->message ?? null;
    }
}
