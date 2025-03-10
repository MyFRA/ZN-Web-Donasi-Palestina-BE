<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VirtualBankAccount;
use Illuminate\Http\Request;

class VirtualBankAccountController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => VirtualBankAccount::get()->map(function ($virtualBankAccount) {
                $virtualBankAccount->image = url('/storage/virtual-bank-accounts/image/' . $virtualBankAccount->image);

                return $virtualBankAccount;
            })
        ], 200);
    }
}
