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
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nome', 100);
            $table->string('responsavel', 100);
            $table->string('tel_responsavel', 20);
            $table->string('cep', 8);
            $table->string('rua', 50);
            $table->integer('numero');
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->string('complemento', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
