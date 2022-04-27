<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationLogs extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'api_id',
        'api_type',
        'message',
        'notification_datetime',
    ];

}
