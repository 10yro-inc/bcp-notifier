<?php

namespace App\Services;

use App\Models\BcpUser;
use App\Models\BcpUserSetting;
use App\Models\Company;
use App\Consts\BcpConsts;
use App\Models\InfoPageAccess;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

/**
 * 
 */
class InfoPageAccessService
{

    //
    public function save($params)
    {
        try {
            DB::beginTransaction();

            InfoPageAccess::create([
                'bcp_user_id' => $params['bcp_user_id'],
                'company_id' => $params['company_id'],
                'notification_log_id' => $params['notification_log_id'],
                'accessed_at' => Carbon::now()
            ]);

            DB::commit();
            
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            echo($e);
            return false;
        }
    }

    public function search($condition)
    {
        return InfoPageAccess::where('company_id', '=', $condition->company_id)->orderBy('accessed_at', 'desc')->get();
    }
}
