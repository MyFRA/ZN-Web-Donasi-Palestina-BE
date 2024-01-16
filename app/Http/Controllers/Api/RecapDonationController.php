<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DonationRecap;
use Illuminate\Http\Request;

class RecapDonationController extends Controller
{
    public function getDonationCollected()
    {
        return response()->json([
            'data' => [
                'amount_donation' => DonationRecap::sum('amount'),
                'amount_donatur' => DonationRecap::count()
            ]
        ]);
    }

    public function getDonatur(Request $request)
    {
        $donatur = tap(DonationRecap::simplePaginate(
            $request->size ? $request->size : 5, // per page (may be get it from request)
            ['*'], // columns to select from table (default *, means all fields)
            'page', // page name that holds the page number in the query string
            $request->page ? $request->page : 1 // current page, default 1
        ), function ($paginatedInstance) {
            return $paginatedInstance->getCollection()->transform(function ($value) {
                $value->created_at_for_humans = $value->created_at->diffForHumans();

                return $value;
            });
        });

        $messages = tap(DonationRecap::where('message', '!=', null)->simplePaginate(
            $request->size ? $request->size : 5, // per page (may be get it from request)
            ['*'], // columns to select from table (default *, means all fields)
            'page', // page name that holds the page number in the query string
            $request->page ? $request->page : 1 // current page, default 1
        ), function ($paginatedInstance) {
            return $paginatedInstance->getCollection()->transform(function ($value) {
                $value->created_at_for_humans = $value->created_at->diffForHumans();

                return $value;
            });
        });

        return response()->json([
            'donatur' => $donatur,
            'messages' => $messages,
            'total_donaturs' => DonationRecap::count(),
            'total_messages' => DonationRecap::where('message', '!=', null)->count()
        ]);
    }
}
