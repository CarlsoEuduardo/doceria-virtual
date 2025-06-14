<?php
require_once "authUsuario.php";

$rows = Usuario::allUsuarios();

echo "
    <table>
        <thead class='t-head'>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Tipo</th>
                <th>Conta</th>
            </tr>
        </thead>
        <tbody>
";
foreach ($rows as $row) {
    $id = $row['id_usuario'];
    $nome = $row['nome_usuario'];
    $email = $row['email_usuario'];

    switch ($row['admin']) {
        case 1:
            $admin = "<td style='background-color: crimson; border-color: crimson; color: gold;'>Admin</td>";
            break;
        default:
            $admin = "<td style='background-color: hotpink; border-color: hotpink; color: #fff;'>Cliente</td>";
            break;
    }
    if($id == $_SESSION['usuario']->getId()) {
        $ativo = "
            <td class='usuario'>
                <a>
                    Ativa
                </a>
            </td>";
    } else {
        switch ($row['ativo']) {
            case 1:
                $ativo = "
                    <td class='a-status ativo' id='desativarId$id'>
                        <a>
                            Ativa
                        </a>
                    </td>";
                break;
            default:
                $ativo = "
                    <td class='a-status inativo' id='ativarId$id'>
                        <a>
                            Inativa
                        </a>
                    </td>";
                break;
        }
    }

    echo "
        <tr>
            <td style='background-color: #F8AAC1; color: crimson'>$id</td>
            <td>$nome</td>
            <td>$email</td>
            $admin
            $ativo
        </tr>
    ";
}
