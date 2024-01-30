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
        Schema::create('borrowings', function (Blueprint $table) {
            $table->uuid('borrowing_id')->nullable(false)->primary();
            $table->uuid('borrowing_user_id')->nullable(false);
            $table->date('borrowing_borrowdate')->nullable(false);
            $table->date('borrowing_returndate')->nullable(false);
            $table->boolean('borrowing_returnstatus')->nullable(false)->default(false);
            $table->string('borrowing_notes', 255)->nullable(true);
            $table->integer('borrowing_penalty')->nullable(true);
            $table->timestamps();

            $table->foreign('borrowing_user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
