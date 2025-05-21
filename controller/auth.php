<?php
require_once '../model/usuario.php';
session_start();
if(!isset($_SESSION['usuario'])) {
    session_unset();
    session_destroy();
    header('Location: ../view/login.html');
    exit;
}
?>