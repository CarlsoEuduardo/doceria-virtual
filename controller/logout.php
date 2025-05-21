<?php
    session_start();
    session_unset();
    session_destroy();
    echo "
        <script>
            alert('Sessão encerrada!');
            window.location.replace('../index.php');
        </script>
    ";
    exit;
?>