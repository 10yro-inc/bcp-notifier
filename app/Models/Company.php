<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CompanyGroup;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['company_cd', 'company_group_id','name'];

    Public function CompanyGroup()
    {
        return $this->hasOne(CompanyGroup::class, 'id','company_group_id');
    } 
}
