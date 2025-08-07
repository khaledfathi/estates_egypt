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
        Schema::create('unit_ownerships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            //FK
            $table->foreignId('unit_id')
                ->references('id')->on('units')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreignId('owner_id')
                ->references('id')->on('owners')
                ->onUpdate('restrict')->onDelete('restrict');
            //constrain
            $table->unique(['unit_id', 'owner_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_ownerships');
    }
};
