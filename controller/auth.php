<?php
// Seta a duração de timeout em segundos (ex.: 1800 = 30 minutos)
$timeout = 1800;
// Seta a duração de timeout em segundos (ex.: 7200 = 2 horas)
$spam_timeout = 7200;

// Inicia sessão
session_start();

// Compara o horário e o timeout
if (
    isset($_SESSION['ultima_atividade'])    && 
    (time() - $_SESSION['ultima_atividade']) > $timeout
) {
    // Desativa o timeout
    unset($_SESSION['ultima_atividade']);

    require_once 'logout.php';
    exit;
}

// Compara o horário e o spam_atividade
if (
    isset($_SESSION['spam_atividade'])    && 
    (time() - $_SESSION['spam_atividade']) > $spam_timeout
) {
    // Desativa o timeout da spam_atividade
    unset($_SESSION['spam_limit']);
    unset($_SESSION['spam_atividade']);
}

$_SESSION['ultima_atividade'] = time(); // Atualiza o tempo da ultima_atividade
?>