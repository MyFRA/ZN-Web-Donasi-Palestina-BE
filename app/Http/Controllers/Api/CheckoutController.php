<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Checkout\DoCheckoutRequest;
use App\Models\Product;
use App\Models\ProductDonationOrder;
use App\Models\ProductDonationOrderHasProducts;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function doCheckout(DoCheckoutRequest $request)
    {
        $setting = Setting::first();
        $midtrans_admin_fee = 4440;

        $productDonationOrder = ProductDonationOrder::create([
            'order_id' => Str::uuid(),
            'origin_province' => $setting->shipping_province,
            'origin_province_id' => $setting->shipping_province_id,
            'origin_city' => $setting->shipping_city,
            'origin_city_id' => $setting->shipping_city_id,
            'destination_province' => $request->destination_province,
            'destination_province_id' => $request->destination_province_id,
            'destination_city' => $request->destination_city,
            'destination_city_id' => $request->destination_city_id,
            'destination_district' => $request->destination_district,
            'destination_village' => $request->destination_village,
            'home_office_address' => $request->home_office_address,
            'postal_code' => $request->postal_code,
            'shipping_note' => $request->shipping_note,
            'courier' => $request->courier,
            'courier_cost_service' => $request->courier_cost_service,
            'courier_cost_value' => $request->courier_cost_value,
            'courier_cost_etd' => $request->courier_cost_etd,
            'full_name' => $request->full_name,
            'whatsapp_number' => $request->whatsapp_number,
            'email' => $request->email,
            'message' => $request->message,
            'platform_payment_method' => 'midtrans',
            'payment_status' => 'pending',
            'total' => collect($request->products)->reduce(function ($carry, $curr) {
                $product = Product::find($curr['id']);

                return $carry += $product->price * $curr['qty'];
            }, 0)
        ]);

        foreach ($request->products as $product) {
            $productDb = Product::find($product['id']);

            ProductDonationOrderHasProducts::create([
                'product_donation_order_id' => $productDonationOrder->id,
                'product_id' => $product['id'],
                'price' => $productDb->price,
                'qty' => $product['qty'],
                'weight' => $productDb->weight,
                'total' => $productDb->price * $product['qty'],
            ]);
        }

        \Midtrans\Config::$serverKey = config('app.MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $orderId = $productDonationOrder->order_id;

        $itemDetails = $productDonationOrder->productOrders->map(function ($item) {
            return [
                'id' => $item->id,
                'price' => $item->price,
                'quantity' => $item->qty,
                'name' => $item->product->name
            ];
        })->toArray();

        $itemDetails[] = [
            'id' => Str::random(),
            'price' => $request->courier_cost_value,
            'quantity' => 1,
            'name' => 'Ongkos Kirim'
        ];

        $params = [
            'item_details' => $itemDetails,
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => intval($productDonationOrder->total + $midtrans_admin_fee + $request->courier_cost_value),
            ],
            'customer_details' => [
                'first_name' => $productDonationOrder->full_name,
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
