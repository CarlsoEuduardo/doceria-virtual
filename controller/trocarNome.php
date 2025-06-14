<?php
require "authUsuario.php";
require "../model/logica.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = Logica::sanitize_input($_POST['nome']);

    if(empty($nome)) {
        echo "
            <script>
                alert('Atenção: O campo nome está vazio!');
                window.history.back();
            </script>
        ";
        exit;
    }
    else if($_SESSION['usuario']->getNome == $nome) {
        echo "
            <script>
                alert('Nada mudou, seu nome ainda é $nome!');
                window.history.back();
            </script>
        ";
        exit;
    }
    else {
        $nome_antigo = $_SESSION['usuario']->getNome();
        $_SESSION['usuario']->trocarNome($nome);
        $nome_novo = $_SESSION['usuario']->getNome();
        echo "
            <script>
                alert('Seu nome mudou de \"$nome_antigo\" para \"$nome_novo!\"');
                window.history.back();
            </script>
        ";
        exit;
    }
}