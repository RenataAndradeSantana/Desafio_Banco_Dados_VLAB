<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; # Interage com o banco de dados, sem a necessidade de criar instâncias de classes diretamente
use Illuminate\Support\Facades\Hash; # Faz com a senha na tabela usuários não seja visível

class UsuariosTableSeeder extends Seeder
{
   
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'name' => 'João Silva',
                'cpf' => '12345678901',
                'email' => 'joao@gmail.com',
                'password' => Hash::make('123'),
                'data_criacao' => now(),
                'data_atualizacao' => now(),
            ],
            [
                'name' => 'Maria Souza',
                'cpf' => '98765432100',
                'email' => 'mariaS@yahoo.com.br',
                'password' => Hash::make('123'),
                'data_criacao' => now(),
                'data_atualizacao' => now(),
            ],
            [
                'name' => 'Katia Maria',
                'cpf' => '11122334455',
                'email' => 'katia@gmail.com',
                'password' => Hash::make('123'),
                'data_criacao' => now(),
                'data_atualizacao' => now(),
            ],
        ]);
    }
}
