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
            $table->string('location')->nullable();
            $table->string('destination')->nullable();
            $table->date('date')->format('Y-m-d')->nullable();
            $table->time('time')->format('H:i A')->nullable();
            $table->time('departure')->format('H:i A')->nullable();
            $table->integer('fare')->nullable();
            $table->integer('count')->nullable();
            $table->string('jnumber')->nullable();
            $table->string('driver')->nullable();
            $table->string('trips')->nullable();
            $table->string('code')->nullable();
            $table->string('status')->nullable()->default('on going');
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
