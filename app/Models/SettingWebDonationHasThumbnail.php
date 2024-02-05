<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingWebDonationHasThumbnail extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_web_donation_id', 'thumbnail'
    ];
}
