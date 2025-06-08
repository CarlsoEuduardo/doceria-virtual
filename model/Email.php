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

        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Aprendi minha lição... vou prestar mais atenção... para não ter mais que apagar o passado...
        $mail->Username = Segredo::email();
        $mail->Password = Segredo::senha();
        // MEEEU AMIGO!! ...Eu ainda deixei uns rastros gigantescos...
        $reference = "Los Doces";
        $name = "Los Doces";

        $mail->setFrom($reference, $name);
        $mail->addAddress($email);

        return $mail;
    }

    public static function enviar($email, $tipo)
    {
        $mail = self::mailDefault($email);
        $token = self::gerarTokenAuth($email);

        $fuso = new DateTimeZone('America/Sao_Paulo');
        $expira = new DateTime('now', $fuso);
        $expira->modify('+15 minutes');
        $expiraHora = $expira->format('H:i');

        switch($tipo) {
            case 'cadastro':
                $subject = "Confirmação de Cadastro";
                $spamMsg = "seu cadastro";
                $caminho = "validarEmail.php";
                break;
            case 'esqueciSenha':
                $subject = "Confirmação de Troca de Senha";
                $spamMsg = "a troca da senha de sua conta";
                $caminho = "validarEsqueciSenha.php";
                break;
        }

        $message = "
            Clique no link para confirmar $spamMsg na Doceria Los Doces. 
            Expira em 15 minutos (às $expiraHora). 
            ATENÇÃO: Se não reconhecer essa atividade NÃO CLIQUE no link abaixo.\n
            http://localhost/php/Los_Doces/controller/$caminho?token=". urlencode($token);

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    }

    private static function gerarTokenAuth($email): string
    {
        $pdo = require_once "config.php";

        // checando se por algum milagre ou azar o token já exite
        do {
            $token = bin2hex(random_bytes(32));
            
            $stmt = $pdo->prepare("
                SELECT token
                FROM auth_tokens
                WHERE token = :token
            ");
            $stmt->execute([":token" => $token]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } while(count($rows) > 0);

        $fuso = new DateTimeZone('America/Sao_Paulo');
        $expira = new DateTime('now', $fuso);
        $expira->modify('+15 minutes');

        $stmt = $pdo->prepare("
            INSERT INTO auth_tokens (email_usuario, token, expira)
            VALUES (:id_usuario, :token, :expira)
        ");

        $stmt->execute([
            ":email_usuario" => $email,
            ":token" => $token,
            ":expira" => $expira->format('Y-m-d H:i:s')
        ]);

        return $token;
    }

    public static function tokenAuth($token) {
        $pdo = require "../model/config.php";

        $fuso = new DateTimeZone('America/Sao_Paulo');
        $agora = new DateTime('now', $fuso);

        $del = $pdo->prepare("DELETE FROM auth_tokens WHERE expira > :agora");
        $del->execute([":agora" => $agora->format('Y-m-d H:i:s')]);

        $stmt = $pdo->prepare("
            SELECT
                email_usuario,
                expira
            FROM auth_tokens
            WHERE token = :token
        ");

        $stmt->execute([":token" => $token]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $expira = new DateTime($row['expira'], $fuso);
        
        if ($row) {
            session_start();
            $usuario = new Usuario(null, $row['email_usuario']);
            $usuario->ativar();
            $usuario->update();

            $del = $pdo->prepare("DELETE FROM auth_tokens WHERE token = :token");
            $del->execute([":token" => $token]);

            return "valido";
        } else {
            return "invalido";
        }
    }
}