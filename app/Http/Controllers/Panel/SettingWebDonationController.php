<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\ModelFileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\SettingWebDonation\UpdateRequest;
use App\Models\SettingWebDonation;
use Illuminate\Http\Request;

class SettingWebDonationController extends Controller
{
    public function index()
    {
        $data = [
            'setting' => SettingWebDonation::first()
        ];

        return view('panel.pages.setting-web-donation.edit', $data);
    }

    public function update(UpdateRequest $request)
    {
        $settingWebDonation = SettingWebDonation::first();

        $settingWebDonation->update([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => ModelFileUploadHelper::modelFileUpdate($settingWebDonation, 'thumbnail', $request->file('thumbnail'))
        ]);

        return back()->with('success', 'Setting Web Donasi, telah diupdate');
    }
}
