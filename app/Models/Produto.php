<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $primaryKey = 'cod_produto';
    protected $fillable = ['nome_produto', 'marca_produto', 'cod_cidade', 'preco_produto'];

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'marca_produto', 'cod_cidade');
    }
    use HasFactory;
}
