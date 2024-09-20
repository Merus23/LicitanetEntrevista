<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{

    public function index()
    {
        $cidades = Cidade::all();
        return response()->json($cidades);
    }

    public function store(Request $request)
    {
        $cidade = Cidade::create([
            'nome_cidade' => $request->nome_cidade,
        ]);

        return response()->json($cidade, 201);
    }
}
