<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SettingWebDonation;
use Illuminate\Http\Request;

class WebDonationController extends Controller
{
    public function show()
    {
        $data = SettingWebDonation::first();

        $data->thumbnail = url('/storage/setting-web-donations/thumbnail/' . $data->thumbnail);

        return response()->json([
            'data' => $data
        ]);
    }
}
