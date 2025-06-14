CREATE SCHEMA IF NOT EXISTS LOS_DOCES;
USE LOS_DOCES;

CREATE TABLE IF NOT EXISTS usuario (
	id_usuario 		INT 		NOT NULL    AUTO_INCREMENT,
    nome_usuario 	CHAR(100)	NOT NULL,
    email_usuario 	CHAR(200) 	NOT NULL	UNIQUE,
    senha_usuario 	CHAR(255) 	NOT NULL,
    admin			BOOL,
    ativo           BOOL        NOT NULL    DEFAULT 0,
    PRIMARY KEY (id_usuario)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
;

CREATE TABLE IF NOT EXISTS auth_tokens (
    email_usuario 	CHAR(200) 	NOT NULL,
    token 			CHAR(64)	NOT NULL,
    tipo 			CHAR(8)		NOT NULL,
    expira 			DATETIME 	NOT NULL,
    PRIMARY KEY (email_usuario, token),
    FOREIGN KEY	(email_usuario) REFERENCES usuario (email_usuario)
)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
;


-- select * from usuario;
-- select * from auth_tokens;