<?php require "../controller/authUsuario.php" ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Los Doces</title>
</head>
<style>

    body {

        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #F8AAC1;
    }

    .btnSeta {
        margin-top: 2vh;
        margin-left: 2vw;
        border: none;
        position: absolute;
    }

    .btnSeta:hover {
        transform: scale(1.1);
    }

    .page {
        display: flex;
        flex-direction: column;
        align-items: center;
        align-content: center;
        justify-content: center;
        width: 100%;
        height: 100vh;
        background-color: #F8AAC1;
    }

    .formLogin {
        width: 40vh;
        display: flex;
        flex-direction: column;
        background-color: #fff;
        border-radius: 7px;
        padding: 40px;
        box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.4);
        gap: 5px
    }

    .areaLogin img {
        width: 420px;
    }

    .formLogin h1 {
        text-align: center;
        padding: 0;
        margin: 0;
        font-weight: 500;
        font-size: 2.3em;
    }

    .formLogin p {
        display: inline-block;
        font-size: 14px;
        color: #666;
        margin-bottom: 25px;
    }

    .formLogin input {
        padding: 15px;
        font-size: 14px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        margin-top: 5px;
        border-radius: 4px;
        transition: all linear 160ms;
        outline: none;
    }

    .formLogin input:focus {
        border: 1px solid #f72585;
    }

    .formLogin label {
        font-size: 14px;
        font-weight: 600;
    }

    a {
        color: #555;
        transition: all linear 160ms;
    }

    a:hover {
        color: #f72585;
    }

    .formLogin a {
        display: inline-block;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .btn {
        background-color: #f593b0;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        border: none !important;
        transition: all linear 160ms;
        cursor: pointer;
        margin: 0 !important;

    }

    .btn:hover {
        transform: scale(1.05);
        background-image: linear-gradient(to right, #F8AAC1, #ff0676);

    }
</style>

<body>
    <?php
        if(!isset($_SESSION['trocando_senha'])) {
            echo "<a href='../index.php'><img src='../assets/img/seta_esquerda2.png' alt='voltar' height='50px' width='50px' class='btnSeta'></a>";
        }
    ?>
    <div class="page">
        <form action="../controller/trocarSenha.php" method="POST" class="formLogin">
            <h1>Troca de Senha</h1>

            <h4><?php echo "<b>Usuário:</b> ". $_SESSION['usuario']->getNome() ?></h4>

            <?php
                if(!isset($_SESSION['trocando_senha'])) {
                    echo "
                        <label for='senha_atual'>Senha Atual</label>
                        <input name='senha_atual' id='senha_atual' type='password' placeholder='************' />
                    ";
                }
            ?>

            <label for="senha">Nova Senha</label>
            <input name="senha" id="senha" type="password" placeholder="************" />

            <label for="confirmar-senha">Repita a Nova Senha</label>
            <input name="confirmar-senha" id="confirmar-senha" type="password" placeholder="************" />

            <input type="submit" value="Atualizar" class="btn" />
        </form>
    </div>

</body>

</html>