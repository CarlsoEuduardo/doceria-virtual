<?php
class Logica {
    /* Função para atualizar a entrada de dados */
    public static function sanitize_input($data) {
        return htmlspecialchars(trim($data));
    }

    /* Função para validar o e-mail */
    public static function validate_email($email) {
        return filter_var(trim($email), FILTER_VALIDATE_EMAIL);
    }
}
?>