<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingCompanyController extends Controller
{
    public function index()
    {
        $data = Setting::first();
        $data->company_logo_url = url('/storage/settings/company-logo/' . $data->company_logo);

        return response()->json([
            'data' => $data
        ], 200);
    }
}
