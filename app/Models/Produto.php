<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $primaryKey = 'cod_produto';
    protected $fillable = ['nome_produto', 'valor_produto', 'marca_produto', 'estoque', 'cidade',];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_produto', 'cod_marca');
    }

    public function cidade()
    {
        return $this->belongsTo(Cidade::class, 'cidade', 'cod_cidade');
    }
    use HasFactory;
}
