<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDonationOrderHasProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_donation_order_id',
        'product_id',
        'price',
        'qty',
        'weight',
        'total',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
