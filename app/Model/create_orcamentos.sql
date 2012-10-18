create table orcamentos
(
	id INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
	identificacao VARCHAR(11) NOT NULL,
	cliente_id INT NOT NULL,
	descricao TEXT,
	valor_bruto FLOAT(8,2) NOT NULL,
	created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

alter table orcamentos add column (cond_geral TEXT, cond_comercial TEXT);