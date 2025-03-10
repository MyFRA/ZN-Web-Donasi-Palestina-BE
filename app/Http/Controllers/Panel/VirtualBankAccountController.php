<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\ModelFileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\VirtualBankAccount\UpdateRequest as VirtualBankAccountUpdateRequest;
use App\Models\VirtualBankAccount;
use Illuminate\Http\Request;

class VirtualBankAccountController extends Controller
{
    public function index()
    {
        $data = [
            'bank_accounts' => VirtualBankAccount::orderBy('bank_name', 'ASC')->paginate(10)
        ];

        return view('panel.pages.virtual-bank-account.index', $data);
    }

    public function edit($id)
    {
        $data = [
            'bankAccount' => VirtualBankAccount::where('id', $id)->first(),
        ];

        return view('panel.pages.virtual-bank-account.edit', $data);
    }

    public function update(VirtualBankAccountUpdateRequest $request, $id)
    {
        $virtualBankAccount = VirtualBankAccount::find($id);

        $virtualBankAccount->update([
            'image' => ModelFileUploadHelper::modelFileUpdate($virtualBankAccount, 'image', $request->file('image')),
            'bank_name' => $request->bank_name,
            'bank_short_code' => $request->bank_short_code,
        ]);

        return redirect('/panel/bank-accounts')->with('success', 'Virtual Bank Account Updated');
    }
}
