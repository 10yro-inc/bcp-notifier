<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\PushNotification;
use App\Services\EarthquakeReadXmlService;
class PushNotificationRegisterController extends Controller
{
    //

    public function index(){

        PushNotification::dispatch(new EarthquakeReadXmlService());
    }
}
