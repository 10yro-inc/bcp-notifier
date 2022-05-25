<?php

namespace App\Http\Controllers;

use App\Services\CompanyService;
use App\Services\InfoPageAccessService;
use Illuminate\Http\Request;

class InfoPageController extends Controller
{
    private $companyService;
    private $infoPageAccessService;

    //
    public function __construct()
    {
        $this->companyService = new CompanyService();
        $this->infoPageAccessService = new InfoPageAccessService();
    }

    //
    public function index(Request $request)
    {
        $companies = $this->companyService->getCompany($request->company_cd);

        if (count($companies) !== 1) {
            return;
        }

        try {
            $infoPageAccess =  $this->infoPageAccessService->save($request);
        } catch (\Exception $e) {
        }

        // info page url
        $info_page_url = $companies[0]->CompanySetting->info_page_url;

        return redirect($info_page_url); 
    }
}