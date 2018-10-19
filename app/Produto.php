<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'ativo'
    ];

    public function imagens()
    {
        return $this->morphToMany('App\Imagem', 'imageable');
    }

    public function categorias()
    {
        return $this->belongsToMany('App\Categoria', 'produto_categorias', 'produto_id', 'categoria_id');
    }

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Caracteristica', 'produto_caracteristicas', 'produto_id', 'caracteristica_id')->withPivot('valor');
    }
}
