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
        Schema::create('shelfs', function (Blueprint $table) {
            $table->uuid('shelf_id')->nullable(false)->primary();
            $table->string('shelf_name', 50)->nullable(false);
            $table->string('shelf_location', 150)->nullable(false);
            $table->integer('shelf_capacity')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shelfs');
    }
};
