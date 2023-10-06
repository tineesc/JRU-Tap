<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triplog extends Model
{
    use HasFactory;


    protected $fillable = ['id', 'location', 'destination', 'date', 'time', 'driver', 'fare', 'departure', 'status'];

 

}
