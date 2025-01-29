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
     *          description="Lista de categorias"
     *      )
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

    public function index()
    {
        return response()->json(Category::all());
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Remove transações relacionadas à categoria
        Transacao::where('categorias_id', $id)->delete();

        $category->delete();

        return response()->json(['message' => 'Categoria deletada com sucesso']);
    }
}

  