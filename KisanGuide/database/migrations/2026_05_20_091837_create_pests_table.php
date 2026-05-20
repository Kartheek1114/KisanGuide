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
        Schema::create('pests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->json('target_crops');
            $table->float('humidity_threshold');
            $table->float('temp_threshold');
            $table->text('symptoms');
            $table->text('prevention_measures');
            $table->text('remedial_measures');
            $table->string('severity_level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pests');
    }
};
