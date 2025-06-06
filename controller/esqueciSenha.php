<?php
require "auth.php";

/* verificar spam */
if(!isset($_SESSION['esqueciSenha_limit'])) {
    $_SESSION['esqueciSenha_limit'] = 0;
}

if($_SESSION['esqueciSenha_limit'] < 5) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        if(empty($email)) {
            echo "
                <script>
                    alert('Atenção: Preencha o campo!');
                    window.history.back();
                </script>
            ";
            exit;
        } else {
            $_SESSION['esqueciSenha_limit']++;

            require "../model/usuario.php";
            if(Usuario::procurarEmail($email)) {
                require "../model/Auth.php";
                Mail::mail($email);
                echo "
                    <script>
                        alert('E-mail enviado com sucesso! Atenção ao tempo, seu código expira em 5 minutos!');
                        window.location.replace('../view/CodigoVerificacao.php');
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
    echo "
        <script>
            alert('Tentativas muito frequentes. Tente novamente mais tarde.');
            window.history.back();
        </script>
    ";
    exit;
}
?>