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
        Schema::create('advisor_queries', function (Blueprint $table) {
            $table->id();
            $table->string('farmer_name');
            $table->string('contact_number');
            $table->string('crop_name')->nullable();
            $table->text('query_text');
            $table->text('response_text')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advisor_queries');
    }
};
