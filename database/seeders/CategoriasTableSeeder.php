<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  # Interage com o banco de dados, sem a necessidade de criar instâncias de classes diretamente

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                'name' => 'Alimentação',
            ],
            [
                'name' => 'Transporte',
            ],
            [
                'name' => 'Educação',
            ],

        ]);
    }
}
