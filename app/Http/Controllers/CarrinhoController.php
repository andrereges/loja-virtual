<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;

class CarrinhoController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::where([
            'status'  => 'RESERVADO',
            'user_id' => Auth::id()
        ])->get();

        return view('carrinho.index', compact('pedidos'));
    }

    public function adicionar(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

        $idproduto = $request->input('id');
        $produto = Produto::find($idproduto);

        if( empty($produto->id) ) {
            $request->session()->flash('mensagem-falha', 'Produto não encontrado em nossa loja!');
            return redirect()->route('carrinho.index');
        }

        $idusuario = Auth::id();

        $idpedido = Pedido::consultaId([
            'user_id' => $idusuario,
            'status'  => 'RESERVADO'
        ]);

        if( empty($idpedido) ) {
            $pedido_novo = Pedido::create([
                'user_id' => $idusuario,
                'status'  => 'RESERVADO'
            ]);

            $idpedido = $pedido_novo->id;
        }

        PedidoProduto::create([
            'pedido_id'  => $idpedido,
            'produto_id' => $idproduto,
            'valor'      => $produto->preco,
            'status'     => 'RESERVADO'
        ]);

        $request->session()->flash('mensagem-sucesso', 'Produto adicionado ao carrinho com sucesso!');

        return redirect()->route('carrinho.index');

    }

    public function procurar(Request $request)
    {

        $valor_procurar = $request->input('procurar');

        dd($valor_procurar); die;

        $idpedido = Pedido::consultaId([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'RESERVADO'
        ]);
        

        if( empty($idpedido) ) {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }
      
        $where_produto = [
            'pedido_id'  => $idpedido,
            'produto_id' => $idproduto
        ];

        $produto = PedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();
        
        if( empty($produto->id) ) {
            $request->session()->flash('mensagem-falha', 'Produto não encontrado no carrinho!');
            return redirect()->route('carrinho.index');
        }

        if( $remove_apenas_item ) {
            $where_produto['id'] = $produto->id;
        }

        PedidoProduto::where($where_produto)->delete();

        $check_pedido = PedidoProduto::where([
            'pedido_id' => $produto->pedido_id
        ])->exists();

        if( !$check_pedido ) {
            Pedido::where([
                'id' => $produto->pedido_id
            ])->delete();
        }

        $request->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');

        return redirect()->route('carrinho.index');
    }

    public function remover(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

        $id_pedido = $request->input('id_pedido');
        $id_produto = $request->input('id_produto');
        $id_usuario = Auth::id();

        $idPedido = Pedido::consultaId([
            'id'      => $id_pedido,
            'user_id' => $id_usuario,
            'status'  => 'RESERVADO'
        ]);

        if( empty($idPedido) ) {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }
      
        $where_produto = [
            'pedido_id'  => $id_pedido,
            'produto_id' => $id_produto
        ];
        
        $pedido_produto = PedidoProduto::where($where_produto)->orderBy('id', 'desc')->first();

        if( empty($pedido_produto->id) ) {
            $request->session()->flash('mensagem-falha', 'Produto não encontrado no carrinho!');
            return redirect()->route('carrinho.index');
        }

        PedidoProduto::find($pedido_produto)->first()->delete();

        $check_pedido = PedidoProduto::where([
            'pedido_id' => $id_pedido,
            'status' => 'RESERVADO'
        ])->exists();

        if( !$check_pedido ) {
            Pedido::find($id_pedido)->delete();
        }

        $request->session()->flash('mensagem-sucesso', 'Produto removido do carrinho com sucesso!');

        return redirect()->route('carrinho.index');
    }

    public function concluir(Request $request)
    {
        $this->middleware('VerifyCsrfToken');

        $idpedido  = $request->input('pedido_id');
        $idusuario = Auth::id();

        $check_pedido = Pedido::where([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'RESERVADO'
            ])->exists();

        if( !$check_pedido ) {
            $request->session()->flash('mensagem-falha', 'Pedido não encontrado!');
            return redirect()->route('carrinho.index');
        }

        $check_produtos = PedidoProduto::where([
            'pedido_id' => $idpedido
            ])->exists();
        if(!$check_produtos) {
            $request->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('carrinho.index');
        }

        PedidoProduto::where([
            'pedido_id' => $idpedido
            ])->update([
                'status' => 'PAGO'
            ]);
        Pedido::where([
                'id' => $idpedido
            ])->update([
                'status' => 'PAGO'
        ]);

        $request->session()->flash('mensagem-sucesso', 'Compra concluída com sucesso!');

        return redirect()->route('carrinho.index');
    }

    public function pedidos()
    {
        $pedidos_concluidos = Pedido::where([
            'status'  => 'PAGO',
            'user_id' => Auth::id()
        ])->orderBy('created_at', 'desc')->get();

        $pedidos_cancelados = Pedido::where([
            'status'  => 'CANCELADO',
            'user_id' => Auth::id()
        ])->orderBy('updated_at', 'desc')->get();

        return view('carrinho.pedidos', compact('pedidos_concluidos', 'pedidos_cancelados'));

    }

    public function cancelar()
    {
        $this->middleware('VerifyCsrfToken');

        $req = Request();
        $idpedido       = $req->input('pedido_id');
        $idspedido_prod = $req->input('id');
        $idusuario      = Auth::id();

        if( empty($idspedido_prod) ) {
            $req->session()->flash('mensagem-falha', 'Nenhum item selecionado para cancelamento!');
            return redirect()->route('carrinho.compras');
        }

        $check_pedido = Pedido::where([
            'id'      => $idpedido,
            'user_id' => $idusuario,
            'status'  => 'PA' // Pago
            ])->exists();

        if( !$check_pedido ) {
            $req->session()->flash('mensagem-falha', 'Pedido não encontrado para cancelamento!');
            return redirect()->route('carrinho.compras');
        }

        $check_produtos = PedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'PA'
            ])->whereIn('id', $idspedido_prod)->exists();

        if( !$check_produtos ) {
            $req->session()->flash('mensagem-falha', 'Produtos do pedido não encontrados!');
            return redirect()->route('carrinho.compras');
        }

        PedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'PA'
            ])->whereIn('id', $idspedido_prod)->update([
                'status' => 'CA'
            ]);

        $check_pedido_cancel = PedidoProduto::where([
                'pedido_id' => $idpedido,
                'status'    => 'PA'
            ])->exists();

        if( !$check_pedido_cancel ) {
            Pedido::where([
                'id' => $idpedido
            ])->update([
                'status' => 'CA'
            ]);

            $req->session()->flash('mensagem-sucesso', 'Compra cancelada com sucesso!');

        } else {
            $req->session()->flash('mensagem-sucesso', 'Item(ns) da compra cancelado(s) com sucesso!');
        }

        return redirect()->route('carrinho.compras');
    }
}
