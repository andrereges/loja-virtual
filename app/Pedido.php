<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Pedido extends Model
{
    protected $fillable = [
        'user_id',
        'status'
    ];

    public function pedido_produtos()
    {
        return $this->hasMany('App\PedidoProduto')
            ->select(\DB::raw('produto_id, sum(valor) as valores, count(1) as quantidade') )
            ->groupBy('produto_id')
            ->orderBy('produto_id', 'desc');
    }

    public function getValorTotal() {
        $valorTotal = \DB::table('pedidos')
            ->join('pedido_produtos', 'pedido_produtos.pedido_id', '=', 'pedidos.id')
            ->select( \DB::raw('SUM(valor) as valor'))
            ->where('pedidos.status', '=', 'RESERVADO')
            ->where('pedidos.user_id', '=', Auth::id())
            ->first();

        return $valorTotal->valor;
    }

    public function quantidadeItens() {
        if(!Auth::id()) {
            return 0;
        }

        $quantidade_pedido_produtos = $this::withCount('pedido_produtos as quantidade')
            ->where('status', '=', 'RESERVADO')
            ->where('user_id', '=', Auth::id())
            ->first(['quantidade']);

            if(!$quantidade_pedido_produtos) {
                return 0;
            }

        return $quantidade_pedido_produtos->quantidade;
    }

    public function pedido_produtos_itens()
    {
        return $this->hasMany('App\PedidoProduto');
    }

    public static function consultaId($where)
    {
        $pedido = self::where($where)->first(['id']);
        return !empty($pedido->id) ? $pedido->id : null;
    }
}
