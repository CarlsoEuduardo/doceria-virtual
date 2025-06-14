<?php
$token = $_GET['token'] ?? '';

if(!empty($token))
{
    require "../model/Email.php";
    $status = Email::tokenAuth($token, "senha");

    if($status) {
        session_start();
        $_SESSION['trocando_senha'] = true;
        header("Location: ../view/trocarSenha.php");
        exit;
    }
    else {
        echo "
            <script>
                alert('Erro: Token inválido');
                window.location.replace('../index.php');
            </script>
        ";
        exit;
    }

}
else
{
    echo "
        <script>
            alert('Erro: Não há nada a ser feito.');
            window.location.replace('../index.php');
        </script>
    ";
    exit;
}
