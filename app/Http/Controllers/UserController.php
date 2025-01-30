<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;
use App\Http\Controllers\Controller;

/**
 * @OA\Tag(name="Usuários", description="Gerenciamento de usuários")
 */
class UserController extends Controller
{
    /**
     * @OA\Get(
     *     path="/usuarios",
     *     summary="Listar todos os usuários",
     *     tags={"Usuários"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de usuários",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/User"))
     *     )
     * )
     */
    public function index()
    {
        // Retorna todos os usuários, incluindo as colunas personalizadas
        $usuarios = User::select('id', 'name', 'cpf', 'email', 'data_criacao', 'data_atualizacao')
                        ->get();

        return response()->json($usuarios);
    }

    /**
     * @OA\Post(
     *     path="/usuarios",
     *     summary="Criar um novo usuário",
     *     tags={"Usuários"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Usuário criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação",
     *         @OA\JsonContent(@OA\Property(property="message", type="string"))
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:42',
            'cpf' => 'required|string|size:11|unique:usuarios',
            'email' => 'required|email|max:255|unique:usuarios',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'cpf' => $validated['cpf'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'data_criacao' => now(),
            'data_atualizacao' => now(),
        ]);

        return response()->json($user, 201);
    }

    /**
     * @OA\Put(
     *     path="/usuarios/{id}",
     *     summary="Atualizar um usuário",
     *     tags={"Usuários"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do usuário",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário atualizado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'string|max:42',
            'cpf' => 'string|size:11|unique:usuarios,cpf,' . $user->id,
            'email' => 'email|max:255|unique:usuarios,email,' . $user->id,
            'password' => 'string|min:6',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $validated['data_atualizacao'] = now();

        $user->update($validated);

        return response()->json($user);
    }

    /**
     * @OA\Delete(
     *     path="/usuarios/{id}",
     *     summary="Deletar um usuário",
     *     tags={"Usuários"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do usuário",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Usuário deletado com sucesso",
     *         @OA\JsonContent(@OA\Property(property="message", type="string"))
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Usuário não encontrado"
     *     )
     * )
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        Transaction::where('usuarios_id', $id)->delete();
        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }
}
