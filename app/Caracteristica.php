<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    protected $fillable = [
        'nome'
    ];

    public function produto()
    {
        return $this->hasMany('App\Produto', 'produto_caracteristica', 'caracteristica_id', 'produto_id');
    }
}
