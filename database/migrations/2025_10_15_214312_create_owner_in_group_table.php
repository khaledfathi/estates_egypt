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
        Schema::create('owner_in_group', function (Blueprint $table) {
            $table->id();
            //FK
            $table->foreignId('owner_id')->references('id')->on('owenrs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('group_id')->references('id')->on('owner_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner_in_group');
    }
};
