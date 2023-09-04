<?php

namespace App\Models;

use App\Models\Jeep;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;

    public function Jeep(): BelongsTo
    {
        return $this->belongsTo(Jeep::class);
    }
}



