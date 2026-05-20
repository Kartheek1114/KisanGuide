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
        Schema::create('crops', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->text('description');
            $table->float('optimal_temp_min');
            $table->float('optimal_temp_max');
            $table->float('optimal_humidity_min');
            $table->float('optimal_humidity_max');
            $table->float('optimal_ph_min');
            $table->float('optimal_ph_max');
            $table->integer('optimal_n');
            $table->integer('optimal_p');
            $table->integer('optimal_k');
            $table->json('soil_types');
            $table->string('water_requirement');
            $table->integer('harvest_days');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crops');
    }
};
