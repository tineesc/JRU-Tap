<?php


use App\Enums\TripStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->enum('status', ['Available', 'Not Available']);
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
