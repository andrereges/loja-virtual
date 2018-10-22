@extends('layouts.app')

@section('content')
<div class="container">
    <br>
        <div class="row justify-content-center">
            @forelse ($pedidos as $pedido)
                <h5 class="col l6 s12 m6"> Pedido: {{ $pedido->id }} </h5>
                <h5 class="col l6 s12 m6"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Quantidade</th>
                            <th>Produto</th>
                            <th>Valor Unit.</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->pedido_produtos as $pedido_produto)
                            <tr>
                                <td>
                                    <img style="width: 5em; height: 5em" src="{{ Storage::url($pedido_produto->produto->imagens->first()->caminho) }}">
                                </td>
                                <td class="center-align">
                                    <div class="center-align">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <form method="POST" action="{{ route('carrinho.remover') }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }} 
                                                    <input type="hidden" name="id_pedido" value="{{ $pedido->id }}">
                                                    <input type="hidden" name="id_produto" value="{{ $pedido_produto->produto->id }}">
                                                    <button class="btn btn-danger">Del</button>   
                                                </form>
                                            </span>
                                            <span class="btn btn-default">{{ $pedido_produto->quantidade }}</span>
                                            <span class="input-group-btn">
                                                <form method="POST" action="{{ route('carrinho.adicionar') }}">
                                                    {{ csrf_field() }}                                        
                                                    <input type="hidden" name="id" value="{{ $pedido_produto->produto->id }}">
                                                    <button class="btn btn-primary">Add</button>   
                                                </form>
                                            </span>
                                        </div>
                                    </div>                                
                                </td>
                                <td> {{ $pedido_produto->produto->nome }} </td>
                                <td>R$ {{ number_format($pedido_produto->produto->preco, 2, ',', '.') }}</td>
                                <td>R$ {{ number_format($pedido_produto->valores, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>                
                <div class="col-md-12 text-right">
                    <h5>
                        <strong>Total do pedido: </strong>
                        <span>R$ {{ number_format($pedido->getValorTotal(), 2, ',', '.') }}</span>
                    </h5>
                </div>
                <div class="col-md-12 text-right">
                    <form method="POST" action="{{ route('carrinho.concluir') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="pedido_id" value="{{ $pedido->id }}">
                        <button type="submit" class="btn btn-lg btn-success">
                            Concluir compra
                        </button>   
                    </form>
                </div>
                <div class="col-md-12 text-center">
                    <h4><a href="{{ route('index') }}">Continuar comprando</a></h4>
                </div>
            @empty
                <div class="form-inline my-2 my-lg-1">
                    <h5>Não há nenhum item no carrinho</h5>
                    <a class="btn btn-lg" href="{{ route('index') }}">Ir as compras</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
