<?php

namespace Tests\Feature;

use App\Models\Cidade;
use App\Models\Marca;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_retorna_todos_produtos_com_marca_e_cidade()
    {
        $cidade = Cidade::create([
            'nome_cidade' => 'Cidade Teste'
        ]);

        $marca = Marca::create([
            'nome_marca' => 'Marca Teste',
            'fabricante' => 'Fabricante Teste'
        ]);

        $produto = Produto::create([
            'cidade' => $cidade->cod_cidade,
            'marca_produto' => $marca->cod_marca,
            'valor_produto' => 100.00,
            'estoque' => 10,
            'nome_produto' => 'Produto Teste'
        ]);

        $response = $this->getJson('/api/produtos');
        $this->assertJson($response->getContent());
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'nome_produto' => $produto->nome_produto,
            'valor_produto' => $produto->valor_produto,
            'estoque' => $produto->estoque,
            'cidade' => $cidade->toArray(),
            'marca' => $marca->toArray()
        ]);
    }

    /** @test */
    public function test_salva_produto()
    {
        $cidade = Cidade::create([
            'nome_cidade' => 'Cidade Teste'
        ]);

        $marca = Marca::create([
            'nome_marca' => 'Marca Teste',
            'fabricante' => 'Fabricante Teste'
        ]);

        $response = $this->postJson('/api/produto', [
            'cidade' => $cidade->cod_cidade,
            'marca_produto' => $marca->cod_marca,
            'valor_produto' => 100.00,
            'estoque' => 10,
            'nome_produto' => "Produto teste" . strval(rand(1, 100)) . strval(rand(1, 100))

        ]);

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'cidade' => $cidade->cod_cidade,
            'marca_produto' => $marca->cod_marca,
            'valor_produto' => 100.00,
            'estoque' => 10,
        ]);
    }

    /** @test */
    public function test_retorna_um_produto()
    {
        $cidade = Cidade::create([
            'nome_cidade' => 'Cidade Teste'
        ]);

        $marca = Marca::create([
            'nome_marca' => 'Marca Teste',
            'fabricante' => 'Fabricante Teste'
        ]);

        $produto = Produto::create([
            'cidade' => $cidade->cod_cidade,
            'marca_produto' => $marca->cod_marca,
            'valor_produto' => 100.00,
            'estoque' => 10,
            'nome_produto' => 'Produto Teste'
        ]);

        $response = $this->getJson('/api/produto/' . $produto->cod_produto);
        $this->assertJson($response->getContent());
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'nome_produto' => $produto->nome_produto,
            'valor_produto' => $produto->valor_produto,
            'estoque' => $produto->estoque,
        ]);
    }

    /** @test */
    public function test_atualiza_produto()
    {
        $cidade = Cidade::create([
            'nome_cidade' => 'Cidade Teste'
        ]);

        $marca = Marca::create([
            'nome_marca' => 'Marca Teste',
            'fabricante' => 'Fabricante Teste'
        ]);

        $produto = Produto::create([
            'cidade' => $cidade->cod_cidade,
            'marca_produto' => $marca->cod_marca,
            'valor_produto' => 100.00,
            'estoque' => 10,
            'nome_produto' => 'Produto Teste'
        ]);

        $response = $this->putJson('/api/produto/' . $produto->cod_produto, [
            'cidade' => $cidade->cod_cidade,
            'marca_produto' => $marca->cod_marca,
            'valor_produto' => 200.00,
            'estoque' => 20,
            'nome_produto' => 'Produto Teste Atualizado'
        ]);

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'nome_produto' => 'Produto Teste Atualizado',
            'valor_produto' => 200.00,
            'estoque' => 20,
        ]);
    }

    /** @test */
    public function test_deleta_produto_com_estoque()
    {
        $cidade = Cidade::create([
            'nome_cidade' => 'Cidade Teste'
        ]);

        $marca = Marca::create([
            'nome_marca' => 'Marca Teste',
            'fabricante' => 'Fabricante Teste'
        ]);

        $produto = Produto::create([
            'cidade' => $cidade->cod_cidade,
            'marca_produto' => $marca->cod_marca,
            'valor_produto' => 100.00,
            'estoque' => 10,
            'nome_produto' => 'Produto Teste'
        ]);

        $response = $this->deleteJson('/api/produto/' . $produto->cod_produto);
        $response->assertStatus(400);
        $response->assertJsonFragment([
            'message' => 'Produto não pode ser removido, pois ainda possui estoque'
        ]);
    }

    /** @test */
    public function test_deleta_produto_sem_estoque()
    {
        $cidade = Cidade::create([
            'nome_cidade' => 'Cidade Teste'
        ]);

        $marca = Marca::create([
            'nome_marca' => 'Marca Teste',
            'fabricante' => 'Fabricante Teste'
        ]);

        $produto = Produto::create([
            'cidade' => $cidade->cod_cidade,
            'marca_produto' => $marca->cod_marca,
            'valor_produto' => 100.00,
            'estoque' => 0,
            'nome_produto' => 'Produto Teste'
        ]);

        $response = $this->deleteJson('/api/produto/' . $produto->cod_produto);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'message' => 'Produto removido com sucesso'
        ]);
    }
}
