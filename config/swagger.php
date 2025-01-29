<?php

/**
 * @OA\Info(
 *     title="Desafio VLAB API",
 *     version="1.0.0",
 *     description="API para gerenciar usuários, categorias e transações",
 *     @OA\Contact(
 *         email="suporte@vlab.com"
 *     )
 * )
 */

/**
 * @OA\Server(
 *     url="http://localhost/api",
 *     description="Servidor local"
 * )
 */

/**
 * @OA\PathItem(path="/usuarios")
 */

/**
 * @OA\PathItem(path="/categorias")
 */

/**
 * @OA\PathItem(path="/transacoes")
 */

/**
 * @OA\Components(
 *     @OA\Schema(
 *         schema="User",
 *         type="object",
 *         required={"name", "email", "password"},
 *         @OA\Property(property="name", type="string"),
 *         @OA\Property(property="email", type="string"),
 *         @OA\Property(property="password", type="string")
 *     ),
 *     @OA\Schema(
 *         schema="Category",
 *         type="object",
 *         required={"name"},
 *         @OA\Property(property="name", type="string")
 *     ),
 *     @OA\Schema(
 *         schema="Transaction",
 *         type="object",
 *         required={"category_id", "amount", "type", "date"},
 *         @OA\Property(property="category_id", type="integer"),
 *         @OA\Property(property="amount", type="number", format="float"),
 *         @OA\Property(property="type", type="string", enum={"income", "expense"}),
 *         @OA\Property(property="date", type="string", format="date")
 *     )
 * )
 */
