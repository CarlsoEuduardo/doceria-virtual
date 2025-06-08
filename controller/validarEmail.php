<?php
$token = $_GET['token'] ?? '';

if(!empty($token))
{

    $status = Email::tokenAuth($token);

    if($status == 'valido') {
        echo "
            <script>
                alert('E-mail Verificado com Sucesso!');
                window.location.replace('../view/login.html');
            </script>
        ";
        exit;
    }
    else if($status == 'invalido') {
        echo "
            <script>
                alert('Erro: Token inválido');
                window.history.back();
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
            window.history.back();
        </script>
    ";
    exit;
}
