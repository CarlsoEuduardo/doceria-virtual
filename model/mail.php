<?php
    require "../vendor/autoload.php";
    
    use PHPMailer\PHPMailer\PHPMailer;

Class Mail {

    public static function mail($email) {

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Aprendi minha lição... vou prestar mais atenção... para não ter que apagar o passado...
        $mail->Username = Segredo::email();
        $mail->Password = Segredo::senha();
        $reference = "Los Doces";
        $name = "Los Doces";

        $mail->setFrom($reference, $name);
        $mail->addAddress($email);

        $codigo = self::gerarCodeAuth();

        $date = date_create("now",timezone_open("America/Sao_Paulo"));
        date_add($date, date_interval_create_from_date_string("5 minutes"));
        $date = date_format($date, "G:i d/m/Y");

        $subject = "Pedido de Redefinição de Senha";
        $message = "Seu código é:\n$codigo\nE é valido por 5 minutos (até $date).";

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
    }

    public static function gerarCodeAuth($tamanho = 6): String {
        require "../controller/auth.php";
        
        $codigo = str_pad(rand(0, pow(10, $tamanho) - 1), $tamanho, '0', STR_PAD_LEFT); // Gera algo como "483920"
        $expiracao = time() + 300; // Código válido por 5 minutos (300 segundos)

        // Armazena o $codigo e $expiracao na sessão
        $_SESSION['codigo_autenticacao'] = $codigo;
        $_SESSION['codigo_expiracao'] = $expiracao;

        return $codigo;
    }

    public static function checkCodeAuth($code): bool {
        require "../controller/auth.php";
        if(isset($_SESSION['codigo_expiracao']) && $_SESSION['codigo_expiracao'] < time()) {
            unset($_SESSION['codigo_autenticacao']);
            unset($_SESSION['codigo_expiracao']);
            return false;
        } else if (!isset($_SESSION['codigo_expiracao'])) {
            return false;
        } else if($code == $_SESSION['codigo_autenticacao']) {
            return true;
        } else {
            return false;
        }
    }

    function gerarTokenAuth($id_usuario) {
    $pdo = require_once "config.php";

    $token = bin2hex(random_bytes(32));
    $expira = date('Y-m-d H:i:s', strtotime('+15 minutes'));

    $stmt = $pdo->prepare("INSERT INTO auth_tokens (id_usuario, token, expira) VALUES (?, ?, ?)");
    $stmt->execute([$id_usuario, $token, $expira]);

    return $token;
}
}