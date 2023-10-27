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
        Schema::create('jeeps', function (Blueprint $table) {
            $table->id();
            $table->string('jnumber');
            $table->string('driver')->nullable();
            $table->time('queue')->format('H:i')->nullable();
            $table->datetime('begin')->format('Y-m-d H:i')->nullable();
            $table->datetime('end')->format('Y-m-d H:i')->nullable();
            $table->time('notify')->format('H:i')->nullable();
            $table->string('request')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jeeps');
    }
};
