@extends('layouts.app')

@section('titulo')
    Cadastro
@endsection

@section('conteudo')
    <div class="row text-center" id="cadastro_container">
        <div class="col-md-4 offset-md-4">

            <img src="{{asset('img/login_usuario.png')}}" class="img-fluid" alt="Imagem da pagina de Login Usuários">

            @include('inc.erros')

            <form method="post" action="/cadastrar_usuario">

                {{csrf_field()}}

                <div class="form-group text-justify">
                    <label for="nome_usuario">Usuário:</label>
                    <input type="text" class="form-control" name="text_usuario" id="nome_usuario" placeholder="Nome do usuário">
                </div>

                <div class="form-group text-justify">
                    <label for="email_usuario">Email:</label>
                    <input type="email" class="form-control" name="text_email" id="email_usuario" placeholder="Email do usuário">
                </div>

                <div class="form-group text-justify">
                    <label for="senha_usuario">Senha:</label>
                    <input type="password" class="form-control" name="text_senha" id="senha_usuario" placeholder="Senha do usuário">
                </div>

                <div class="form-group text-justify">
                    <label for="repetir_senha_usuario">Repetir senha:</label>
                    <input type="password" class="form-control" name="text_senha_repetida" id="repetir_senha_usuario" placeholder="Repita a senha">
                </div>

                <div class="form-check text-justify">
                    <input type="checkbox" class="form-check-input" name="check_notificacao" id="check" checked>
                    <label for="check" class="form-check-label" style="padding-bottom: 10px">Desejo receber notificações</label>
                </div>

                <button type="submit" class="btg btn-primary" id="button"><strong>Entrar</strong></button>

            </form>
        </div>

        <div class="col-md-4 offset-md-4">
            <p style="margin: 5px"><a href="/">Fazer login</a></p>
        </div>
    </div>
@endsection