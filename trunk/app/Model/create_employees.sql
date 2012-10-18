create table employees
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	orcamento_id INT,
	descricao TEXT NOT NULL,
	valor_unitario FLOAT(8,2) NOT NULL,
	qtd_dias INT DEFAULT 1,
	created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL	
);
