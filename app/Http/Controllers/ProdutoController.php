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
    public function index()
    {
        $produtos = Produto::all();
        return response()->json($produtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $produtoRequest)
    {
        $produto = Produto::create([
            'nome_produto' => $produtoRequest->nome_produto,
            'valor_produto' => $produtoRequest->valor_produto,
            'marca_produto' => $produtoRequest->marca_produto,
            'estoque' => $produtoRequest->estoque,
            'cidade' => $produtoRequest->cidade,
        ]);

        return response()->json($produto, 201);
    }

    /**
     * Display the specified resource.
     * @param  string  $id
     */

    public function show(string $id)
    {
        $produto = Produto::with(['marca', 'cidade'])->find($id);

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

        $produto->delete();

        return response()->json(['message' => 'Produto removido com sucesso']);
    }
}
