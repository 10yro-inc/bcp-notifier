<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\NotificationLogs;
use App\Consts\BcpConsts;

class PushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->ReadXml();
    }

    private function ReadXml()
    {
        $response = Http::get($this->url);
        $xml_obj = simplexml_load_string($response->body());
        $entries = [];
        foreach ($xml_obj->entry as $entry) {
            if ($entry->title == BcpConsts::EARTHQUAKE_TITLE) {
                array_push($entries, $entry);

                NotificationLogs::firstOrCreate(
                    ['api_id' => $entry->id],
                    [
                        'api_type' => BcpConsts::API_TYPE_EARTHQUAKE,
                        'message' => $entry->content,
                        'notification_datetime' => (new \DateTime($entry->updated))
                    ]
                );
            }
        }


       // dd($entries);
        //  log(print_r($xml_obj->entry,true));
    }
}
