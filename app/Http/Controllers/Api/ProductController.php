<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Product::get()->map(function (Product $product) {
                $product->sales = 50;
                $product->image = url('/storage/products/image/' . $product->image);

                return $product;
            })
        ], 200);
    }

    public function show($id)
    {
        $product = Product::find($id);

        return response()->json([
            'data' => $product
        ], $product ? 200 : 422);
    }
}
