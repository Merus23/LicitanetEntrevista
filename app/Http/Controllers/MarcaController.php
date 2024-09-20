<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{


    public function index()
    {
        $marcas = Marca::all();
        return response()->json($marcas);
    }

    public function store(Request $request)
    {
        $marca = Marca::create([
            'nome_marca' => $request->nome_marca,
            'fabricante' => $request->fabricante,
        ]);

        return response()->json($marca, 201);
    }
}
