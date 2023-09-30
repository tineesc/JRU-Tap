<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jeep extends Model
{
    use HasFactory;

    protected $fillable = [
        'jnumber',
        'driver',
        'begin',
        'end',
        'status',
    ];
    

    public function driver()
{
    return $this->belongsTo(User::class, 'driver');
}


}
