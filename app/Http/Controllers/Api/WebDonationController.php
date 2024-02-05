<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SettingWebDonation;
use App\Models\SettingWebDonationHasThumbnail;
use Illuminate\Http\Request;

class WebDonationController extends Controller
{
    public function show()
    {
        $data = SettingWebDonation::first();

        $thumbnails = SettingWebDonationHasThumbnail::orderBy('id', 'ASC')->get()->map(function ($item) {
            $item->thumbnail = url('/storage/setting-web-donation-has-thumbnails/thumbnail/' . $item->thumbnail);

            return $item;
        });

        $data->thumbnails = $thumbnails;

        return response()->json([
            'data' => $data
        ]);
    }
}
