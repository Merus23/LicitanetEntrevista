<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $primaryKey = 'cod_cidade';
    public function produtos()
    {
        return $this->hasMany(Produto::class, 'cod_cidade');
    }
    use HasFactory;
}
