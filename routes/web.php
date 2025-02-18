<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API de Monitoramento Financeiro",
 *     description="Documentação da API para o sistema de monitoramento financeiro."
 * )
 *
 * @OA\Server(
 *     url="http://localhost/api",
 *     description="Servidor local"
 * )
 */

// Rotas para usuários
/**
 * @OA\PathItem(
 *     path="/usuarios",
 *     description="Gerenciamento de usuários"
 * )
 */

Route::apiResource('usuarios', UserController::class);

// Rotas para categorias
/**
 * @OA\PathItem(
 *     path="/categorias",
 *     description="Gerenciamento de categorias"
 * )
 */
Route::apiResource('categorias', CategoryController::class);

// Rotas para transações
/**
 * @OA\PathItem(
 *     path="/transacoes",
 *     description="Gerenciamento de transações"
 * )
 */
Route::apiResource('transacoes', TransactionController::class);

