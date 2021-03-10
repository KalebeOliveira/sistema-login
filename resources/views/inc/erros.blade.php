{{-- Apresentando erros do formulário --}}
@if (count($errors) != 0)
    <div class="alert alert-danger">
        @if (count($errors) == 1)
            <p class="titulo-erro">ERRO:</p>
        @else
            <p class="titulo-erro">ERROS:</p>
        @endif

        <ul>
            @foreach($errors->all() as $erro)
                <li>{{$erro}}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Apresentando erros relacionados ao contato com a base de dados --}}
@if(isset($erros_db))
    <div class="alert alert-danger">
        @foreach($erros_db as $erro)
            <p>{{$erro}}</p>
        @endforeach
    </div>
@endif
