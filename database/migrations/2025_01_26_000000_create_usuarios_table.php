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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID autoincrementável
            $table->string('name', 42); // Nome completo com no máximo 42 caracteres
            $table->string('cpf', 11)->unique(); // CPF com 11 caracteres, único
            $table->string('email', 255)->unique(); // E-mail com até 255 caracteres, único
            $table->string('password'); // Senha, sem restrição de tamanho (geralmente hash)
            
            //Colunas de data de criação e atualização de cadastro feito pelo usuário
            $table->timestamp('data_criacao')->nullable();
            $table->timestamp('data_atualizacao')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios'); // Remove a tabela 'usuarios' se ela existir
    }
};
