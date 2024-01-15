<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableDonation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'value', 'short_description', 'description'
    ];
}
