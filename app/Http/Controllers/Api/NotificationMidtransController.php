<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotificationUserDonation;
use App\Mail\EmailNotificationUserProductDonationOrder;
use App\Models\DonationRecap;
use App\Models\ProductDonationOrder;
use App\Models\Setting;
use App\Models\UserDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class NotificationMidtransController extends Controller
{
    public function notification(Request $req)
    {
        try {
            $setting = Setting::first();
            $notification_body = json_decode($req->getContent(), true);

            $order_id = $notification_body['order_id'];
            $status_code = $notification_body['status_code'];
            $gross_amount = $notification_body['gross_amount'];
            $signature_key = $notification_body['signature_key'];
            $transaction_status = $notification_body['transaction_status'];

            $productDonationOrder = ProductDonationOrder::where('order_id', $order_id)->first();
            $userDonation = UserDonation::where('order_id', $order_id)->first();

            $hashed = hash('sha512', $order_id . $status_code . $gross_amount . config('app.MIDTRANS_SERVER_KEY'));

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

                        try {
                            Mail::to($productDonationOrder->email)->send(new EmailNotificationUserProductDonationOrder($productDonationOrder));
                        } catch (\Throwable $th) {
                        }

                        try {
                            if ($userDonation->whatsapp_number) {
                                Http::post(config('app.ENGINE_URL') . '/send-message', [
                                    'session' => 'myfra',
                                    'to' => $userDonation->whatsapp_number,
                                    'text' => "Halo " . $userDonation->fullname . ",\n\nDonasi Anda untuk Yayasan Bali Lestari Malik membawa sinar kehidupan baru bagi anak-anak di Palestina. Terima kasih telah menjadi bagian dari perubahan positif. Semoga kebaikan Anda kembali berkali-kali lipat.\n\nBerikut adalah detail donasi kamu:\n\nNama : " . $userDonation->fullname . "\n\nEmail : " . $userDonation->email . "\n\nNomor Whatsapp : " . $userDonation->whatsapp_number . "\n\nDonasi : " . "Produk Donasi" . "\n\nNominal Donasi : Rp" . number_format($userDonation->amount, 0, '.', '.') . "\n\nSalam Hangat " . $setting->company_name . ".\n\n Terima kasih!"
                                ]);
                            }
                        } catch (\Throwable $th) {
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
                }
            }

            return response('Ok', 200)->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            dd($e);
            return response('Error', 404)->header('Content-Type', 'text/plain');
        }
    }
}
