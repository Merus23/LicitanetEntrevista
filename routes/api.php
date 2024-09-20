<?php

use App\Http\Controllers\CidadeController;
use App\Http\Controllers\MarcaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return response()->json(['message' => 'API - Produtos']);
});

// Rotas CRUD para o Produto
Route::get('produtos', [ProdutoController::class, 'index']); // Lista todos os produtos
Route::get('produto/{id}', [ProdutoController::class, 'show']); // Busca produto por id
Route::post('produto', [ProdutoController::class, 'store']); // Cria um novo produto
Route::put('produto/{id}', [ProdutoController::class, 'update']); // Atualiza um produto existente
Route::delete('/produto/{id}', [ProdutoController::class, 'destroy']); // Deleta um produto

// Rotas CRUD para a Marca
Route::post('/marca', [MarcaController::class, 'store']); // Cria uma nova marca

// Rotas CRUD para a Cidade
Route::post('/cidade', [CidadeController::class, 'store']); // Cria uma nova cidade
