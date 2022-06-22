<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationExecutionLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_log_id',
        'bcp_user_id',
    ];

    public function notificationLog()
    {
        return $this->hasOne(NotificationLog::class, 'id', 'notification_log_id');
    }
}
