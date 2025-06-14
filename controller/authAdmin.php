<?php
require_once "authUsuario.php";
if(!$_SESSION['usuario']->isAdmin()) {
    header("Location: ../index.php");
    exit;
}