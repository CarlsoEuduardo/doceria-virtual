<?php
require "authAdmin.php";

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    try {
        $usuario = new Usuario($id);
        $usuario->ativar();
        echo "
            <script>
                alert('Usuário ativado com sucesso!');
                window.history.back();
            </script>
        ";
        exit;
    } catch(Exception $e) {
        echo "
            <script>
                alert('Erro: $e');
                window.history.back();
            </script>
        ";
    }
}