<?php
	class EmployeesController extends AppController
	{
		public function add($orcamentoId = null)
		{
			if ($this->request->is('post'))
			{			
				$this->Employee->create();				
				$this->request->data['Employee']['orcamento_id'] = $orcamentoId;
				$this->request->data['Employee']['valor_unitario'] = $this->remove_comma($this->request->data['Employee']['valor_unitario']);
				if($this->Employee->save($this->request->data))
				{
					$this->Session->setFlash('Mão de obra adicionada com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $orcamentoId));
				}
				else
					$this->Session->setFlash('Erro ao criar mão de obra');
			}
		}
		
		public function edit($id = null)
		{
			$this->Employee->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Employee->read();
			}
			else 
			{
				$orcamentoId = $this->request->data['Employee']['orcamento_id'];
				$this->request->data['Employee']['valor_unitario'] = $this->remove_comma($this->request->data['Employee']['valor_unitario']);				
				if ($this->Employee->save($this->request->data)) {
					$this->Session->setFlash('Mão de obra editada com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $orcamentoId));
				} else {
					$this->Session->setFlash('Erro ao editar mão de obra');
				}
			}
		}
		
		public function delete($id)
		{
			if($this->request->is('post'))
			{
				$this->Employee->id = $id;
				$employee = $this->Employee->read();
				if($this->Employee->delete($id))
				{
					$this->Session->setFlash('Mão de obra deletada com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $employee['Orcamento']['id']));
				}					
			}
		}
	}
?>