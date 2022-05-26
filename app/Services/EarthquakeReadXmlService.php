<?php

namespace App\Services;

use App\Models\User;
use App\Library\Interface;
use App\Library\Interface\ReadXmlInterface;
use Illuminate\Support\Facades\Http;

use App\Models\NotificationLog;
use App\Consts\BcpConsts;
use stdClass;

class EarthquakeReadXmlService implements ReadXmlInterface
{

    public function ReadXml()
    {
        error_log('#start EarthquakeReadXmlService#ReadXml');

        $response = Http::get(BcpConsts::EARTHQUAKE_API_URL);
        $xml_obj = simplexml_load_string($response->body());

        $notificationLogs = [];
        foreach ($xml_obj->entry as $entry) {
            if (strpos($entry->id, BcpConsts::EARTHQUAKE_XML_CODE) === false) {
                continue;
            }

            $detail = $this->ReadDetailXml($entry->link['href']);
            error_log('#ReadDetailXml');

            $notificationLog = NotificationLog::where('api_id', '=', $detail->event_id)->first();
            if (!is_null($notificationLog)) {
                continue;
            }

            $notificationLog = NotificationLog::create(
                [
                    'api_id' => $detail->event_id,
                    'api_type' => BcpConsts::API_TYPE_EARTHQUAKE,
                    'message' => $entry->content,
                    'areas' => json_encode($detail->areas),
                    'notification_datetime' => (new \DateTime($entry->updated))
                ]
            );
            $notificationLogs[] =  $notificationLog;

            error_log('#create NotificationLog');
        }
        return $notificationLogs;
    }

    private function ReadDetailXml($url)
    {
        $response = Http::get($url);

        $xml_obj = simplexml_load_string($response->body());
        $result  = new stdClass;
        $event_id = (string)$xml_obj->Head->EventID[0];
        $areas = [];

        foreach ($xml_obj->Body->Intensity->Observation->Pref as $pref) {
            if ((int)$pref->MaxInt >= 3) {
                $areas[] = (object) ["pref_code" =>  (string)$pref->Code, "pref_name" => (string) $pref->Name, "max_int" =>  (int)$pref->MaxInt];
            }
        }

        $result = (object) ['event_id' => $event_id, 'areas' => $areas];;
        return $result;
    }
}
