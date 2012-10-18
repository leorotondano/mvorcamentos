create table expenses
(
	id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	orcamento_id INT,	
	descricao TEXT NOT NULL,
	per_start DATE DEFAULT NULL,
    per_end DATE DEFAULT NULL,	
	valor_unitario FLOAT(8,2) NOT NULL,
	qtd INT DEFAULT 1,
	created DATETIME DEFAULT NULL,
    modified DATETIME DEFAULT NULL
);

alter table expenses add column use_date tinyint(1) default 1;
-- alter table expenses modify column use_date tinyint(1) default 1;