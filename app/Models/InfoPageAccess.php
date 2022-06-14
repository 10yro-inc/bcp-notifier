<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPageAccess extends Model
{
    use HasFactory;

    protected $fillable = [
        'bcp_user_id',
        'company_id',
        'notification_log_id',
        'accessed_at',
    ];

    public function bcpUser()
    {
        return $this->hasOne(BcpUser::class, 'id', 'bcp_user_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function notificationLog()
    {
        return $this->hasOne(NotificationLog::class, 'id', 'notification_log_id');
    }
}
