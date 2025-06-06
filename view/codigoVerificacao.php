<!DOCTYPE html>
<?php 
    require_once "../controller/auth.php";
    if(!isset($_SESSION['codigo_expiracao'])) {
        echo "<script> window.history.back(); </script>";
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Los Doces</title>
</head>
<style>

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');

body{
    font-family: 'Inter', sans-serif;
    background-color: #F8AAC1;
    }
.btnSeta{
    margin-top: 2vh;
    margin-left: 2vw;
    border:none;
}

h1{
    color: white;
    text-align: center;
    margin-top: 3vh;
}
section{
    width: 40vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
    justify-content: center;
    width: 100%;
    height: 100vh;
}
.div input {
    padding: 15px;
    font-size: 14px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    margin-top: 5px;
    border-radius: 4px;
    transition: all linear 160ms;
    outline: none;
}
.div {
    margin-bottom:42vh;
    width: 70vh;
    display: flex;
    flex-direction: column;
    background-color: #fff;
    border-radius: 7px;
    padding: 40px;
    box-shadow: 10px 10px 40px rgba(0, 0, 0, 0.4);
    gap: 5px
}

.div input:focus {
    border: 1px solid #f72585;
}
.div label {
    font-size: 14px;
    font-weight: 600;
}

.div a {
    display: inline-block;
    margin-bottom: 20px;
    font-size: 13px;
    color: #555;
    transition: all linear 160ms;
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
    <a href="login.html"><img src="../assets/img/seta_esquerda2.png" alt="voltar" height="50px" width="50px" class="btnSeta"></a>    
    <h1>Autenticação</h1>
     <section>
       <div class="div">
            <form action="" method="POST">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" placeholder="Digite o código enviado para o seu email" autofocus="true" />
                    
                <input type="submit" value="Enviar" class="btn"/>
            </form>
        </div> 
    </section>

  </body>
</html>