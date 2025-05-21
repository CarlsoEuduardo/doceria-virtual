<?php

$host = "localhost:3307";
$username = "root";
$password = "";
$dbname = "LOS_DOCES";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conectado com Sucesso!";
    return $pdo;
} catch (PDOException $e) {
    die("Erro na Conexão com o Banco de Dados: ". $e->getMessage());
}

?>