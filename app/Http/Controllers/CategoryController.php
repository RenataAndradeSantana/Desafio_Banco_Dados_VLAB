<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API de Monitoramento Financeiro",
 *     description="Documentação da API para o sistema de monitoramento financeiro."
 * )
 */
class CategoryController extends Controller
{
    /**
     * @OA\Tag(
     *     name="Categorias",
     *     description="Gerenciamento de Categorias"
     * )
     */
    
    /**
     * @OA\Get(
     *      path="/categorias",
     *      tags={"Categorias"},
     *      summary="Lista todas as categorias",
     *      @OA\Response(
     *          response=200,
     *          description="Lista de categorias",
     *          @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Category"))
     *      )
     * )
     */
    public function index()
    {
        return response()->json(Category::all());
    }

    /**
     * @OA\Post(
     *     path="/categorias",
     *     tags={"Categorias"},
     *     summary="Cria uma nova categoria",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Alimentação")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Categoria criada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Category")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:42|unique:categorias',
        ]);

        $category = Category::create($validated);

        return response()->json($category, 201);
    }

    /**
     * @OA\Delete(
     *     path="/categorias/{id}",
     *     tags={"Categorias"},
     *     summary="Deleta uma categoria pelo ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Categoria deletada com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Categoria não encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Remove transações relacionadas à categoria
        Transacao::where('categorias_id', $id)->delete();

        $category->delete();

        return response()->json(['message' => 'Categoria deletada com sucesso']);
    }
}
