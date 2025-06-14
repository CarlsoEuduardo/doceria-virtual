/*
    Inserção de Usuários falsos sem email verificado para teste
    senha_usuario = "teste123"
*/

USE LOS_DOCES;
INSERT INTO usuario (nome_usuario, email_usuario, senha_usuario, admin, ativo)
VALUES
    ('Usuario Ativo', "UsuarioAtivo@gmail.com", '$2y$10$cEwwhrBEvZizEN445tMkyuoqA0iq4dsXtXyFqp/oeSdTDPADhtGB.',null , 1),
    ('Usuario Inativo', "UsuarioInativo@gmail.com", '$2y$10$cEwwhrBEvZizEN445tMkyuoqA0iq4dsXtXyFqp/oeSdTDPADhtGB.',null , 0),
    ('Admin2', "admin2@gmail.com", '$2y$10$cEwwhrBEvZizEN445tMkyuoqA0iq4dsXtXyFqp/oeSdTDPADhtGB.',1 , 1),
    ('Teste1', "teste1@gmail.com", '$2y$10$cEwwhrBEvZizEN445tMkyuoqA0iq4dsXtXyFqp/oeSdTDPADhtGB.',null , 1),
    ('Teste2', "teste2@hotmail.com", '$2y$10$cEwwhrBEvZizEN445tMkyuoqA0iq4dsXtXyFqp/oeSdTDPADhtGB.',null , 1);