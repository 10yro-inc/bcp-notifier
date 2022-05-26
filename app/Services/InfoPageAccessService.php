<?php

namespace App\Services;

use App\Models\BcpUser;
use App\Models\BcpUserSetting;
use App\Models\Company;
use App\Consts\BcpConsts;
use App\Models\InfoPageAccess;
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
            error_log('#start InfoPageAccessService#save');

            DB::beginTransaction();

            $infoPageAccess = InfoPageAccess::create([
                'user_cd'   => $params->user_cd,
                'company_cd'    => $params->company_cd,
                'notification_log_id'   => $params->notification_log_id,
            ]);

            DB::commit();

            error_log('#end InfoPageAccessService#save');

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            error_log($e);
            return false;
        }
    }
}
