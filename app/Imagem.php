<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagem extends Model
{
    protected $table = 'imagens';

    public function produtos()
    {
        return $this->morphedByMany('App\Produto', 'imageable');
    }
}
