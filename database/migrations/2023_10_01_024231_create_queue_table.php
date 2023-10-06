<?php

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
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->string('jnumber');
            $table->string('driver')->nullable();
            $table->time('begin')->format('H:i')->nullable();
            $table->time('end')->format('H:i')->nullable();
            // $table->time('notify')->format('H:i')->nullable();
            $table->enum('status', [null,'queue', 'next', 'pending']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queues');
    }
};
