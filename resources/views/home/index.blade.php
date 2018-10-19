@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Procurar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Procurar</button>
        </form>
    </div>
    <br>
    <div class="card-group">
        <div class="row ">
            @forelse ($registros as $registro)
                <div class="col-md-4">
                    <div class="card" style="max-width: 18rem;">
                        <a href="{{ route('produto', $registro->id) }}">
                        <img style="width: 18rem; height: 15rem" class="card-img-top" src="{{ Storage::url($registro->imagens->first()->caminho) }}" alt="{{ $registro->imagens->first()->descricao }}">
                            <div class="card-body">
                                <p class="card-title">{{ $registro->nome }}</p>
                                <p class="card-text"><strong>R$ {{ number_format($registro->preco, 2, ',', '.') }}</strong></p>
                            </div>
                        </a>
                    </div>                
                </div>
            @empty
                Não há produtos cadastrados.
            @endforelse
        </div>
    </div>
</div>
@endsection
