<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('quiz_curso', function (Blueprint $table) {
            $table->id();
            $table->text('pregunta');
            $table->text('respuesta_1');
            $table->text('respuesta_2')->nullable();
            $table->text('respuesta_3')->nullable();
            $table->text('respuesta_4')->nullable();
            $table->unsignedBigInteger('modulo_id');
            $table->foreign('modulo_id')->references('id')->on('modulos_cursos');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_curso');
    }
};
