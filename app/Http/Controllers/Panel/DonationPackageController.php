<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\DonationPackage\StoreRequest;
use App\Http\Requests\Panel\DonationPackage\UpdateRequest;
use App\Models\AvailableDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonationPackageController extends Controller
{
    public function index()
    {
        $data = [
            'donations' => AvailableDonation::where('value', '!=', 'lainnya')->orderBy(DB::raw('cast(value as unsigned)'), 'DESC')->get()
        ];

        return view('panel.pages.donation-packages.index', $data);
    }

    public function create()
    {
        return view('panel.pages.donation-packages.create');
    }

    public function store(StoreRequest $request)
    {
        AvailableDonation::create([
            'title' => $request->title,
            'value' => $request->value,
            'short_description' => $request->short_description,
            'description' => $request->description
        ]);

        return redirect('/panel/donation-packages')->with('success', 'Paket Donasi telah ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'donationPackage' => AvailableDonation::find($id)
        ];

        return view('panel.pages.donation-packages.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        $donation = AvailableDonation::find($id);

        $donation->update([
            'title' => $request->title,
            'value' => $request->value,
            'short_description' => $request->short_description,
            'description' => $request->description
        ]);

        return redirect('/panel/donation-packages')->with('success', 'Paket Donasi telah diupdate');
    }

    public function destroy($id)
    {
        AvailableDonation::destroy($id);
        return redirect('/panel/donation-packages')->with('success', 'Paket Donasi telah dihapus');
    }
}
