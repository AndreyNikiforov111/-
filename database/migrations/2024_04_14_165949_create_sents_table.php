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
        Schema::create('sents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('newsletter_id')->unique();
            $table->timestamps();

            $table->foreign('newsletter_id')->references('id')->on('newsletters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sents');
    }
};
