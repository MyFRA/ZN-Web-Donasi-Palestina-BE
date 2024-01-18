<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\UserDonation;
use Illuminate\Http\Request;

class DonationPackagesCollectedController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'total' => UserDonation::where('status', 'success')->sum('amount'),
            'donations' => UserDonation::where('status', 'success')->orderBy('created_at', 'DESC')->paginate(10)
        ];

        return view('panel.pages.donation-packages-collected.index', $data);
    }

    public function update(Request $request)
    {
        dd('ok');
    }
}
