<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'wallet_amount',
        'fare',
        'jnumber',
        'payment_method',
        'status',
    ];
}
