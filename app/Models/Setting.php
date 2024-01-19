<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_logo', 'company_name', 'company_description', 'shipping_province', 'shipping_province_id', 'shipping_city', 'shipping_city_id', 'additional_shipping_fee', 'company_phone_number', 'company_email', 'company_address'
    ];
}
