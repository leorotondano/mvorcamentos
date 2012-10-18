<?php
	class MaterialsController extends AppController
	{
		public function add($orcamentoId = null)
		{
			if ($this->request->is('post'))
			{			
				$this->Material->create();				
				$this->request->data['Material']['orcamento_id'] = $orcamentoId;
				$this->request->data['Material']['valor_unitario'] = $this->remove_comma($this->request->data['Material']['valor_unitario']);
				$this->request->data['Material']['qtd_material'] = $this->remove_comma($this->request->data['Material']['qtd_material']);
				if($this->Material->save($this->request->data))
				{
					$this->Session->setFlash('Material adicionado com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $orcamentoId));
				}
				else
					$this->Session->setFlash('Erro ao criar material');
			}
		}
		
		public function edit($id = null)
		{
			$this->Material->id = $id;
			if ($this->request->is('get')) {
				$this->request->data = $this->Material->read();
			}
			else 
			{
				$orcamentoId = $this->request->data['Material']['orcamento_id'];
				$this->request->data['Material']['valor_unitario'] = $this->remove_comma($this->request->data['Material']['valor_unitario']);
				$this->request->data['Material']['qtd_material'] = $this->remove_comma($this->request->data['Material']['qtd_material']);				
				if ($this->Material->save($this->request->data)) {
					$this->Session->setFlash('Material editado com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $orcamentoId));
				} else {
					$this->Session->setFlash('Erro ao editar material');
				}
			}
		}
		
		public function delete($id)
		{
			if($this->request->is('post'))
			{
				$this->Material->id = $id;
				$material = $this->Material->read();
				if($this->Material->delete($id))
				{
					$this->Session->setFlash('Material deletado com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'view', $material['Orcamento']['id']));
				}					
			}
		}
	}
?>