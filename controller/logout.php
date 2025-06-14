<?php
    session_start();

    if(isset($_SESSION['usuario'])) {
        unset($_SESSION['usuario']);
        if(empty($_SESSION)) {
            session_unset();
            session_destroy();
        }

        // Desativar variáveis sem reforço de persistência aqui
        unset($_SESSION['trocando_senha']);
        // ------------
        
        echo "
            <script>
                alert('Sessão Encerrada!');
                window.history.back();
            </script>
        ";
        exit;

    } else if(empty($_SESSION)) {
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit;

    } else {

        // Desativar variáveis sem reforço de persistência aqui
        unset($_SESSION['trocando_senha']);
        // ------------

        header("Location: ../index.php");
        exit;
        
    }
?>