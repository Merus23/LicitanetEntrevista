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

    public function store(string $request)
    {
        $marca = Marca::create([
            'nome_marca' => $request,
        ]);

        return response()->json($marca, 201);
    }
}
