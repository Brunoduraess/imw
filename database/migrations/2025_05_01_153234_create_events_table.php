<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome', 100);
            $table->text('descricao');
            $table->string('tipo', 50);
            $table->date('data');
            $table->time('horario');
            $table->uuid('local_id');
            $table->double('inscricao')->nullable();
            $table->text('imagem_agenda');
            $table->text('imagem_detalhe');
            $table->enum('status', ['Ativo', 'Inativo', 'Expirado']);
            $table->uuid('criado_por');
            $table->dateTime('criado_em');
            $table->dateTime('atualizado_em')->nullable();
            $table->string('atualizado_por', 100)->nullable();
            $table->dateTime('desativado_em')->nullable();
            $table->string('desativado_por', 100)->nullable();

            $table->foreign('local_id')->references('id')->on('locations');
            $table->foreign('criado_por')->references('id')->on('users');
            $table->foreign('atualizado_por')->references('id')->on('users');
            $table->foreign('desativado_por')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
