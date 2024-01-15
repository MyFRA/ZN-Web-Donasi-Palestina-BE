<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDonationOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'origin_province',
        'origin_province_id',
        'origin_city',
        'origin_city_id',
        'destination_province',
        'destination_province_id',
        'destination_city',
        'destination_city_id',
        'destination_district',
        'destination_village',
        'home_office_address',
        'courier',
        'courier_cost_service',
        'courier_cost_value',
        'courier_cost_etd',
        'full_name',
        'whatsapp_number',
        'email',
        'shipment_status',
        'payment_method',
        'platform_payment_method',
        'payment_status',
        'total',
        'postal_code'
    ];
}
