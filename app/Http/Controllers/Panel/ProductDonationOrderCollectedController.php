<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ProductDonationOrder;
use Illuminate\Http\Request;

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
}
