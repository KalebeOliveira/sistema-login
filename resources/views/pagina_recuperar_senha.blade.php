@extends('layouts.app')

@section('titulo')
    Recuperar Senha
@endsection

@section('conteudo')
    <div class="row text-center" id="login_container">
        <div class="col-md-4 offset-md-4">

            <img src="{{asset('img/login_usuario.png')}}" class="img-fluid" alt="Imagem da pagina de Login Usuários">

            @include('inc.erros')

            <form method="post" action="/recuperar_senha">

                {{csrf_field()}}

                <div class="form-group text-justify">
                    <label for="email_usuario">Email:</label>
                    <input type="email" class="form-control" name="text_email" id="email_usuario" placeholder="Email do usuário">
                </div>

                <button type="submit" class="btg btn-primary" id="button"><strong>Recuperar senha</strong>   </button>
            </form>
        </div>

        <div class="col-md-4 offset-md-4">
            <p style="margin: 10px"><a href="/">Fazer login</a></p>
            <p style="margin: -10px"><a href="/pagina_cadastro">Criar nova conta</a></p>
        </div>
    </div>
@endsection