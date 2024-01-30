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
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('book_id')->nullable(false)->primary();
            $table->uuid('book_author_id')->nullable(false);
            $table->uuid('book_category_id')->nullable(false);
            $table->uuid('book_publisher_id')->nullable(false);
            $table->uuid('book_shelf_id')->nullable(false);
            $table->string('book_title', 150)->nullable(false);
            $table->char('book_isbn', 16)->nullable(false);
            $table->char('book_publicationyear', 4)->nullable(false);
            $table->string('book_image', 255)->nullable(false);
            $table->timestamp("book_created_at")->nullable();
            $table->timestamp("book_updated_at")->nullable();

            $table->foreign('book_author_id')->references('author_id')->on('authors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('book_category_id')->references('category_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('book_publisher_id')->references('publisher_id')->on('publishers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('book_shelf_id')->references('shelf_id')->on('shelfs')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
