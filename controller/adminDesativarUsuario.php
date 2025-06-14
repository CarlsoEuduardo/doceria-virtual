<?php
require "authAdmin.php";

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
    try {
        $usuario = new Usuario($id);
        $usuario->desativar();
        echo "
            <script>
                alert('Usuário desativado com sucesso!');
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