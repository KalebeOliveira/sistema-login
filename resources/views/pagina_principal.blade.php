@extends('layouts.app')

@section('titulo')
    Página Principal
@endsection

@section('conteudo')
    <div class="row text-center" id="login_container">
        <div class="col-md-4 offset-md-4">
            <h1 class="alert alert-success"><strong>Usuário Logado</strong></h1>
            <p>ID do usuário: {{session('id_usuario')}}</p>
            <p>Usuário: {{session('usuario')}} </p>
            <a href="/usuario_logout">Logout</a>
        </div>
    </div>
@endsection