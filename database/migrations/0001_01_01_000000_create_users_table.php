<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Importar DB
use App\Models\User;

return new class extends Migration
{
    /*
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('image')->nullable();
            $table->string('name');
            $table->string('lastName');
            $table->integer('cedula');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('estatus_email', [User::Verificado,User::Pendiente])->default(User::Verificado);
            $table->enum('estatus', ['activo', 'inactivo', 'pendiente']);
            $table->string('password');
            $table->integer('rol');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insertar usuarios por defecto
        DB::table('users')->insert([
            [
                'name' => 'Cristian',
                'lastName' => 'Gerig',
                'email' => 'chriscodetech@gmail.com',
                'estatus_email' => 1,
                'password' => bcrypt('31317165'), // Cifrar la contraseña
                'rol' => 1, // Rol del usuario
                'estatus' => 'activo',
            ],
            [
                'name' => 'Lucia',
                'lastName' => 'Salcedo',
                'email' => 'luciarondon05@gmail.com',
                'estatus_email' => 1,
                'password' => bcrypt('12345678'),
                'rol' => 2,
                'estatus' => 'activo',
            ]
        ]);

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /*
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
