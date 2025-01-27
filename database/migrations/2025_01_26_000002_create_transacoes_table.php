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
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id(); // Cria o id auto-incremental
            $table->foreignId('usuarios_id')->constrained()->onDelete('cascade'); // Chave estrangeira para o usuário
            $table->foreignId('categorias_id')->constrained()->onDelete('cascade'); // Chave estrangeira para a categoria
            $table->enum('type', ['recebeu', 'pagou']); // Tipo de transação 
            $table->decimal('valor', 10, 2); // Valor da transação (ex: 99999999.99)

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
        Schema::dropIfExists('transacoes');
    }
};
