<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome', 100);
            $table->string('cpf', 11)->unique();
            $table->string('email', 100);
            $table->string('senha', 255);
            $table->string('acesso', 50);
            $table->string('status', 20);
            $table->dateTime('ultimo_acesso')->nullable();
            $table->dateTime('criado_em');
            $table->dateTime('atualizado_em')->nullable();
            $table->dateTime('desativado_em')->nullable();
            $table->string('desativado_por', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
