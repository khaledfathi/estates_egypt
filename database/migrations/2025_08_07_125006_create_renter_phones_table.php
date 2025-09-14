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
        Schema::create('renter_phones', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 25);
            $table->timestamps();
            //FK
            $table->foreignId('renter_id')->references('id')->on('renters')->onDelete('renters')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('renter_phones');
    }
};
