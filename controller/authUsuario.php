<?php
require '../model/usuario.php';
require 'auth.php';

if(
    !   isset($_SESSION['usuario'])        || 
    !   $_SESSION['usuario']->isAtivo()
) {
    require_once 'logout.php';
    exit;
}
?>