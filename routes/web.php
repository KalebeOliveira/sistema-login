<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rotas para apresentar páginas de Login/Cadastro/Página Principal/Recuperar senha
Route::get('/', 'SistemaUsuariosController@ApresentarPaginaLogin');
Route::get('pagina_cadastro', 'SistemaUsuariosController@ApresentarPaginaCadastro');
Route::get('recuperar_senha', 'SistemaUsuariosController@ApresentarRecuperarSenha');

// Rota para enviar formulário de cadastro
Route::post('cadastrar_usuario', 'SistemaUsuariosController@CadastroUsuario');

// Rota para enviar formulário de login
Route::post('login_usuario', 'SistemaUsuariosController@FazerLogin');

// Rota para logout do usuário
Route::get('usuario_logout', 'SistemaUsuariosController@Logout');

// Rota para recuperar senha
Route::post('recuperar_senha', 'SistemaUsuariosController@RecuperarSenha');

// Interior da aplicação
Route::get('pagina_principal', 'SistemaUsuariosController@Index');

// Rota para a página de confirmação de mudança de senha
Route::get('usuario_email_enviado', 'SistemaUsuariosController@EmailEnviado');