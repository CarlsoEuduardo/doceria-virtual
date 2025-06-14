<?php
require "authUsuario.php";
require_once '../model/logica.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!isset($_SESSION['trocando_senha'])) {       // Sem ter esquecido a senha (vindo de editarUsuario.php) ------ Continuar lá em baixo...
        $senha_atual = Logica::sanitize_input($_POST['senha_atual']);       // Se a senha atual está incorreta
        if(!Usuario::validarSenha($_SESSION['usuario']->getEmail(), $senha_atual)) {
            echo "
                <script>
                    alert('Atenção: A senha atual está incorreta!');
                    window.history.back();
                </script>
            ";
            exit;
        }
    }

    $senha = Logica::sanitize_input($_POST['senha']);
    $confirmar_senha = Logica::sanitize_input($_POST['confirmar-senha']);

    if($senha != $confirmar_senha) {        // Se as senhas não são iguais
        echo "
            <script>
                alert('Atenção: As senhas não coincidem!');
                window.history.back();
            </script>
        ";
        exit;
    }

    $_SESSION['usuario']->trocarSenha($senha);

    if(!isset($_SESSION['trocando_senha'])) {       // Sem ter esquecido a senha (vindo de editarUsuario.php)
        echo "
            <script>
                alert('Senha trocada com Sucesso!');
                window.location.replace('../view/editarUsuario.php');
            </script>
        ";
        exit;
    } else {
        unset($_SESSION['trocando_senha']);
        echo "
            <script>
                alert('Senha trocada com Sucesso!');
                window.location.replace('logout.php');
            </script>
        ";
        exit;
    }
    
}