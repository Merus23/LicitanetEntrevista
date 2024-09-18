<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $primaryKey = 'cod_marca';
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'marca_produto', 'cod_marca');
    }
    use HasFactory;
}
