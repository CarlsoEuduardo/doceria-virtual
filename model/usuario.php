<?php
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $admin;

    /* Construtor */
    function __construct($nome, $email, $senha = null, $admin = null, $id = null) {
        $this->id = $id;
        if(!isset($this->id)) {
            unset($this->id);
        }
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        if(!isset($this->senha)) {
            unset($this->senha);
        }
        $this->admin = $admin;
        if(!isset($this->admin)) {
            unset($this->admin);
        }
    }

    /* Métodos do Objeto */     // cadastros e remoção
    public function cadastrar() : void {
        $pdo = require "config.php";
        $sql = "
            INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario)
            VALUES (:nome, :email, :senha)
        ";
        $stmt = $pdo->prepare($sql);
        try {
        $stmt->execute([
            ':nome' => $this->nome,
            ':email' => $this->email,
            ':senha' => (password_hash($this->senha, PASSWORD_DEFAULT))
        ]);
        } catch(Exception $e) {
            echo $e;
        }
    }

        /* Set */
    public function setNome($nome) {$this->nome = $nome;}
    public function setEmail($email) {$this->email = $email;}
    public function setSenha($senha) {$this->senha = $senha;}
    
        /* Get */
    public function getId() {return $this->id;}
    public function getNome() {return $this->nome;}
    
    public function isAdmin() {
        if($this->admin == 1) {
            return true;
        }
        return false;
    }

    /* Métodos da Classe */     // mais validações e login (login é uma validação também eu acho, meio redundante)
    public static function procurarEmail($email) : bool {
        $pdo = require "config.php";
        $sql = "SELECT email_usuario FROM usuario WHERE email_usuario = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        if($stmt->rowCount() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public static function validarSenha($email, $senha) : bool {
        $pdo = require "config.php";
        if(self::procurarEmail($email)) {
            $sql = "SELECT email_usuario, senha_usuario FROM usuario WHERE email_usuario = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':email' => $email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(password_verify($senha, $row['senha_usuario'])) {
                return true;
            }
        }
        return false;
    }
    public static function login($email) : void {
        $pdo = require "config.php";
        $sql = "
            SELECT id_usuario, nome_usuario, email_usuario, admin
            FROM usuario
            WHERE email_usuario = :email
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['usuario'] = new Usuario(
            $row['nome_usuario'],
            $row['email_usuario'],
            null,
            $row['admin'],
            $row['id_usuario']
        );
    }
}
?>