@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="text-center">Meus Pedidos Concluídos</h3>
    <div class="row">
        @forelse ($pedidos_concluidos as $pedido)
            <table class="table table-striped table-bordered">
                <h5 class="col l6 s12 m6"> Pedido: {{ $pedido->id }} </h5>
                <h5 class="col l6 s12 m6"> Criado em: {{ $pedido->created_at->format('d/m/Y H:i') }} </h5>
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Unit.</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pedido->pedido_produtos as $pedido_produto)
                        <tr>
                            <td>
                                <img width="100" height="100" src="{{ Storage::url($pedido_produto->produto->imagens->first()->caminho) }}">
                            </td>
                            <td>{{ $pedido_produto->produto->nome }}</td>
                            <td>{{ $pedido_produto->quantidade }}</td>
                            <td>R$ {{ number_format($pedido_produto->produto->preco, 2, ',', '.') }}</td>
                            <td>R$ {{ number_format($pedido_produto->valores, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @empty
            <h5>Não há nenhum pedido concluídos</h5>
        @endforelse
    </div>
</div>

@endsection