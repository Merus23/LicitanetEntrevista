<?php

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

// Rotas CRUD para o Produto
Route::get('produtos', [ProdutoController::class, 'index']); // Lista todos os produtos
Route::get('produtos/{id}', [ProdutoController::class, 'show']); // Busca produto por id
Route::post('produtos', [ProdutoController::class, 'store']); // Cria um novo produto
Route::put('produtos/{id}', [ProdutoController::class, 'update']); // Atualiza um produto existente
Route::delete('produtos/{id}', [ProdutoController::class, 'destroy']); // Deleta um produto
