<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{

        Schema::create('examenes_multiples', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('examen_id');
            $table->foreign('examen_id')->references('id')->on('examenes');
            $table->text('pregunta');
            $table->text('respuesta_1');
            $table->text('respuesta_2')->nullable();
            $table->text('respuesta_3')->nullable();
            $table->text('respuesta_4')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{

         Schema::dropIfExists('examenes_multiples');
    }
};
