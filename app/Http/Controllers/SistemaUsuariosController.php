<?php

namespace App\Http\Controllers;

use App\Mail\emailRecuperarSenha;
use App\usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Session;
use App\classes\SenhaAleatoria;


class SistemaUsuariosController extends Controller
{
    public function Index(){
        // Verificar se existe sessão
        if (!Session::has('login')){
            // Se não existe sessão apresenta formulário de login
            return $this->ApresentarPaginaLogin();
        }
        else {
            return view('pagina_principal');
        }
    }
    // Funções para mostrar paginas de login/cadastro
    public function ApresentarPaginaLogin(){
        // Apresenta a página de login
        return view('pagina_login');
    }

    public function ApresentarPaginaCadastro(){
        // Apresenta a página de cadastro de um novo usuário
        return view('pagina_cadastro');
    }

    public function ApresentarRecuperarSenha(){
        //Apresenta a página de recuperação de senha
        return view('pagina_recuperar_senha');
    }

    public function ApresentarPaginaPrincipal(){
        // Apresenta a página de cadastro de um novo usuário
        return view('pagina_principal');
    }

    public function EmailEnviado(){
        return view('usuario_email_enviado');
    }

    // Função para cadastro de novo usuário
    public function CadastroUsuario(Request $request)
    {
        // Validando formulário de cadastro
        $this->validate($request, [
            'text_usuario' => 'required|between:3,30|alpha_num',
            'text_email' => 'required|email',
            'text_senha' => 'required|between:6,15',
            'text_senha_repetida' => 'required|same:text_senha'
        ]);

        // Pegando todos os dados de um usuário na DB a partir do nome
        $dados = usuarios::where('usuario', '=', $request->text_usuario)
            ->orwhere('email', '=', $request->text_email)
            ->get();;

        // Verificando se o usuário ja existe para fazer o cadastro
        if ($dados->count() != 0) {
            $erros_db = ['Já existe um usuário com o mesmo nome ou com o mesmo email.'];
            return view('pagina_cadastro', compact('erros_db'));
        }

        else {
            // Salvando dados do novo usuário na DB
            $novo_usuario = new usuarios();
            $novo_usuario->usuario = $request->text_usuario;
            $novo_usuario->email = $request->text_email;
            $novo_usuario->senha = Hash::make($request->text_senha);

            // Verificando se o checkbox está marcado ou não
            if (isset($request->check_notificacao))
                $novo_usuario->notificacao = 1;
            else
                $novo_usuario->notificacao = 0;

            // Salvando os dados
            $novo_usuario->save();

            // Retornando a página de login
            return redirect('/');
        }
    }


    // Função para fazer login do usuário
    public function FazerLogin(Request $request){
        $this->validate($request, [
            'text_email' => 'required',
            'text_senha' => 'required'
        ]);

        // Pegando todos os dados da DB a partir do nome do usuário
        $dados = usuarios::where('email', $request->text_email)->first();

        // Verificando se o email e senha estão cadastrados na DB
        if (is_null($dados)){
            $erros_db = ['Email inválido ou não cadastrado'];
            return view('pagina_login', compact('erros_db'));
        }

        // verificando senha
        if (!Hash::check($request->text_senha, $dados->senha)){
            $erros_db = ['Senha incorreta'];
            return view('pagina_login', compact('erros_db'));
        }

        // Criar/abrir sessão de usuário
        Session::put('login', 'sim');
        Session::put('id_usuario', $dados->id_usuario);
        Session::put('usuario', $dados->usuario);

        return redirect('pagina_principal');
    }

    // Função para fazer logout do usuário
    public function Logout(){
        // Vai destruir a sessão que está ativa no momento
        Session::flush();

        // Vai redirecionar para a página de login depois de destruir a sessão
        return redirect('/');
    }

    // Função para recuperar senha
    public function RecuperarSenha(Request $request){
        // Faz a validação do formulário
        $this->validate($request, [
            'text_email' => 'required'
        ]);

        // Verifica se o email do usuário existe
        $dados = usuarios::where('email', $request->text_email)->get();

        // Verifica se o email corresponde ao email na base de dados
        if (count($dados) == 0){
            $erros_db = ['Email inexistente ou incorreto'];
            return view('pagina_recuperar_senha', compact('erros_db'));
        }

        // Se o email existir criamos uma senha aleatória
        $nova_senha = SenhaAleatoria::criarSenha();

        // Alterar a senha da base de dados
        $dados = $dados->first();
        $dados->senha = Hash::make($nova_senha);
        $dados->save();

        // Enviar email ao usuário com a nova senha
        Mail::to($dados->email)->send(new emailRecuperarSenha($nova_senha));

        // Apresenta a view para o usuário dizendo que a senha foi alterada
        return redirect('/usuario_email_enviado');
    }
}
