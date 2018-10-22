@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $registro->nome }}</h3>
        </div>
        <div class="card-body">
          <div class="row justify-content-left">
                <div class="col-md-4">
                    <img class="card-img-top" src="{{ Storage::url($registro->imagens->first()->caminho) }}" alt="{{ $registro->imagens->first()->descricao }}">
                </div>
                <div class="col-md-8">
                        <h4 class="card-title"><strong>Descrição</strong></h4>
                    <p class="card-title">{{ $registro->descricao }}</p>
                    <p class="card-text"><strong>R$ {{ number_format($registro->preco, 2, ',', '.') }}</strong></p>
                    
                    <form method="POST" action="{{ route('carrinho.adicionar') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $registro->id }}">
                        <button class="btn btn-lg btn-success">Comprar</button>   
                    </form>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h4 class="card-title"><strong>Categorias</strong></h4>

                    @foreach ($registro->categorias()->get() as $categoria)
                    <p class="card-text"><li>{{ $categoria->nome }}</li></p>
                    @endforeach

                </div>
                <div class="col-md-12">
                    <hr>
                    <h4 class="card-title"><strong>Características</strong></h4>

                    @foreach ($registro->caracteristicas()->get() as $caracteristica)
                    <p class="card-text"><li><strong>{{ $caracteristica->nome }}: </strong>{{ $caracteristica->pivot->valor }}</li></p>
                    @endforeach
                                        
                </div>
          </div>
        </div>
    </div>
</div>
@endsection
