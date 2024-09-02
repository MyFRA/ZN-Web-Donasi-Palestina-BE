<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\ModelFileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\SettingWebDonation\AddThumbnailRequest;
use App\Http\Requests\Panel\SettingWebDonation\UpdateRequest;
use App\Models\SettingWebDonation;
use App\Models\SettingWebDonationHasThumbnail;
use Illuminate\Http\Request;

class SettingWebDonationController extends Controller
{
    public function index()
    {
        $data = [
            'setting' => SettingWebDonation::first(),
            'thumbnails' => SettingWebDonationHasThumbnail::orderBy('id', 'ASC')->get()
        ];

        return view('panel.pages.setting-web-donation.edit', $data);
    }

    public function update(UpdateRequest $request)
    {
        $settingWebDonation = SettingWebDonation::first();

        $settingWebDonation->update([
            'title' => $request->title,
            'description' => $request->description,
            'donation_target' => $request->donation_target,
        ]);

        return back()->with('success', 'Setting Web Donasi, telah diupdate');
    }

    public function addThumbnail(AddThumbnailRequest $request)
    {
        $settingWebDonation = SettingWebDonation::first();

        SettingWebDonationHasThumbnail::create([
            'setting_web_donation_id' => $settingWebDonation->id,
            'thumbnail' => ModelFileUploadHelper::modelFileStore('setting-web-donation-has-thumbnails', 'thumbnail', $request->file('thumbnail'))
        ]);

        return back()->with('success', 'Thumbnail telah ditambahkan');
    }

    public function deleteThumbnail(Request $request, $id)
    {
        $thumbnail = SettingWebDonationHasThumbnail::find($id);
        ModelFileUploadHelper::modelFileDelete($thumbnail, 'thumbnail');

        $thumbnail->delete();

        return back()->with('success', 'Thumbnail telah dihapus');
    }
}
