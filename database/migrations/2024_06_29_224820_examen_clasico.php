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

        Schema::create('examenes_clasicos', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('examen_id');
            $table->foreign('examen_id')->references('id')->on('examenes');
            $table->text('pregunta');
            $table->text('respuesta');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{

        Schema::dropIfExists('examen_clasico');
    }
};
