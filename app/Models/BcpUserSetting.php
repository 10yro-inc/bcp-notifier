<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BcpUserSetting  extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bcp_user_id',
        'earthquake_cd',
        'pref1',
        'pref2',
        'pref3',
        'pref4',
        'pref5',
    ];

    public function BcpUser()
    {
        return $this->hasOne(BcpUser::class, 'id', 'bcp_user_id');
    }
}
