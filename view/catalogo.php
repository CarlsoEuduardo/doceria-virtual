<!DOCTYPE html>
<html lang="pt-br">
    <?php require "../controller/authUsuario.php" ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Los Doces</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8AAC1;
            color: #fff;
        }

        .btnSeta{
            margin-top: 2vh;
            margin-left: 2vw;
            border:none;
            position: absolute;
        }

        .btnSeta:hover{
            transform: scale(1.1);
        }

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
            background-color: #fff;
        }

        .btn-login:hover {
            background-image: linear-gradient(to right, #F8AAC1, #ff0676);
        }

        a {
            color: #fff;
            transition: all linear 160ms;
        }
        
            a:hover {
            color: #f72585;
        }
    </style>
</head>
<body>
    <?php
        echo "
            <a href='../controller/logout.php'><button class='btn-login'>Logout</button></a>
            <a href='alterarUsuario.php'><b>Usuário:</b> ". $_SESSION['usuario']->getNome()."</a>
        ";
    ?>
    <h1>Aqui é o Catalogo Los Doces</h1>
    <?php 
        if($_SESSION['usuario']->isAdmin() == 1) {
            echo"
                <br><br><br>
                <h2>Admin:</h2>
                <a href=''><button>Usuários</button></a>
                <a href=''><button>Catálogo</button></a>
            ";
        }
    ?>
</body>
</html>