<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationRecap extends Model
{
    use HasFactory;

    protected $fillable = [
        'foreign_id', 'fullname', 'type', 'amount', 'message'
    ];
}
