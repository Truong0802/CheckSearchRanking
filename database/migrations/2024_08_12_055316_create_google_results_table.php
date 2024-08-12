<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('google_results', function (Blueprint $table) {
            $table->id('googleResultId');
            $table->unsignedBigInteger('resultId');
            $table->unsignedBigInteger('rankId');
            $table->foreign('resultId')->references('resultId')->on('search_results')->onDelete('cascade');
            $table->foreign('rankId')->references('rankId')->on('rank_lists')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('google_results');
    }
};
