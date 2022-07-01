<?php

namespace App\Services;

use App\Models\BcpUser;
use App\Models\BcpUserSetting;
use App\Models\Company;
use App\Consts\BcpConsts;
use App\Models\InfoPageAccess;
use Illuminate\Support\Facades\DB;

/**
 * ログインユーザー関連サービス
 */
class BcpUserService
{
  // ユーザー取得
  public function getUser($user_cd, $company_cd)
  {

    $company = Company::where('company_cd', $company_cd)->first();
    if (is_null($company)) {
      return null;
    }
    return BcpUser::where('user_cd', $user_cd)
      ->where('company_id', $company->id)
      ->first();
  }

  public function saveUser($param)
  {

    try {
      DB::beginTransaction();
      $user = $this->getUser($param->user_cd, $param->company_cd);
      $company = Company::where('company_cd', '=', $param->company_cd)->first();
 
      if (is_null($user)) {
        $user = BcpUser::create(['user_cd' => $param->user_cd, 'company_id' => $company->id]);
      }
      $update_data['bcp_user_id'] = $user->id;
      $update_data['earthquake_cd'] = $param->earthquake;
      for ($i = 1; $i <= 5; $i++) {
        $update_data['pref' . $i] = $param->{'pref' . $i};
      }
      BcpUserSetting::updateOrCreate(['bcp_user_id' => $user->id], $update_data);
      DB::commit();
      return $user;
    } catch (\Exception $e) {
      DB::rollBack();
      throw $e;
    }
  }

  public function getUserExportList($company_id, $is_all = false)
  {
    $infoPageAccess = InfoPageAccess::groupBy('bcp_user_id')->selectRaw('MAX(accessed_at) As accessed_at, bcp_user_id');
    if (!$is_all) {
      $infoPageAccess->where('company_id', $company_id);
    }

    $query = DB::table('bcp_users')
    ->join('bcp_user_settings', 'bcp_users.id', '=', 'bcp_user_settings.bcp_user_id')
    ->join('companies', 'bcp_users.company_id', '=', 'companies.id')
    ->join(DB::raw('(' . $infoPageAccess->toSql() . ') AS InfoPageAccess'), 'bcp_users.id', '=', 'InfoPageAccess.bcp_user_id');
   
    if (!$is_all) {
      $query->setBindings([':company_id' => $company_id]);
      $query->where('company_id', $company_id);
    }
  // dd($query->get());
    return  $query->get();
  }

  public function getPushUser($areas)
  {

    $intMaxs = [];
    foreach ($areas as $index => $area) {
      if ($area->max_int >= 5) {
        $intMaxs[BcpConsts::EARTHQUAKE_INT5][] = $area->pref_code;
      } elseif ($area->max_int >= 4) {
        $intMaxs[BcpConsts::EARTHQUAKE_INT4][] = $area->pref_code;
      } elseif ($area->max_int >= 3) {
        $intMaxs[BcpConsts::EARTHQUAKE_INT3][] = $area->pref_code;
      }
    }

    $query = DB::table('bcp_users')
      ->join('bcp_user_settings', 'bcp_users.id', '=', 'bcp_user_settings.bcp_user_id')
      ->join('companies', 'bcp_users.company_id', '=', 'companies.id')
      ->join('company_settings', 'bcp_users.company_id', '=', 'company_settings.company_id');

    foreach ($intMaxs  as $intMax => $prefs) {
      for ($i = 1; $i <= 5; $i++) {
        $query->orWhere(function (\Illuminate\Database\Query\Builder $query) use ($intMax, $prefs, $i) {
          array_push($prefs, 0);
          $query->where('earthquake_cd', '=', $intMax)
            ->WhereIn('pref' . (string)$i, $prefs);
        });
      }
    }
    $query->select([
      'company_settings.api_url', 'companies.company_cd', 'company_settings.push_notification', 'company_settings.cooperation_password', 'company_settings.info_page_url', 'bcp_users.user_cd', 'bcp_users.id'
    ]);

    $rows = $query->get();
    $company_users = [];
    foreach ($rows as $row) {
      $company_users[$row->company_cd][] =  $row;
    }

    return  $company_users;
  }
}
