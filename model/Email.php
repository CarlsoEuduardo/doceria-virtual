<?php
require "../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    private static function mailDefault($email)
    {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->CharSet = 'UTF-8';

        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Aprendi minha lição... vou prestar mais atenção... para não ter mais que apagar o passado...
        require "segredo.php";
        $mail->Username = Segredo::email();
        $mail->Password = Segredo::senha();

        $reference = Segredo::email();
        $name = "Los Doces";
        // MEEEU AMIGO!! ...Eu ainda deixei uns rastros gigantescos...

        $mail->setFrom($reference, $name);
        $mail->addAddress($email);

        return $mail;
    }

    public static function enviar($email, $tipo)
    {
        $mail = self::mailDefault($email);
        $token = self::gerarTokenAuth($email, $tipo);

        $fuso = new DateTimeZone('America/Sao_Paulo');
        $expira = new DateTime('now', $fuso);
        $expira->modify('+15 minutes');
        $expiraHora = $expira->format('H:i');

        switch($tipo) {
            case 'cadastro':
                $subject = "Confirmação de Cadastro";
                $spamMsg = "seu cadastro";
                $caminho = "validarCadastro.php";
                break;
            case 'senha':
                $subject = "Confirmação de Troca de Senha";
                $spamMsg = "a troca da senha de sua conta";
                $caminho = "validarTrocarSenha.php";
                break;
        }

        $message = "
            Clique no link para confirmar $spamMsg na Doceria Los Doces.
            Expira em 15 minutos (às $expiraHora).\n
            ATENÇÃO: Se não reconhecer essa atividade NÃO CLIQUE no link abaixo:
            http://localhost/php/Los_Doces/controller/$caminho?token=". urlencode($token);

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    }

    private static function gerarTokenAuth($email, $tipo): string
    {
        $pdo = require "config.php";
        $fuso = new DateTimeZone('America/Sao_Paulo');

        // checando se por algum milagre ou azar o token já exite
        do {
            $token = bin2hex(random_bytes(32));
            $sql = "
                SELECT token
                FROM auth_tokens
                WHERE token = :token
            ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([":token" => $token]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } while(count($rows) > 0);

        $expira = new DateTime('now', $fuso);
        $expira->modify('+15 minutes');

        $stmt = $pdo->prepare("DELETE FROM auth_tokens WHERE email_usuario = :email");
        $stmt->execute([":email" => $email]);

        $stmt = $pdo->prepare("
            INSERT INTO auth_tokens (email_usuario, token, tipo, expira)
            VALUES (:email_usuario, :token, :tipo, :expira)
        ");

        $stmt->execute([
            ":email_usuario" => $email,
            ":token" => $token,
            ":tipo" => $tipo,
            ":expira" => $expira->format('Y-m-d H:i:s')
        ]);

        return $token;
    }

    public static function tokenAuth($token, $tipo) {
        $pdo = require "config.php";

        $fuso = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $fuso);

        $sql = "DELETE FROM auth_tokens WHERE expira < :agora";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":agora" => $agora->format('Y-m-d H:i:s')]);

        $stmt = $pdo->prepare("
            SELECT
                email_usuario,
                tipo,
                expira
            FROM auth_tokens
            WHERE token = :token
        ");

        $stmt->execute([":token" => $token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && $row['tipo'] == $tipo) {
            require "usuario.php";
            
            switch($tipo) {
                case "cadastro":
                    $usuario = new Usuario(null, null, $row['email_usuario']);
                    $usuario->ativar();

                    $stmt = $pdo->prepare("DELETE FROM auth_tokens WHERE token = :token");
                    $stmt->execute([":token" => $token]);
                    return true;
                case "senha":
                    session_start();
                    Usuario::login($row['email_usuario']);
                    return true;
                default:
                    return false;
            }
        } else {
            return false;
        }
    }

    public static function tokenLogin($token) {
        $pdo = require "config.php";
        $stmt = $pdo->prepare("
            SELECT email_usuario
            FROM auth_tokens
            WHERE token = :token
        ");
        $stmt->execute([":token" => $token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row) {
            Usuario::login($row['email_usuario']);
            return true;
        } else {
            return false;
        }
    }
}