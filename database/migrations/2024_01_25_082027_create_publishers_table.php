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
        Schema::create('publishers', function (Blueprint $table) {
            $table->uuid('publisher_id')->nullable(false)->primary();
            $table->string('publisher_name', 100)->nullable(false);
            $table->string('publisher_address', 150)->nullable(false);
            $table->string('publisher_email', 150)->nullable(false);
            $table->char('publisher_phonenumber', 13)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publishers');
    }
};
