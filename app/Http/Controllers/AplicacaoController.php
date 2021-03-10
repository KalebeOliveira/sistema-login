<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AplicacaoController extends Controller
{
    public function ApresentarPaginaPrincipal (){
        // Verifica se a sessão está ativa
        if (!Session::has('login')){return redirect('/');}

        // Apresenta o interior da aplicação
        return view('pagina_principal');
    }
}
