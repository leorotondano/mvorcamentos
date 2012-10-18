<?php
	class Material extends AppModel
	{
		public $belongsTo = "Orcamento";
		public $order = 'Material.descricao ASC';
		public $validate = array(
			'descricao' => array('rule' => 'notEmpty', 'message' => 'Preenchimento Obrigatório'),
			'qtd_material' => array('rule' => '/^([0-9]+)$|^([0-9]+\.[0-9][0-9]?)$/', 'message' => 'Preencha o campo com um valor válido'),
			'valor_unitario' => array('rule' => '/^([0-9]+)$|^([0-9]+\.[0-9][0-9]?)$/', 'message' => 'Preencha o campo com um valor válido')
		);				
	}
?>