<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Defina a tabela explicitamente
    protected $table = 'usuarios'; // Nome da tabela no banco de dados

    // Defina os campos que podem ser preenchidos
    protected $fillable = [
        'name', 'cpf', 'email', 'password', 'data_criacao', 'data_atualizacao',
    ];

    // Desabilite o gerenciamento automático das colunas created_at e updated_at
    public $timestamps = false;  // Isso desabilita a expectativa automática de 'created_at' e 'updated_at'

    // Verifique se está ocultando outros campos importantes
    protected $hidden = [
        'password', 'remember_token',  // Remova se não quiser ocultar 'remember_token'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
