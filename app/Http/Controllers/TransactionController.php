<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

/**
 * @OA\PathItem(path="/transacoes")
 */
class TransactionController extends Controller
{
    /**
     * @OA\Post(
     *     path="/transacoes",
     *     summary="Criar uma nova transação",
     *     description="Cria uma nova transação de pagamento ou recebimento",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Transaction")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Transação criada com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Transaction")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuarios_id' => 'required|exists:usuarios,id',
            'categorias_id' => 'required|exists:categorias,id',
            'type' => 'required|in:recebeu,pagou',
            'valor' => 'required|numeric|min:0',
        ]);

        $transacao = Transaction::create([
            ...$validated,
            'data_criacao' => now(),
            'data_atualizacao' => now(),
        ]);

        return response()->json($transacao, 201);
    }

    /**
     * @OA\Get(
     *     path="/transacoes",
     *     summary="Listar todas as transações",
     *     description="Retorna a lista de todas as transações",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de transações",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Transaction"))
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Transaction::query();

        if ($request->has('usuarios_id')) {
            $query->where('usuarios_id', $request->usuarios_id);
        }

        if ($request->has('categorias_id')) {
            $query->where('categorias_id', $request->categorias_id);
        }

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        return response()->json($query->get());
    }

    /**
     * @OA\Get(
     *     path="/transacoes/{id}",
     *     summary="Exibir uma transação",
     *     description="Retorna os detalhes de uma transação",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da transação",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes da transação",
     *         @OA\JsonContent(ref="#/components/schemas/Transaction")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Transação não encontrada"
     *     )
     * )
     */
    public function show($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transação não encontrada'], 404);
        }
        return response()->json($transaction);
    }

    /**
     * @OA\Put(
     *     path="/transacoes/{id}",
     *     summary="Atualizar uma transação",
     *     description="Atualiza as informações de uma transação existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da transação",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Transaction")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Transação atualizada",
     *         @OA\JsonContent(ref="#/components/schemas/Transaction")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Transação não encontrada"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transação não encontrada'], 404);
        }

        $data = $request->validate([
            'usuarios_id' => 'required|exists:usuarios,id',
            'categorias_id' => 'required|exists:categorias,id',
            'type' => 'required|in:recebeu,pagou',
            'valor' => 'required|numeric|min:0',
        ]);

        $transaction->update($data);

        return response()->json($transaction);
    }

    /**
     * @OA\Delete(
     *     path="/transacoes/{id}",
     *     summary="Excluir uma transação",
     *     description="Deleta uma transação existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da transação",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Transação excluída com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Transação não encontrada"
     *     )
     * )
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return response()->json(['message' => 'Transação não encontrada'], 404);
        }

        $transaction->delete();
        return response()->json(null, 204);
    }
}
