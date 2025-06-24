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

        Schema::create('examenes_entregados', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')->references('id')->on('users');
            $table->unsignedBigInteger('examen_id');
            $table->foreign('examen_id')->references('id')->on('examenes');
            $table->integer('calificacion');
            $table->date('fecha_entrega');
            $table->integer('tiempo_entrega');
            $table->enum('estatus', ['corregido', 'pendiente', 'rechazado']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{

        Schema::dropIfExists('examenes_entregados');
    }
};
