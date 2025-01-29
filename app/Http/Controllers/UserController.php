<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/usuarios",
     *     summary="Criar um novo usuário",
     *     description="Cria um novo usuário na aplicação",
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
     *         description="Validação falhou",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
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

        return response()->json($user, 201); // O 'id' será gerado automaticamente
    }

    public function index()
    {
        // Retorna todos os usuários
        $users = User::all();
        return response()->json($users);
    }

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

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Deleta todas as transações relacionadas ao usuário
        Transaction::where('usuarios_id', $id)->delete();

        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }
}
