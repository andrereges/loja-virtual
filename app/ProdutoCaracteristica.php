<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoCaracteristica extends Model
{
    protected $fillable = [
        'caracteristica_id',
        'produto_id',
        'valor'
    ];

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id', 'id');
    }
}
