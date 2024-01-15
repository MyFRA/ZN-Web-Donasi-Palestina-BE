<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Donation\RequestDonateRequest;
use App\Models\AvailableDonation;
use App\Models\UserDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function requestDonate(RequestDonateRequest $request)
    {
        if (!$request->is_fullname_hidden && !$request->fullname) {
            return response()->json([
                "code" => 422,
                "msg" => "Error Validations",
                "error" => "Nama harus diisi"
            ], 422);
        }

        $donationObj = AvailableDonation::find($request->donation_id);

        if ($donationObj->value == 'lainnya' && (!$request->custom_value || !intval($request->custom_value) || intval($request->custom_value) < 50000)) {
            return response()->json([
                "code" => 422,
                "msg" => "Error Validations",
                "error" => "Jumlah custom harus minimal Rp 50 rb"
            ], 422);
        }

        $midtrans_admin_fee = 4440;

        $userDonation = UserDonation::create([
            'order_id' => Str::uuid(),
            'amount' => $donationObj->value == 'lainnya' ? intval($request->custom_value) : $donationObj->value,
            'fullname' => $request->is_fullname_hidden ? 'Dermawan' : $request->fullname,
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
            'message' => $request->message,
            'payment_method' => null,
            'platform_payment_method' => 'midtrans',
            'status' => 'pending'
        ]);

        \Midtrans\Config::$serverKey = 'SB-Mid-server-kSn45BmXwof5hFAYs866zJ9s';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $orderId = $userDonation->order_id;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => intval($request->amount + $midtrans_admin_fee),
            ],
            'customer_details' => [
                'username' => $userDonation->fullname,
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'msg' => 'success',
            'token' => $snapToken,
            'uuid' => $orderId
        ]);
    }
}
