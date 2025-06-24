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

        Schema::create('examenes_clasicos_entregados', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('examenes_entregado_id');
            $table->foreign('examenes_entregado_id')->references('id')->on('examenes_entregados');

            $table->unsignedBigInteger('examen_clasico_id');
            $table->foreign('examen_clasico_id')->references('id')->on('examenes_clasicos');
            
            $table->text('respuesta');

            $table->enum('estatus', ['correcto', 'incorrecto','pendiente'])->default('pendiente');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{

         Schema::dropIfExists('examenes_clasicos_entregados');
    }
};
