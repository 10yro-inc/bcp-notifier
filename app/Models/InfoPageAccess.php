<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPageAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_cd',
        'company_cd',
        'notification_log_id'
    ];
}
