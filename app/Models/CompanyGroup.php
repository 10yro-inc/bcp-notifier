<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyGroup extends Model
{
    use HasFactory;
    protected $fillable = ['name'];


    public function Companies()
    {
        return $this->hasMany('App\Models\Company','company_group_id','id');
    }
}
