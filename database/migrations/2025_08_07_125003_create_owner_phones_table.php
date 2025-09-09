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
        Schema::create('owner_phones', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 25)->unique();
            $table->timestamps();
            //FK
            $table->foreignId('owner_id')->references('id')->on('owners')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_phones');
    }
};
