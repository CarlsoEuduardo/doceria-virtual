<?php
require_once '../model/Email.php';
$token = $_GET['token'] ?? '';

if(!empty($token))
{
    $status = Email::tokenAuth($token, "cadastro");

    if($status) {
        echo "
            <script>
                alert('E-mail Verificado com Sucesso!');
                window.location.replace('../view/login.html');
            </script>
        ";
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
