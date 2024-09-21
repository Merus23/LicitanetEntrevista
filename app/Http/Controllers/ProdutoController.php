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


    /**Nome: front
    
     * Store a newly created resource in storage.
     */
    public function store(StoreProdutoRequest $produtoRequest)
    {

        $estoque = $produtoRequest->input('estoque', 0);

        $produto = Produto::create([
            'nome_produto' => $produtoRequest['nome_produto'],
            'valor_produto' => $produtoRequest['valor_produto'],
            'marca_produto' => $produtoRequest['marca_produto'],
            'estoque' => $estoque,
            'cidade' => $produtoRequest['cidade'],
        ]);

        return response()->json($produto, 201);
    }
    /**
     * Display the specified resource.
     * @param  string  $id
     */
    public function show(string $id)
    {
        // Comentado porque no frontend, o produto recebe a marca e a cidade por id e não pelo nome da cidade [FIX]
        //$produto = Produto::with(['marca', 'cidade'])->find($id);
        $produto = Produto::find($id);


        if (!$produto)
            return response()->json(['message' => 'Produto não encontrado'], 404);

        return response()->json($produto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $produto = Produto::find($id);
        if (!$produto)
            return response()->json(['message' => 'Produto não encontrado'], 404);

        $produto->update([
            'nome_produto' => $request->nome_produto,
            'valor_produto' => $request->valor_produto,
            'marca_produto' => $request->marca_produto,
            'estoque' => $request->estoque,
            'cidade' => $request->cidade,
        ]);

        return response()->json($produto);
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
