<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'shipping_province', 'shipping_province_id', 'shipping_city', 'shipping_city_id', 'additional_shipping_fee'
    ];
}
