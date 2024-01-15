<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AvailableDonation;
use Illuminate\Http\Request;

class AvailableDonationController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'data' => AvailableDonation::orderBy('value', 'ASC')->get()
        ], 200);
    }
}
