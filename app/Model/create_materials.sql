create table materials
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	orcamento_id INT,
	descricao TEXT NOT NULL,
	valor_unitario FLOAT(8,2) NOT NULL,
	grandeza VARCHAR(10),
	qtd_material FLOAT(8,2) NOT NULL,
	created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);