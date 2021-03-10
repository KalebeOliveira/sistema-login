@extends('layouts.app')

@section('titulo')
    Senha alterada
@endsection

@section('conteudo')
<div class="row">
    <div class="col-md-12 text-center">

        <img src="{{asset('img/login_usuario.png')}}" class="img-fluid" alt="Imagem da pagina de Login Usuários">

        <p>Foi enviado um email com a sua nova senha.</p>
        <p>Por favor verifique a sua caixa de email e efetue o login com a nova senha.</p>

        <a href="/">Login</a>
    </div>
</div>
@endsection