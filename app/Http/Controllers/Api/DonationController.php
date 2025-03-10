<?php

namespace App\Http\Controllers\Api;

use App\Helpers\BrickHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Donation\RequestDonateRequest;
use App\Models\AvailableDonation;
use App\Models\UserDonation;
use Exception;
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

        if ($donationObj->value == 'lainnya' && (!$request->custom_value || !intval($request->custom_value) || intval($request->custom_value) < 100000)) {
            return response()->json([
                "code" => 422,
                "msg" => "Error Validations",
                "error" => "Jumlah custom harus minimal Rp 100 rb"
            ], 422);
        }


        $userDonation = UserDonation::create([
            'order_id' => Str::uuid(),
            'package_item_price' => $donationObj->value == 'lainnya' ? intval($request->custom_value) : $donationObj->value,
            'amount' => $donationObj->value == 'lainnya' ? intval($request->custom_value) : $donationObj->value * $request->amount_package,
            'fullname' => $request->is_fullname_hidden ? 'Dermawan' : $request->fullname,
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
            'message' => $request->message,
            'payment_method' => null,
            'platform_payment_method' => 'brick',
            'status' => 'pending',
            'available_donation_id' => $request->donation_id,
            'amount_package' => $request->amount_package
        ]);

        $orderId = $userDonation->order_id;

        return response()->json([
            'data' => $this->requestDonateWithBrick($orderId, $donationObj, $request, $userDonation, $request->short_bank_code)
        ]);
    }

    private function requestDonateWithBrick($orderId, $donationObj, $request, $userDonation, $bankShortCode)
    {
        $jwtBrickToken = BrickHelper::generateJwtToken();

        return BrickHelper::createCloseVa($jwtBrickToken, $orderId, $userDonation, $bankShortCode);
    }

    private function requestDonateWithDuitku($orderId, $donationObj, $request, $userDonation)
    {
        $duitkuConfig = new \Duitku\Config(config('app.DUITKU_MERCHANT_KEY'), config('app.DUITKU_MERCHANT_CODE'));
        // false for production mode
        // true for sandbox mode
        $duitkuConfig->setSandboxMode(true);
        // set sanitizer (default : true)
        $duitkuConfig->setSanitizedMode(false);
        // set log parameter (default : true)
        $duitkuConfig->setDuitkuLogs(false);

        $duitku_admin_fee   = 4400;
        $paymentAmount      = intval(($donationObj->value == 'lainnya' ? intval($request->custom_value) : $donationObj->value * $userDonation->amount_package) + $duitku_admin_fee = 4400); // Amount
        $email              = $request->email; // your customer email
        $phoneNumber        = $request->whatsapp_number; // your customer phone number (optional)
        $productDetails     = "Donasi Palestine";
        $merchantOrderId    = $orderId; // from merchant, unique   
        $additionalParam    = ''; // optional
        $merchantUserInfo   = ''; // optional
        $customerVaName     = $request->is_fullname_hidden ? 'Dermawan' : $request->fullname; // display name on bank confirmation display
        $callbackUrl        = url('/api/notification-duitku'); // url for callback
        $returnUrl          = config('app.WEB_CLIENT_URL') . '/success'; // url for redirect
        $expiryPeriod       = 60; // set the expired time in minutes

        // Customer Detail
        $firstName          = $request->is_fullname_hidden ? 'Dermawan' : $request->fullname;
        $lastName           = "";

        // Address
        $alamat             = "Jl. Kembangan Raya";
        $city               = "Jakarta";
        $postalCode         = "11530";
        $countryCode        = "ID";

        $address = array(
            'firstName'     => $firstName,
            'lastName'      => $lastName,
            'address'       => $alamat,
            'city'          => $city,
            'postalCode'    => $postalCode,
            'phone'         => $phoneNumber,
            'countryCode'   => $countryCode
        );

        $customerDetail = array(
            'firstName'         => $firstName,
            'lastName'          => $lastName,
            'email'             => $email,
            'phoneNumber'       => $phoneNumber,
            'billingAddress'    => $address,
            'shippingAddress'   => $address
        );

        $itemDetails = [
            [
                'price' => $donationObj->value == 'lainnya' ? $request->custom_value : $donationObj->value * $userDonation->amount_package,
                'quantity' => 1,
                'name' => $donationObj->short_description
            ],
            [
                'price' => $duitku_admin_fee,
                'quantity' => 1,
                'name' => 'Biaya Admin Bank'
            ]
        ];

        $params = array(
            'paymentAmount'     => $paymentAmount,
            'merchantOrderId'   => $merchantOrderId,
            'productDetails'    => $productDetails,
            'additionalParam'   => $additionalParam,
            'merchantUserInfo'  => $merchantUserInfo,
            'customerVaName'    => $customerVaName,
            'email'             => $email,
            'phoneNumber'       => $phoneNumber,
            'itemDetails'       => $itemDetails,
            'customerDetail'    => $customerDetail,
            'callbackUrl'       => $callbackUrl,
            'returnUrl'         => $returnUrl,
            'expiryPeriod'      => $expiryPeriod
        );

        try {
            // createInvoice Request
            $responseDuitkuPop = \Duitku\Pop::createInvoice($params, $duitkuConfig);

            return json_decode($responseDuitkuPop);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function requestDonateWithMidtrans($orderId, $donationObj, $request, $userDonation)
    {
        \Midtrans\Config::$serverKey = config('app.MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
        $midtrans_admin_fee = 4440;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => intval(($donationObj->value == 'lainnya' ? intval($request->custom_value) : $donationObj->value * $userDonation->amount_package) + $midtrans_admin_fee),
            ],
            'item_details' => [
                [
                    'id' => 1,
                    'price' => $donationObj->value == 'lainnya' ? $request->custom_value : $donationObj->value * $userDonation->amount_package,
                    'quantity' => 1,
                    'name' => $donationObj->short_description
                ],
                [
                    'id' => 2,
                    'price' => $midtrans_admin_fee,
                    'quantity' => 1,
                    'name' => 'Biaya Admin Bank'
                ]
            ],
            'customer_details' => [
                'first_name' => $request->is_fullname_hidden ? 'Dermawan' : $request->fullname,
                'phone' => $request->whatsapp_number,
                'email' => $request->email
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
