<?php require "../controller/authAdmin.php"; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Los Doces</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8AAC1;
            /* background-color: hotpink; */
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

        .btn-login:hover {
            transform: scale(1.05);
        }

        .btn-login {
            background-color: #fff;
        }

        .btn-login:hover {
            background-image: linear-gradient(to right, #F8AAC1, #ff0676);
        }

        .a-usuario {
            color: #fff;
            transition: all linear 160ms;
        }
        
        .a-usuario:hover {
            color: #f72585;
        }

        table, td, th {
            background-color: #fff;
            border: solid #f72585 2px;
            border-radius: 2px;
            white-space: nowrap;
            text-align: center;
        }

        .t-head * th {
            background-color: #f72585;
            color: #fff;
            font-size: 30px;
        }

        .container {
            display: flex;
            justify-content: center;
        }

        .tabela{
            color: #f72585;
            margin-top: 5%;
            font-size: 20px;
        }
        
        .titulo {
            position: absolute;
            top: 7%;
            margin: auto;
            text-align: center;
        }

        .a-status {
            transition: all linear 160ms;
            margin: 0;
            color: #fff;
        }
        .ativo {
            background-color: darkgreen;
            border-color: darkgreen;
        }
        .inativo {
            background-color: firebrick;
            border-color: firebrick;
        }
        .usuario {
            background-color: #bbb;
            border-color: #bbb;
            color: #777;
        }
        .a-status:hover {
            transform: scale(1.1);
        }
        .ativo:hover {
            background-color: maroon;
            border-color: firebrick;
            color: gold;
        }
        .inativo:hover {
            background-color: gold;
            border-color: firebrick;
            color: maroon;
        }

        .t-head {
            margin: 0;
        }

        a {
            margin: 0;
        }
    </style>
</head>
<body>
    <?php
        echo "
            <a href='../controller/logout.php'><button class='btn-login'>Logout</button></a>
            <a href='editarUsuario.php' class='a-usuario'><b>Usuário:</b> ". $_SESSION['usuario']->getNome()."</a>
        ";
    ?>
    <br>
    <a href="catalogo.php">
        <img src="../assets/img/seta_esquerda2.png" alt="voltar" height="50px" width="50px" class="btnSeta">
    </a>
    <br><br>
    <div class="container"><h1 class="titulo">Gerenciamento de Usuários</h1></div>
    <div class="container tabela">
                <?php require_once "../controller/listarUsuarios.php"; ?>
            </tbody>
        </table>
    </div>
    <script>
        const desativadores = document.querySelectorAll('.ativo');
        const ativadores = document.querySelectorAll('.inativo');

        desativadores.forEach(elemento => {
            const html_original = elemento.innerHTML;
            const id = (elemento.id).slice(11);
            // const html_alterado = elemento.innerHTML;

            elemento.addEventListener('mouseenter', () => {
                elemento.innerHTML = `<a onClick='desativar(${id})'>Desativar</a>`;
            });
            elemento.addEventListener('mouseleave', () => {
                elemento.innerHTML = html_original;
            });
        });
        function desativar(id) {
            if(confirm(`Tem certeza que deseja desativar a conta de id = ${id}?`)) {
                window.location.replace(`../controller/adminDesativarUsuario.php?id=${id}`);
            }
        }

        ativadores.forEach(elemento => {
            const html_original = elemento.innerHTML;
            const id = (elemento.id).slice(8);
            // const html_alterado = elemento.innerHTML;

            elemento.addEventListener('mouseenter', () => {
                elemento.innerHTML = `<a onClick='ativar(${id})'>Ativar</a>`;
            });
            elemento.addEventListener('mouseleave', () => {
                elemento.innerHTML = html_original;
            });
        });
        function ativar(id) {
            if(confirm(`Tem certeza que deseja desativar a conta de id = ${id}?`)) {
                window.location.replace(`../controller/adminAtivarUsuario.php?id=${id}`);
            }
        }
    </script>
</body>
</html>