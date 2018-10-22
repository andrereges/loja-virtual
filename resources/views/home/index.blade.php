@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form class="form-inline" action="{{ route('index') }}" method="GET">
            <div class="form-group mx-sm-3 mb-2">
                <label for="categoria" class="mx-sm-3">Categorias</label>
                <select name="categoria" class="form-control">
                    <option value="">Todas</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" 
                            @if($inputs['categoria'] == $categoria->id) selected="selected" @endif>                            
                            {{ $categoria->nome }}
                        </option>
                    @endforeach                    
                </select>
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input name="produto" class="form-control" value="{{ $inputs['produto'] }}" type="search" placeholder="Procurar">
            </div>
            <button class="btn btn-outline-success mb-2" type="submit">Procurar</button>
        </form>
    </div>
    <br>
        <div class="card-deck">
            @forelse ($registros as $registro)
                <div class="col-md-4">
                    <div class="card" style="max-width: 18rem;">
                        <a href="{{ route('produto', $registro->id) }}">
                            <div class="card-body">
                                <img style="min-height: 15rem; max-height: 15rem;" class="card-img-top" src="{{ Storage::url($registro->imagens->first()->caminho) }}" alt="{{ $registro->imagens->first()->descricao }}">
                            </div>
                            <div class="card-body text-center">
                                <p class="card-title">{{ $registro->nome }}</p>
                                <p class="card-text"><strong>R$ {{ number_format($registro->preco, 2, ',', '.') }}</strong></p>
                            </div>
                        </a>
                    </div>                
                </div>
            @empty
                Nenhum produto encontrado.
            @endforelse
        </div>
</div>
@endsection
