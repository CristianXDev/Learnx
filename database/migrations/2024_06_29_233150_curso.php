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

        Schema::create('cursos', function (Blueprint $table) {

            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->text('image');
            $table->enum('tipo', ['gratis', 'premium']);
            $table->integer('precio')->nullable();
            $table->enum('estatus', ['activo', 'inactivo']);
            $table->integer('calificacion');
            $table->unsignedBigInteger('profesor_id');
            $table->foreign('profesor_id')->references('id')->on('users');
            $table->unsignedBigInteger('categoria_id');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void{

       Schema::dropIfExists('cursos');
   }
};
