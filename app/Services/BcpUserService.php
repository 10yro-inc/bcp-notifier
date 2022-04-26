<?php

namespace App\Services;

use App\Models\BcpUser;
use App\Models\BcpUserSetting;
use App\Models\Company;

/**
 * ログインユーザー関連サービス
 */
class BcpUserService
{
  // ユーザー取得
  public function getUser($user_cd)
  {
    return BcpUser::where('user_cd', $user_cd)->first();
  }

  public function saveUser($param)
  {
    $user = $this->getUser($param->user_cd);
    $company = Company::where('company_cd', '=', $param->company_cd)->first();

    if (is_null($user)) {
      $user = BcpUser::create(['user_cd' => $param->user_cd, 'company_id' => $company->id]);
    }

    $json_data = ['earthquake' => $param->earthquake];
    for ($i = 1; $i <= 5; $i++) {
      $json_data['pref' . $i] = $param->{'pref' . $i};
    }

    BcpUserSetting::updateOrCreate(['bcp_user_id' => $user->id],['bcp_user_id' => $user->id,  'setting_json_value' => json_encode($json_data)]);

    return $user;
  }


  public function getUserExportList($company_id)
  {
    return BcpUser::where('company_id', $company_id);
  }
}
