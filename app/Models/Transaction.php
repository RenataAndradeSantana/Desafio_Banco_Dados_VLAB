<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transacoes';
    protected $fillable = [
        'usuarios_id', 'categorias_id', 'type', 'valor', 'data_criacao', 'data_atualizacao',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuarios_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categorias_id');
    }
}