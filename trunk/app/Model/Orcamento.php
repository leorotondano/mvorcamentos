<?php
	class Orcamento extends AppModel
	{
		public $name = 'Orcamento';
		public $belongsTo = 'Cliente';
		public $hasMany = array(
			'Material' => array('className' => 'Material', 'order' => 'Material.descricao ASC', 'dependent' => true), 
			'Employee' => array('className' => 'Employee', 'order' => 'Employee.descricao ASC', 'dependent' => true), 
			'Expense' => array('className' => 'Expense', 'order' => 'Expense.descricao ASC', 'dependent' => true)
		);
		public $order = 'Orcamento.id DESC';
		public $validate = array(
			'valor_bruto' => 
				array(
					'rule' => '/^([0-9]+)$|^([0-9]+\.[0-9][0-9]?)$/',
					'message' => 'Preencha o campo com um valor válido',
					'required' => true,
					'allowEmpty' => false
				),
			'identificacao' => array(
				'isUnique' => array('rule' => 'isUnique', 'message' => 'Já existe um orçamento com essa identificação'),
				'notNull' => array('rule' => 'notEmpty', 'message' => 'Preenchimento Obrigatório', 'required' => true, 'allowEmpty' => false)
			)
		);
		
		public function total_orcamento($id)
		{
			return $this->total_material($id) + $this->total_employee($id) + $this->total_expense($id);
		}
		
		public function total_material($id)
		{
			$this->id = $id;
			$this->read();
			$total = 0;		
			foreach ($this->data['Material'] as $material)
				$total = $total + ($material['valor_unitario'] * $material['qtd_material']);		
			return $total;
		}
		
		public function total_employee($id)
		{
			$this->id = $id;
			$this->read();
			$total = 0;
			foreach ($this->data['Employee'] as $employee)
				$total = $total + ($employee['valor_unitario'] * $employee['qtd_dias']);			
			return $total;			
		}
		
		public function total_expense($id)
		{
			$this->id = $id;
			$this->read();
			$total = 0;
			foreach ($this->data['Expense'] as $expense)
				$total = $total + ($expense['valor_unitario'] * $expense['qtd']);			
			return $total;			
		}
		
	}	
?>