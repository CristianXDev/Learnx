<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{

        Schema::create('tareas', function (Blueprint $table) {

            $table->id();
            $table->string('nombre');
            $table->text('descripcion');
            $table->text('documento')->nullable();
            $table->unsignedBigInteger('classroom_id');
            $table->foreign('classroom_id')->references('id')->on('classrooms');
            $table->date('fecha_entrega');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });

    }

    public function down(): void{

        Schema::dropIfExists('tareas');
    }
};
