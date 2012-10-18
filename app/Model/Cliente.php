<?php
	class Cliente extends AppModel
	{
		public $name = 'Cliente';
		public $order = 'Cliente.nome ASC';
		public $hasMany = array(
			'Orcamento' => array('className' => 'Orcamento', 'dependent' => true)
		);
		
		public $validate = array(
			'nome' => array('rule' => 'notEmpty', 'message' => 'Preenchimento Obrigatório'),
			'cnpj_cpf' => array(
				'notEmpty' => array('rule' => 'notEmpty', 'message' => 'Preenchimento Obrigatório'),
				'isUnique' => array('rule' => 'isUnique', 'message' => 'Já existe um cliente com este cpf/cnpj')
			),
			'email' => array('rule' => 'email', 'required' => false, 'allowEmpty' => true, 'message' => 'Digite um email válido')
		);
	}
?>