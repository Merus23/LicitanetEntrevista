<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutoRequest;
use App\Models\Cidade;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $produtos = Produto::with(['marca', 'cidade']);

        $minValor = $request->input('min_valor', 0);

        $maxValor = $request->input('max_valor', 0);

        if ($minValor || $maxValor) {
            $produtos->whereBetween('valor_produto', [$minValor, $maxValor]);
        }

        if ($request->filled('cidade')) {
            $produtos->where('cidade', $request->cidade);
        }

        if ($request->filled('marca_produto')) {
            $produtos->where('marca_produto', $request->marca_produto);
        }

        if ($request->filled('estoque_minimo')) {
            $produtos->where('estoque', '>=', $request->estoque_minimo);
        }

        return response()->json($produtos->get());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produto = Produto::find($id);

        if (!$produto)
            return response()->json(['message' => 'Produto não encontrado'], 404);

        if ($produto->estoque > 0)
            return response()->json(['message' => 'Produto não pode ser removido, pois ainda possui estoque'], 400);

        $produto->delete();

        return response()->json(['message' => 'Produto removido com sucesso']);
    }
}
