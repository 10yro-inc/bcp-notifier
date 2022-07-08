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
use App\Models\NotificationExecutionLogs;

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
        error_log('#start PushNotification');

        $notificationLogs = $this->xmlInterface->ReadXml();
        foreach ($notificationLogs as $index => $notificationLog) {
            $this->push($notificationLog);
        }
    }

    private function push(NotificationLog $notificationLog)
    {
        error_log('#start push');

        $areas = json_decode($notificationLog->areas);
        $conpany_users = $this->bcpUserService->getPushUser($areas);
 
        foreach ($conpany_users as $company_cd => $settings) {
            $data = [];
            $data['tenantCode'] =  $settings[0]->company_cd;
            $data['cooperationPassword'] = $settings[0]->cooperation_password;
            $data["message"] =  $settings[0]->push_notification;
            foreach ($settings  as $setting) {
                $data["notifications"] = [];
                $data["notifications"][] = ['loginName' => $setting->user_cd];
                $data['data']['url'] = url("/bcp/info?company_cd={$settings[0]->company_cd}&user_cd={$setting->user_cd}&notification_log_id={$notificationLog->id}");
                // PUSH通知 API呼び出し
                Http::post($settings[0]->api_url, $data);
                // PUSH通知実行ログ登録
                NotificationExecutionLogs::create(
                    [
                        'notification_log_id' => $notificationLog->id,
                        'bcp_user_id' => $setting->id,
                    ]
                );
                error_log('#push post');
            }


        } 
    }
}
