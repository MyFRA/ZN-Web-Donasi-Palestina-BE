<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\ModelFileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\VirtualBankAccount\StoreRequest;
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

    public function create()
    {
        $data = [
            'types' => ['ewallet', 'va', 'qris']
        ];

        return view('panel.pages.virtual-bank-account.create', $data);
    }

    public function store(StoreRequest $request)
    {
        $virtualBankAccount = VirtualBankAccount::create([
            'image' => ModelFileUploadHelper::modelFileStore('virtual_bank_accounts', 'image', $request->file('image')),
            'bank_name' => $request->bank_name,
            'bank_short_code' => $request->bank_short_code,
            'type' => $request->type
        ]);

        return redirect('/panel/bank-accounts')->with('success', 'Virtual Bank Account Created');
    }

    public function edit($id)
    {
        $data = [
            'bankAccount' => VirtualBankAccount::where('id', $id)->first(),
            'types' => ['ewallet', 'va', 'qris']
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
            'type' => $request->type,
        ]);

        return redirect('/panel/bank-accounts')->with('success', 'Virtual Bank Account Updated');
    }

    public function destroy($id)
    {
        $virtualBankAccount = VirtualBankAccount::find($id);

        ModelFileUploadHelper::modelFileDelete($virtualBankAccount, 'image');
        $virtualBankAccount->delete();

        return redirect('/panel/bank-accounts')->with('success', 'Virtual Bank Account deleted');
    }
}
