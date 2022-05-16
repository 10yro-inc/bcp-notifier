<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyGroup;
use App\Models\CompanySetting;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company_cd', 'company_group_id','name'];

    Public function CompanyGroup()
    {
        return $this->hasOne(CompanyGroup::class, 'id','company_group_id');
    }

    Public function CompanySetting()
    {
        return $this->hasOne(CompanySetting::class, 'company_id','id');
    } 
}
