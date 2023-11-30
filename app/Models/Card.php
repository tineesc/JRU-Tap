<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;
    use softDeletes;

    protected $fillable = ['name', 'card_id', 'card_balance', 'payment_method', 'name', 'email','wallet_id','wallet_balance'];

}
