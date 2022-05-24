<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\NotificationLog;
use App\Consts\BcpConsts;
use App\Services\BcpUserService;
use App\Library\Interface\ReadXmlInterface;

class PushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $xmlInterface;
    private $bcpUserService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ReadXmlInterface $xmlInterface)
    {
        $this->xmlInterface = $xmlInterface;
        $this->bcpUserService = new BcpUserService();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notificationLogs = $this->xmlInterface->ReadXml();
        foreach ($notificationLogs as $index => $notificationLog) {
            $this->push($notificationLog);
        }
    }

    private function push(NotificationLog $notificationLog)
    {
        $areas = json_decode($notificationLog->areas);
        $conpany_users = $this->bcpUserService->getPushUser($areas);
 
        foreach ($conpany_users as $company_cd => $settings) {
            $data['tenantCode'] =  $settings[0]->company_cd;
            $data['cooperationPassword'] = $settings[0]->cooperation_password;
            $data["message"] =  $settings[0]->push_notification;
            foreach ($settings  as $setting) {
                $data["notifications"][] = ['loginName' => $setting->user_cd];
            }
            // 通知先URL、APIが未対応の為、コメントアウト
            $data['data']['url'] = $settings[0]->info_page_url;
            $response = Http::post($settings[0]->api_url,  $data);
  
        }

  
    }
}
