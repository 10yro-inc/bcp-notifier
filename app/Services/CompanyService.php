<?php

namespace App\Services;

use App\Models\CompanyGroup;
use App\Models\User;
use App\Models\UserCompany;
use App\Models\Company;
use App\Models\CompanySetting;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

/**
 * 会社関連サービス
 */
class CompanyService
{
    // 会社設定一覧取得
    public function getComanies($companyGroupid, $isAll = false)
    {

        $query = DB::table('companies')
            ->join('company_groups', 'companies.company_group_id', '=', 'company_groups.id')
            ->leftjoin('company_settings', 'companies.id', '=', 'company_settings.company_id');

        if (!$isAll) {
            $query->join('users', 'companies.company_group_id', '=', 'users.company_group_id')
                ->where('companies.company_group_id', '=', $companyGroupid);
        }
        $query->select([
            'company_settings.id as company_settings_id',
            'companies.id as company_id',
            'companies.company_group_id',
            'company_groups.name as company_group_name',
            'companies.name as company_name',
            'company_settings.api_url',
            'company_settings.cooperation_password',
            'company_settings.push_notification',
            'company_cd',
        ])
            ->orderBy('company_group_name')
            ->orderBy('company_name');
        //dd($query->toSql(), $query->getBindings());
        // $companies = $query->get();
        
        return $query->get();
    }


    // 会社設定一覧取得
    public function getComanyGroups()
    {
        return CompanyGroup::with("Companies")->get();
    }


    public function getCompany($company_cd)
    {
        return Company::where('company_cd', '=', $company_cd)->get();
    }

    public function getCompanyById($company_id)
    {
        return Company::find($company_id);
    }


    public function createCompany($params)
    {
        try {
            DB::beginTransaction();

            $company = Company::create([
                'name'     => $params->company_name,
                'company_cd'    =>  $params->company_cd,
                'company_group_id' =>  $params->company_group_id,
            ]);

            CompanySetting::create([
                'company_id'     =>  $company->id,
                'api_url'    => $params->api_url,
                'cooperation_password' => $params->cooperation_password,
                'push_notification' => $params->push_notification,
            ]);

            DB::commit();
            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
    }


    public function updateCompany($params)
    {
        try {
            DB::beginTransaction();

            $company = Company::find($params->company_id);

            if (is_null($company)) {
                return false;
            }

            $company->company_cd = $params->company_cd;
            $company->save();


            $companySetting = CompanySetting::find($params->company_settings_id);

            if (is_null($companySetting)) {
                CompanySetting::create([
                    'company_id'     =>  $company->id,
                    'api_url'    => $params->api_url,
                    'cooperation_password' => $params->cooperation_password,
                    'push_notification' => $params->push_notification,
                ]);
            } else {
                $companySetting->api_url = $params->api_url;
                $companySetting->cooperation_password = $params->cooperation_password;
                $companySetting->push_notification = $params->push_notification;
                $companySetting->save();
            }

            DB::commit();

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
    }

    public function deleteCompany($params)
    {
        try {
            DB::beginTransaction();
            $company = Company::find($params->company_id);
            if (is_null($company)) {
                return false;
            }

            $company->forceDelete();
            $companySetting = CompanySetting::find($params->company_settings_id);

            if (is_null($companySetting)) {
                return false;
            }
            $companySetting->forceDelete();

            DB::commit();

            return true;
        } catch (\Throwable $e) {
            DB::rollBack();

            return false;
        }
    }
}
