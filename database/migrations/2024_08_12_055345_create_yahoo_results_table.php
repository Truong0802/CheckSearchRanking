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
        Schema::create('yahoo_results', function (Blueprint $table) {
            $table->id('yahooResultId');
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
        Schema::dropIfExists('yahoo_results');
    }
};
