<?php
require "auth.php";
require "../model/logica.php";

/* verificar spam */
if(!isset($_SESSION['spam_limit'])) {
    $_SESSION['spam_limit'] = 0;
}

if(
    $_SERVER['REQUEST_METHOD' === 'POST']   &&
    $_SESSION['spam_limit'] < 5
    ) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = Logica::validate_email($_POST['email']);
        if(empty($email)) {
            echo "
                <script>
                    alert('Atenção: Preencha o campo!');
                    window.history.back();
                </script>
            ";
            exit;
        } else {
            $_SESSION['spam_limit']++;

            require "../model/usuario.php";
            if(Usuario::procurarEmail($email)) {
                require "../model/Email.php";
                Email::enviar($email, 'senha');
                echo "
                    <script>
                        alert('E-mail enviado com sucesso! Atenção ao tempo, seu código expira em 15 minutos!');
                        window.location.replace('../index.php');
                    </script>
                ";
                exit;
            } else {
                echo "
                    <script>
                        alert('Atenção: E-mail não cadastrado!');
                        window.history.back();
                    </script>
                ";
            exit;
            }
        }
    }
    exit;
} else {
    if(!isset($_SESSION['spam_atividade'])) {
        $_SESSION['spam_atividade'] = time();
    }
    echo "
        <script>
            alert('Tentativas muito frequentes. Tente novamente mais tarde.');
            window.history.back();
        </script>
    ";
    exit;
}
?>