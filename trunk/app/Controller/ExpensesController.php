<?php
	class ExpensesController extends AppController
	{
		public $helpers = array('Html', 'Form');
		public function add($orcamentoId = null)
		{
			if ($this->request->is('post'))
			{			
				$this->Expense->create();
				$this->request->data['Expense']['valor_unitario'] = $this->remove_comma($this->request->data['Expense']['valor_unitario']);				
				$this->request->data['Expense']['orcamento_id'] = $orcamentoId;
				if($this->Expense->save($this->request->data))
				{
					$this->Session->setFlash('Gasto adicionada com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $orcamentoId));
				}
				else
					$this->Session->setFlash('Erro ao criar gasto');				
			}
		}
		
		public function edit($id = null)
		{
			$this->Expense->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Expense->read();
			}
			else 
			{
				$orcamentoId = $this->request->data['Expense']['orcamento_id'];
				$this->request->data['Expense']['valor_unitario'] = $this->remove_comma($this->request->data['Expense']['valor_unitario']);
				if ($this->Expense->save($this->request->data))
				{
					$this->Session->setFlash('Gasto editado com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $orcamentoId));
				}
				else
				{
					$this->Session->setFlash('Erro ao editar gasto');
				}
				//print_r($this->request->data['Expense']['per_start']);
			}
		}
		
		public function delete($id)
		{
			if($this->request->is('post'))
			{
				$this->Expense->id = $id;
				$expense = $this->Expense->read();
				if($this->Expense->delete($id))
				{
					$this->Session->setFlash('Gasto deletado com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $expense['Orcamento']['id']));
				}					
			}
		}
	}
?>