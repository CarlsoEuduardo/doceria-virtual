<?php
require "../controller/auth.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_usuario'];
    
    echo "<script>";

    if(
        $_SESSION['usuario']->getId == $id) {
            echo "
                if(!confirm('Tem certeza que deseja desativar a conta?')) {
                    window.history.back();</script>
                }
            ";

        $usuario = new Usuario($id);
        $usuario->Desativar();
        echo "alert('Conta desativada com sucesso!');";
    } else {
        echo "alert('Acesso Negado!');";
    }
    echo "window.history.back();</script>";
    exit;
}