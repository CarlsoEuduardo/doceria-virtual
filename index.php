<!DOCTYPE html>
<html lang="pt-br">
    <?php
        require "model/usuario.php";
        session_start();
        if(isset($_SESSION['usuario'])) {
            echo "
                <script>
                    window.location.replace('../view/catalogo.php');
                </script>
            ";
        }
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Los Doces</title>
    <style>
        button {
            font-size: 14px;
            padding: 10px;
            padding-left: 40px;
            padding-right: 40px;
            margin-right: 20px;
            border: none;
            border-radius: 5px;
            transition: all linear 160ms;
        }
        button:hover {
            transform: scale(1.05);
        }

        .btn-login {
            background-color: #f593b0;
        }
        .btn-login:hover {
            background-image: linear-gradient(to right, #F8AAC1, #ff0676);
        }

    </style>
</head>
<body>
    <a href='view/login.html'><button class='btn-login'>Login</button></a>
    <a href='view/cadastro.html'><button class='btn-login'>Cadastrar-se</button></a>
</body>
</html>