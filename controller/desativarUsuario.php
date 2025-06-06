<?php
require "../controller/auth.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_usuario'];
    
    echo "<script>";
    if($_SESSION['usuario']->getId == $id || $_SESSION['usuario']->getId == 1) {
        $_SESSION['usuario']->Desativar();
        echo "alert('Conta desativada com sucesso!');";
    } else {
        echo "alert('Acesso Negado!');";
    }
    echo "window.history.back();</script>";
    exit;
}