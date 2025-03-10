<?php

namespace App\Http\Controllers\Api;

use App\Helpers\BrickHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkPaymentStatus($vaId)
    {
        return response()->json([
            'data' => BrickHelper::checkPaymentStatus($vaId)
        ]);
    }

    public function setPaymentStatus($vaId)
    {
        return response()->json([
            'data' => BrickHelper::setPaymentStatus($vaId)
        ]);
    }
}
