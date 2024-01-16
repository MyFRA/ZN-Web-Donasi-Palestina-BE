<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductDonationOrder;
use App\Models\UserDonation;
use Illuminate\Http\Request;

class RecapDonationController extends Controller
{
    public function getDonationCollected()
    {
        return response()->json([
            'data' => [
                'amount_donation' => UserDonation::where('status', 'success')->sum('amount') + ProductDonationOrder::where('payment_status', 'success')->sum('total'),
                'amount_donatur' => UserDonation::where('status', 'success')->count() + ProductDonationOrder::where('payment_status', 'success')->count()
            ]
        ]);
    }
}
