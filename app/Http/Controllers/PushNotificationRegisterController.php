<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\PushNotification;
class PushNotificationRegisterController extends Controller
{
    //

    public function index(){

        PushNotification::dispatch('https://www.data.jma.go.jp/developer/xml/feed/eqvol.xml');
    }
}
