<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;



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
Route::apiResource('/usuarios', [UserController::class, 'index']);
Route::delete('/users/{id}', [UserController::class, 'destroy']); // Deletar usuário

// Rotas para categorias
/**
 * @OA\PathItem(
 *     path="/categorias",
 *     description="Gerenciamento de categorias"
 * )
 */

Route::apiResource('/categorias', [CategoryController::class, 'index']);
oute::post('/categorias', [CategoryController::class, 'store']); // Criar categoria
Route::delete('/categorias/{id}', [CategoryController::class, 'destroy']); // Deletar categoria

// Rotas para transações
/**
 * @OA\PathItem(
 *     path="/transacoes",
 *     description="Gerenciamento de transações"
 * )
 */
Route::apiResource('/transacoes', [TransactionController::class, 'index']);
Route::post('/transacoes', [TransactionController::class, 'store']); // Criar transação
Route::delete('/transacoes/{id}', [TransactionController::class, 'destroy']); // Deletar transação
