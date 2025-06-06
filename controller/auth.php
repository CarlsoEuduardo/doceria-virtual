<?php
// Set timeout duration in seconds (e.g., 1800 = 30 minutes)
$timeout = 1800;

// Start or resume the session
session_start();

// Check for timeout
if (
    isset($_SESSION['ULTIMA_ATIVIDADE'])    && 
    (time() - $_SESSION['ULTIMA_ATIVIDADE']) > $timeout
) {
    // Last request was over timeout_duration ago
    require_once 'logout.php';
    exit;
}

$_SESSION['ULTIMA_ATIVIDADE'] = time(); // Update last activity timestamp
?>