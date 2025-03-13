<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualBankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'bank_name',
        'bank_short_code',
        'type'
    ];
}
