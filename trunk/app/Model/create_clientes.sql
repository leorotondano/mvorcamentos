create table clientes
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	nome varchar(100) not null,
	razao varchar(100),
	endereco varchar(200),
	telefone varchar(13),
	email varchar(100),
	falar_com varchar(100),
	cnpj_cpf varchar(20),
	insc_estadual varchar(100),
	insc_municipal varchar(100),
	created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);