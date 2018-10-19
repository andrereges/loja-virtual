<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = [
        'nome'
    ];

    public function produtos()
    {
        return $this->hasMany('App\Produto', 'produto_categorias', 'categoria_id', 'produto_id');
    }
}
