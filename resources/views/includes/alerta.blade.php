<div class="container justify-content-center">
@if (count($errors) > 0) 
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endforeach
@endif

@if (Session::has('mensagem-sucesso'))
    <div class="alert alert-success" role="alert">
        <strong>{{ Session::get('mensagem-sucesso') }}</strong>
    </div>
@endif

@if (Session::has('mensagem-falha'))
    <div class="alert alert-danger" role="alert">
        <strong>{{ Session::get('mensagem-falha') }}</strong>
    </div>
@endif
</div>