<?php
	class Employee extends AppModel
	{
		public $belongsTo = 'Orcamento';
		public $order = 'Employee.descricao ASC';
		public $validate = array(
			'descricao' => array('rule' => 'notEmpty', 'message' => 'Preenchimento Obrigatório'),
			'qtd_dias' => array('rule' => '/^[0-9]+$/', 'message' => 'Preencha apenas com valores numéricos'),
			'valor_unitario' => array('rule' => '/^([0-9]+)$|^([0-9]+\.[0-9][0-9]?)$/', 'message' => 'Preencha o campo com um valor válido')
		);
	}
?>