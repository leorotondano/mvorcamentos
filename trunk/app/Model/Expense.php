<?php
	class Expense extends AppModel
	{
		public $belongsTo = 'Orcamento';
		public $order = 'Expense.descricao ASC';
		
		public $validate = array(
			'descricao' => array('rule' => 'notEmpty', 'message' => 'Preenchimento Obrigatório'),
			'qtd' => array('rule' => '/^[0-9]+$/', 'message' => 'Preencha apenas com valores numéricos'),
			'valor_unitario' => array('rule' => '/^([0-9]+)$|^([0-9]+\.[0-9][0-9]?)$/', 'message' => 'Preencha o campo com um valor válido'),
			'per_start' => array('rule' => 'dates_validator', 'message' => 'A data inicial deve ser menor ou igual à data final'),
			'per_end' => array('rule' => 'dates_validator', 'message' => 'A data inicial deve ser menor ou igual à data final')
		);
		
		public function dates_validator()
		{
			$start = explode("-", $this->data['Expense']['per_start']);
			$start = mktime(0, 0, 0, $start[1], $start[2], $start[0]);
			$end = explode("-", $this->data['Expense']['per_end']);
			$end = mktime(0, 0, 0, $end[1], $end[2], $end[0]);
			//return $start <= $end;
			return $this->data['Expense']['per_start'] <= $this->data['Expense']['per_end'];
		}
	}
?>