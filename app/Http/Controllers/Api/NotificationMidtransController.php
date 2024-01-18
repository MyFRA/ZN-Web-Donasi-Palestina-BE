<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonationRecap;
use App\Models\ProductDonationOrder;
use App\Models\UserDonation;
use Illuminate\Http\Request;

class NotificationMidtransController extends Controller
{
    public function notification(Request $req)
    {
        try {
            $notification_body = json_decode($req->getContent(), true);

            $order_id = $notification_body['order_id'];
            $status_code = $notification_body['status_code'];
            $gross_amount = $notification_body['gross_amount'];
            $signature_key = $notification_body['signature_key'];
            $transaction_status = $notification_body['transaction_status'];

            $productDonationOrder = ProductDonationOrder::where('order_id', $order_id)->first();
            $userDonation = UserDonation::where('order_id', $order_id)->first();

            $hashed = hash('sha512', $order_id . $status_code . $gross_amount . 'SB-Mid-server-kSn45BmXwof5hFAYs866zJ9s');

            if ($hashed == $signature_key && $transaction_status == 'settlement') {

                if (!$userDonation && !$productDonationOrder) {
                    return ['code' => 0, 'message' => 'Terjadi kesalahan | Pembayaran tidak valid'];
                }

                if ($status_code == 200 || $status_code == 201) {
                    if ($productDonationOrder) {

                        $productDonationOrder->update([
                            'payment_status' => 'success',
                            'shipment_status' => 'Payment Received'
                        ]);

                        if (!DonationRecap::where('foreign_id', $productDonationOrder->id)->where('type', 'product_donation_orders')->first()) {
                            DonationRecap::create([
                                'foreign_id' => $productDonationOrder->id,
                                'fullname' => $productDonationOrder->full_name,
                                'type' => 'product_donation_orders',
                                'amount' => $productDonationOrder->total,
                                'message' => $productDonationOrder->message
                            ]);
                        }
                    }

                    if ($userDonation) {
                        $userDonation->update([
                            'status' => 'success',
                            'payment_method' => $notification_body['va_numbers'][0]['bank']
                        ]);

                        if (!DonationRecap::where('foreign_id', $userDonation->id)->where('type', 'user_donations')->first()) {
                            DonationRecap::create([
                                'foreign_id' => $userDonation->id,
                                'fullname' => $userDonation->fullname,
                                'type' => 'user_donations',
                                'amount' => $userDonation->amount,
                                'message' => $userDonation->message
                            ]);
                        }
                    }
                }
            }

            return response('Ok', 200)->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            return response('Error', 404)->header('Content-Type', 'text/plain');
        }
    }
}
