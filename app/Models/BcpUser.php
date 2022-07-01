<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;


class BcpUser  extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_cd',
        'company_id',
    ];

    Public function BcpUserSetting()
    {
        return $this->hasOne(BcpUserSetting::class, 'bcp_user_id','id');
    }

    Public function BcpUserCompany()
    {
        return $this->hasOne(Company::class, 'id','company_id');
    } 

  
}
