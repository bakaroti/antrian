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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            // $table->enum('gender', ['M', 'F']);
            // $table->date('birth_date');
            $table->string('poly_initial');
            $table->foreign('poly_initial')->references('initial')->on('polies');
            // $table->foreignId('poly_id');
            $table->integer('queue_number');
            $table->string('antrian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
