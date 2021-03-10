<?php
namespace App\classes;

class SenhaAleatoria{
    // Atributos
    // Método
    public static function criarSenha(){
        // Criando a senha aleatória
        $senha = '';
        $caracteres = 'abcdefghijklmnopqrstuvwxyz_ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$&';

        for ($i=0; $i<4; $i++){
            $sorteado = rand(0, strlen($caracteres));
            $senha = substr($caracteres, $sorteado, 4);
        }
        return $senha;
    }
}
?>