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
        Schema::create('memory_list_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('memory_list_id');
            $table->text('content');
            $table->integer('position');
            $table->timestamps();

            $table->foreign('memory_list_id')->references('id')->on('memory_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memory_list_items');
    }
};
