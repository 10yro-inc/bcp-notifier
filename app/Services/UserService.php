<?php
 
namespace App\Services;
 
use App\Models\User;
 
/**
 * ログインユーザー関連サービス
 */
class UserService
{
  // ユーザー取得
  public function getUser($userCode)
  {
    return User::where('user_cd', $userCode)->first();
  }

}