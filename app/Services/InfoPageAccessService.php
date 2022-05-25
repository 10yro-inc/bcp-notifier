<?php

namespace App\Services;

use App\Models\BcpUser;
use App\Models\BcpUserSetting;
use App\Models\Company;
use App\Consts\BcpConsts;
use Illuminate\Support\Facades\DB;

/**
 * 
 */
class InfoPageAccessService
{

    //
    public function save($param)
    {
        try {
            DB::beginTransaction();

            $company = InfoPageAccess::create([
                'user_cd'   => $params->user_cd,
                'company_cd'    =>  $params->company_cd,
                'notification_log_id'   =>  $params->notification_log_id,
            ]);

            DB::commit();

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
    }
}
