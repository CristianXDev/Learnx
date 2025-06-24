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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->enum('like', [0,1]->default(0); //1- Marcado /// 0- No marcado 
            $table->enum('dislike', [0,1]->default(0);  //1- Marcado /// 0- No marcado 
            $table->unsignedBigInteger('estudiante_id'); 
            $table->foreign('estudiante_id')->references('id')->on('users');
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->references('id')->on('videos_cursos');
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
        Schema::dropIfExists('likes');
    }
};
