<?php
require_once '../model/logica.php';
require_once '../model/usuario.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = Logica::sanitize_input($_POST['nome']);
    $email = Logica::sanitize_input($_POST['email']);
    $senha = Logica::sanitize_input($_POST['senha']);
    $confirmar_senha = Logica::sanitize_input($_POST['confirmar-senha']);
    
    /* Validações */
    if(
        empty($nome) ||
        empty($email) ||
        empty($senha) ||
        empty($confirmar_senha)
    ) {         // Se os campos não estão preenchidos
        echo "
            <script>
                alert('Atenção: Preencha todos os campos!');
                window.history.back();
            </script>
        ";
        exit;
    }
    if($senha != $confirmar_senha) {        // Se não confirmou a senha
        echo "
            <script>
                alert('Atenção: As senhas não coincidem!');
                window.history.back();
            </script>
        ";
        exit;
    }
    if(!Logica::validate_email($email)) {       // Se o e-mail é ou não válido
        echo "
            <script>
                alert('Atenção: E-mail inválido.');
                window.history.back();
            </script>
        ";
        exit;
    }

    /* Tenta Fazer Cadastro */      // Mais Validações
    try {
        if (Usuario::procurarEmail($email)) {       // Se o E-mail já existe
            echo "
                <script>
                    alert('Atenção: E-mail indisponível!');
                    window.history.back();
                </script>
            ";
            exit;
        } else {       // Sucesso
            $usuario = new Usuario($nome, $email, $senha);
            $usuario->cadastrar();
            echo "
                <script>
                    alert('Cadastro Realizado com Sucesso!');
                    window.location.replace('../view/login.html');
                </script>
            ";
            exit;
        }
    } catch(Exception $e) {       // Erro
        echo "
            <script>
                alert('Erro: $e');
                window.history.back();
            </script>
        ";
        exit;
    }
}
?>