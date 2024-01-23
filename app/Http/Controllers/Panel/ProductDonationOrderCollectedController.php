<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Mail\EmailNotificationUserProductDonationOrderResiCode;
use App\Models\ProductDonationOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ProductDonationOrderCollectedController extends Controller
{
    public function index()
    {
        $data = [
            'total' => ProductDonationOrder::where('payment_status', 'success')->sum('total'),
            'donations' => ProductDonationOrder::where('payment_status', 'success')->orderBy('created_at', 'DESC')->paginate(10),
        ];

        return view('panel.pages.product-donation-orders-collected.index', $data);
    }

    public function updateToShipped(Request $request, $id)
    {
        $productDonation = ProductDonationOrder::find($id);
        $productDonation->update([
            'shipment_status' => 'Product Shipped',
            'resi_code' => $request->resi_code
        ]);

        Mail::to($productDonation->email)->send(new EmailNotificationUserProductDonationOrderResiCode($productDonation));

        return back()->with('success', 'Produk order telah diupdate ke dikirim');
    }
}
