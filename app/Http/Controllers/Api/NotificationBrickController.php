<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotificationUserDonation;
use App\Models\DonationRecap;
use App\Models\ProductDonationOrder;
use App\Models\Setting;
use App\Models\UserDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class NotificationBrickController extends Controller
{
    public function notification(Request $request)
    {
        try {
            $merchantOrderId = isset($request['data']['referenceId']) ? $request['data']['referenceId'] : null;
            $setting = Setting::first();

            $productDonationOrder = ProductDonationOrder::where('order_id', $merchantOrderId)->first();
            $userDonation = UserDonation::where('order_id', $merchantOrderId)->first();

            // if ($productDonationOrder) {
            //     $productDonationOrder->update([
            //         'payment_status' => 'success',
            //         'shipment_status' => 'Payment Received'
            //     ]);

            //     if (!DonationRecap::where('foreign_id', $productDonationOrder->id)->where('type', 'product_donation_orders')->first()) {
            //         DonationRecap::create([
            //             'foreign_id' => $productDonationOrder->id,
            //             'fullname' => $productDonationOrder->full_name,
            //             'type' => 'product_donation_orders',
            //             'amount' => $productDonationOrder->total,
            //             'message' => $productDonationOrder->message
            //         ]);
            //     }
            // }

            if ($userDonation) {
                $userDonation->update([
                    'status' => 'success',
                    'payment_method' => $request['data']['bankShortCode']
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

                if ($userDonation->email) {
                    try {
                        Mail::to($userDonation->email)->send(new EmailNotificationUserDonation($userDonation));
                    } catch (\Throwable $th) {
                    }

                    try {
                        if ($userDonation->whatsapp_number) {
                            Http::post(config('app.ENGINE_URL') . '/send-message', [
                                'session' => 'myfra',
                                'to' => $userDonation->whatsapp_number,
                                'text' => "Halo " . $userDonation->fullname . ",\n\nDonasi Anda untuk Yayasan Bali Lestari Malik membawa sinar kehidupan baru bagi anak-anak di Palestina. Terima kasih telah menjadi bagian dari perubahan positif. Semoga kebaikan Anda kembali berkali-kali lipat.\n\nBerikut adalah detail donasi kamu:\n\nNama : " . $userDonation->fullname . "\n\nEmail : " . $userDonation->email . "\n\nNomor Whatsapp : " . $userDonation->whatsapp_number . "\n\nPaket Donasi : " . $userDonation->availableDonation->short_description . "\n\nNominal Donasi : Rp" . number_format($userDonation->amount, 0, '.', '.') . "\n\nSalam Hangat " . $setting->company_name . ".\n\n Terima kasih!"
                            ]);
                        }
                    } catch (\Throwable $th) {
                    }
                }
            }

            return response()->json([
                'data' => $userDonation
            ]);
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
