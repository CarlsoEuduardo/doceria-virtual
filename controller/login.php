<?php
require_once '../model/logica.php';
require_once '../model/usuario.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = Logica::sanitize_input($_POST['email']);
    $senha = Logica::sanitize_input($_POST['senha']);
    
    /* Vaidações */
    if(empty($email) || empty($senha)) {         // Se os campos estão preenchidos
        echo "
            <script>
                alert('Atenção: Preencha todos os campos!');
                window.history.back();
            </script>
        ";
        exit;
    }
    if(!Usuario::validarSenha($email, $senha)) {         // Se o email é valido e se a senha está correta
        echo "
            <script>
                alert('Atenção: Usuário ou senha incorretos!');
                window.history.back();
            </script>
        ";
        exit;
    } else {
        try {
            if (Usuario::login($email)) {         // Sucesso!
                echo "
                    <script>
                        alert('Login Realizado com Sucesso!');
                        window.location.replace('../view/catalogo.php');
                    </script>
                ";
                exit;
            } else {         // Conta não ativada
                echo "
                    <script>
                        alert('Atenção: Conta não ativada, verifique seu email.');
                        window.history.back();
                    </script>
                ";
                exit;
            }
        } catch(Exception $e) {         // Erro
            echo "
                <script>
                    alert('Erro: $e');
                    window.history.back();
                </script>
            ";
            exit;
        }
    }
}
?>