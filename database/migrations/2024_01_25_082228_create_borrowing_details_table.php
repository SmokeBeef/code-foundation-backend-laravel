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
        Schema::create('borrowing_details', function (Blueprint $table) {
            $table->uuid('borrowing_detail_id')->nullable(false)->primary();
            $table->uuid('borrowing_detail_borrowing_id')->nullable(false);
            $table->uuid('borrowing_detail_book_id')->nullable(false);
            $table->timestamps();

            $table->foreign('borrowing_detail_borrowing_id')->references('borrowing_id')->on('borrowings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('borrowing_detail_book_id')->references('book_id')->on('books')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowing_details');
    }
};
