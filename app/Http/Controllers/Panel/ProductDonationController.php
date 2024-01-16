<?php

namespace App\Http\Controllers\Panel;

use App\Helpers\ModelFileUploadHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ProductDonation\StoreRequest;
use App\Http\Requests\Panel\ProductDonation\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDonationController extends Controller
{
    public function index()
    {
        $data = [
            'products' => Product::get()
        ];

        return view('panel.pages.product-donation.index', $data);
    }

    public function create()
    {
        return view('panel.pages.product-donation.create');
    }

    public function store(StoreRequest $request)
    {
        Product::create([
            'image' => ModelFileUploadHelper::modelFileStore('products', 'image', $request->file('image')),
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
        ]);

        return redirect('/panel/product-donations')->with('success', 'Produk donasi telah ditambahkan');
    }

    public function edit($id)
    {
        $data = [
            'product' => Product::find($id)
        ];

        return view('panel.pages.product-donation.edit', $data);
    }

    public function update(UpdateRequest $request, $id)
    {
        $product = Product::find($id);

        $product->update([
            'image' => ModelFileUploadHelper::modelFileUpdate($product, 'image', $request->file('image')),
            'name' => $request->name,
            'price' => $request->price,
            'weight' => $request->weight,
        ]);

        return redirect('/panel/product-donations')->with('success', 'Produk donasi telah diupdate');
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        ModelFileUploadHelper::modelFileDelete($product, 'image');
        $product->delete();

        return redirect('/panel/product-donations')->with('success', 'Produk donasi telah dihapus');
    }
}
