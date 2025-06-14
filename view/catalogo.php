<!-- Editado_4 -->
<?php require "../controller/authUsuario.php" ?>
<!-- fim/Editado_4 -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Doces</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff8f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #F8AAC1;
            color: white;
            text-align: center;
            padding: 20px;
        }

        h1 {
            margin: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 300px;
            margin: 15px;
            overflow: hidden;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
            flex-grow: 1;
        }

        .card-content h2 {
            margin-top: 0;
            color: #a0522d;
        }

        .price {
            color: #e67e22;
            font-weight: bold;
            font-size: 1.2em;
        }

        .buy-button {
            display: inline-block;
            background-color: #F8AAC1;
            color: white;
            text-align: center;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            margin: 10px auto;
            transition: background-color 0.3s;
        }

        .buy-button:hover {
            background-color: #eb4c7c;
        }

        footer {
            background-color:#F8AAC1;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 20px;
        }
        
        /* Editado_2 */
        .btn-login {
            background-color: #fff;
            font-size: 14px;
            padding: 10px;
            padding-left: 40px;
            padding-right: 40px;
            margin-right: 20px;
            border: solid 2px #fff;
            border-radius: 5px;
            transition: all linear 160ms;
        }
        .btn-login:hover {
            background-image: linear-gradient(to right, #F8AAC1, #ff0676);
            color: #fff;
            transform: scale(1.05);
        }

        .btn-admin {
            position: relative;
            background-color: #F8AAC1;
            font-size: 14px;
            padding: 10px;
            padding-left: 40px;
            padding-right: 40px;
            margin-right: 20px;
            border: solid 2px #fff;
            border-radius: 5px;
            transition: all linear 160ms;
        }
        .btn-admin:hover {
            background-image: linear-gradient(to right, #F8AAC1, #ff0676);
            color: #fff;
            transform: scale(1.05);
        }

        a {
            color: #fff;
            transition: all linear 160ms;
        }
        
        a:hover {
            color: #f72585;
        }
        /* fim/Editado_2 */
    </style>
</head>
<body>

    <header>
        <!-- Editado_1 -->
        <?php
            echo "
                <a href='../controller/logout.php'><button class='btn-login'>Logout</button></a>
                <a href='editarUsuario.php'><b>Usuário:</b> ". $_SESSION['usuario']->getNome()."</a>
            ";
        ?>
        <!-- fim/Editado_1 -->
        <h1>🍫 Los Doces</h1>
        <p>Trufas & Pães de Mel Artesanais</p>
    </header>

    <!-- Editado_3 -->
    <?php 
        if($_SESSION['usuario']->isAdmin() == 1) {
            echo"
                <p style='font-size: 20px; font-weight: bold;'>
                    Painel do Admin:
                    <a href='gerenciarUsuarios.php'><button class='btn-admin'>Usuários</button></a>
                </p>
            ";
        }
    ?>
    <!-- fim/Editado_3 -->

    <div class="container">

        <!-- Produto 1 - Trufa de Brigadeiro -->
        <div class="card">
            <img src="../assets/img/doces/docinhosabout.png" alt="Trufa de Brigadeiro">     <!-- src Editado_1 -->
            <div class="card-content">
                <h2>Trufa de Brigadeiro</h2>
                <p>Chocolate meio amargo com recheio cremoso de brigadeiro gourmet.</p>
                <p class="price">R$ 3,00</p>
            </div>
            <a class="buy-button" target="_blank" 
            href="https://wa.me/5561992750915?text=Olá,%20gostaria%20de%20fazer%20um%20pedido%20da%20Trufa%20de%20Brigadeiro.%20Está%20disponível?">
                🛒 Comprar no WhatsApp
            </a>
        </div>

        <!-- Produto 2 - Pão de Mel Recheado -->
        <div class="card">
            <img src="../assets/img/doces/pao.png" alt="Pão de Mel Recheado">     <!-- src Editado_2 -->
            <div class="card-content">
                <h2>Pão de Mel Recheado</h2>
                <p>Pão de mel fofinho, recheado com doce de leite e cobertura de chocolate.</p>
                <p class="price">R$ 5,00</p>
            </div>
            <a class="buy-button" target="_blank" 
            href="https://wa.me/5561992750915?text=Olá,%20gostaria%20de%20fazer%20um%20pedido%20do%20Pão%20de%20Mel%20Recheado.%20Está%20disponível?">
                🛒 Comprar no WhatsApp
            </a>
        </div>

        <!-- Produto 3 - Trufa de Morango -->
        <div class="card">
            <img src="../assets/img/doces/trufa.png" alt="Trufa de Morango">     <!-- src Editado_3 -->
            <div class="card-content">
                <h2>Trufa de Morango</h2>
                <p>Chocolate branco com recheio de morango cremoso.</p>
                <p class="price">R$ 3,50</p>
            </div>
            <a class="buy-button" target="_blank" 
            href="https://wa.me/5561992750915?text=Olá,%20gostaria%20de%20fazer%20um%20pedido%20da%20Trufa%20de%20Morango.%20Está%20disponível?">
                🛒 Comprar no WhatsApp
            </a>
        </div>
         <div class="card">
            <img src="../assets/img/doces/trufa4.png" alt="Trufa de Brigadeiro">     <!-- src Editado_4 -->
            <div class="card-content">
                <h2>Trufa de Maracuja</h2>
                <p> Chocolate meio amargo com recheio de brigadeiro de maracujá cremoso.</p>
                <p class="price">R$ 3,00</p>
            </div>
            <a class="buy-button" target="_blank" 
            href="https://wa.me/5561992750915?text=Olá,%20gostaria%20de%20fazer%20um%20pedido%20da%20Trufa%20de%20Brigadeiro.%20Está%20disponível?">
                🛒 Comprar no WhatsApp
            </a>
        </div>
         <div class="card">
            <img src="../assets/img/doces/coco.jpg" alt="Trufa de Brigadeiro">     <!-- src Editado_5 -->
            <div class="card-content">
                <h2>Trufa de Coco</h2>
                <p> Chocolate meio amargo com recheio cremoso de brigadeiro de coco.</p>
                <p class="price">R$ 3,00</p>
            </div>
            <a class="buy-button" target="_blank" 
            href="https://wa.me/5561992750915?text=Olá,%20gostaria%20de%20fazer%20um%20pedido%20da%20Trufa%20de%20Brigadeiro.%20Está%20disponível?">
                🛒 Comprar no WhatsApp
            </a>
        </div>
         <div class="card">
            <img src="../assets/img/doces/leite2.jpg" alt="Trufa de Brigadeiro">     <!-- src Editado_6 -->
            <div class="card-content">
                <h2>Trufa de Leite Ninho</h2>
                <p> chocolate meio amargo com recheio cremoso de brigadeiro de leite Ninho.</p>
                <p class="price">R$ 3,00</p>
            </div>
            <a class="buy-button" target="_blank" 
            href="https://wa.me/5561992750915?text=Olá,%20gostaria%20de%20fazer%20um%20pedido%20da%20Trufa%20de%20Brigadeiro.%20Está%20disponível?">
                🛒 Comprar no WhatsApp
            </a>
        </div>
         <div class="card">
            <img src="../assets/img/doces/branco.webp" alt="Trufa de Brigadeiro">     <!-- src Editado_7 -->
            <div class="card-content">
                <h2>Trufa de Chocolate Branco;</h2>
                <p>Chocolate branco com recheio cremoso Super macia por dentro e crocante por fora.</p>
                <p class="price">R$ 3,00</p>
            </div>
            <a class="buy-button" target="_blank" 
            href="https://wa.me/5561992750915?text=Olá,%20gostaria%20de%20fazer%20um%20pedido%20da%20Trufa%20de%20Brigadeiro.%20Está%20disponível?">
                🛒 Comprar no WhatsApp
            </a>
        </div>
         <div class="card">
            <img src="../assets/img/doces/limao.jpg" alt="Trufa de Brigadeiro">     <!-- src Editado_8 -->
            <div class="card-content">
                <h2>Trufa de Limão</h2>
                <p>Azedinha, doce, cremosa... a trufa de limão é simplesmente sucesso!</p>
                <p class="price">R$ 3,00</p>
            </div>
            <a class="buy-button" target="_blank" 
            href="https://wa.me/5561992750915?text=Olá,%20gostaria%20de%20fazer%20um%20pedido%20da%20Trufa%20de%20Brigadeiro.%20Está%20disponível?">
                🛒 Comprar no WhatsApp
            </a>
        </div>
    </div>
    <footer>
        <p>📱 WhatsApp: (61) 9 9275-0915 | 📸 Instagram: @los_doces</p>
        <p>Feito com ❤️</p>
    </footer>

</body>
</html>
