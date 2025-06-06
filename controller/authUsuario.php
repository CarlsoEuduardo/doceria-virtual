<?php
require '../model/usuario.php';
require 'auth.php';

if(!isset($_SESSION['usuario'])) {
    require_once 'logout.php';
    exit;
}
?>