<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{

    public function up(): void{

        Schema::create('alertas', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->text('descripcion');
            $table->date('fecha_notificacion');

        });

    }

    public function down(): void{

        Schema::dropIfExists('alertas');
    }
};
