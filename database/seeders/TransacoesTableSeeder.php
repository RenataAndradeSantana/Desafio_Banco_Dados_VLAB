<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  # Interage com o banco de dados, sem a necessidade de criar instâncias de classes diretamente

class TransacoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transacoes')->insert([
            [
                'usuarios_id' => 1, // Assumindo que o ID do João Silva é 1
                'categorias_id' => 1, // Assumindo que a categoria Alimentação é 1
                'type' => 'recebeu',
                'valor' => 150.50,
                'data_criacao' => now(),
                'data_atualizacao' => now(),
            ],
            [
                'usuarios_id' => 2, // Assumindo que o ID da Maria Souza é 2
                'categorias_id' => 2, // Assumindo que a categoria Transporte é 2
                'type' => 'pagou',
                'valor' => 75.00,
                'data_criacao' => now(),
                'data_atualizacao' => now(),
            ],
            [
                'usuarios_id' => 3, // Assumindo que o ID da Katia Maria é 32
                'categorias_id' => 3, // Assumindo que a categoria Educação é 3
                'type' => 'pagou',
                'valor' => 100.00,
                'data_criacao' => now(),
                'data_atualizacao' => now(),
            ],
        ]);
    }
}
