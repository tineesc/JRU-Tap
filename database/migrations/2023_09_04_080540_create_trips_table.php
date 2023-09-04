<?php

use App\Enums\TripStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->string('destination');
            $table->date('date')->format('d-m-y');
            $table->time('time')->format('H:i');
            $table->integer('fare');
            $table->string('jnumber');
            $table->string('driver')->nullable();
            $table->enum('status', TripStatus::getValues());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
