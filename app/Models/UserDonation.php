<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDonation extends Model
{
    use HasFactory;

    protected $casts = [
        'order_id' => 'string'
    ];

    protected $fillable = [
        'amount',
        'order_id',
        'fullname',
        'whatsapp_number',
        'email',
        'message',
        'payment_method',
        'platform_payment_method',
        'status',
        'available_donation_id',
        'amount_package',
        'package_item_price',
        'va_id',
        'ewallet_id'
    ];

    public function availableDonation()
    {
        return $this->belongsTo(AvailableDonation::class, 'available_donation_id', 'id');
    }
}
