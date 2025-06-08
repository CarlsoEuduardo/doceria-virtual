<?php
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $admin;
    private $ativo;

    /* Construtor */
    public function __construct($nome = null, $email = null, $senha = null, $admin = null, $id = null, $ativo = 1) {
        if($nome != null)
        {
            $this->id = $id;
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->admin = $admin;
            $this->ativo = $ativo;

            if(!isset($this->id)) {unset($this->id);}
            if(!isset($this->senha)) {unset($this->senha);}
            if(!isset($this->admin)) {unset($this->admin);}
        }
        else
        {
            $row = self::procurarUsuario($email);
            
            $this->id = $row['id_usuario'];
            $this->nome = $row['nome_usuario'];
            $this->email = $row['email_usuario'];
            $this->admin = $row['admin'];
            $this->ativo = $row['ativo'];

            if(!isset($this->admin)) {unset($this->admin);}
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
            Email::enviar($this->email, 'cadastro');
        } catch(Exception $e) {
            echo $e;
        }
    }
    public function update() {
        try {
            $pdo = require "config.php";
            $sql = "
                UPDATE usuario
                SET
                    ativo = :valor
                WHERE id_usuario = :id
            ";
            $stmt->execute([
                ':valor' => $valor,
                ':id' => $this->id
            ]);
        } catch(Exception $e) {
            echo $e;
        }
    }
    private function atividade($valor) : void {
        $pdo = require "config.php";
        $sql = "
            UPDATE usuario
            SET ativo = :valor
            WHERE id_usuario = :id
        ";
        $stmt = $pdo->prepare($sql);
        try {
            $stmt->execute([
                ':valor' => $valor,
                ':id' => $this->id
            ]);
        } catch(Exception $e) {
            echo $e;
        }
    }


    public function ativar() : void {
        $this->atividade(1);
    }
    public function desativar() : void {
        $this->atividade(0);
    }
        /* Set */
    public function setNome($nome) {$this->nome = $nome;}
    public function setEmail($email) {$this->email = $email;}
    public function setSenha($senha) {$this->senha = $senha;}
    
        /* Get */
    public function getId() {return $this->id;}
    public function getNome() {return $this->nome;}
    public function getAtivo() {return $this->ativo;}

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
    public static function procurarUsuario($email) {
        $pdo = require "config.php";
        $sql = "SELECT * FROM usuario WHERE email_usuario = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
    public static function login($email) : bool {
        $pdo = require "config.php";
        $sql = "
            SELECT id_usuario, nome_usuario, email_usuario, admin, ativo
            FROM usuario
            WHERE email_usuario = :email
        ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['ativo'] == 1) {
            session_start();
            $_SESSION['usuario'] = new Usuario(
                $row['nome_usuario'],
                $row['email_usuario'],
                null,
                $row['admin'],
                $row['id_usuario'],
                $row['ativo']
            );
            return true;
        } else {
            return false;
        }
    }
}
?>