<?php
	class OrcamentosController extends AppController
	{
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');

		public function index()
		{
			$orcamentos = $this->Orcamento->find('all');
			$this->set('orcamentos', $orcamentos);
		}

		public function add()
		{
			$clientes = $this->Orcamento->Cliente->find('list', array('fields' => array('Cliente.id', 'Cliente.nome')));
			if ($this->request->is('post'))
			{			
				$this->Orcamento->create();
				$this->request->data['Orcamento']['valor_bruto'] = $this->remove_comma($this->request->data['Orcamento']['valor_bruto']);
				if($this->Orcamento->save($this->request->data))
				{
					$this->Session->setFlash('Orçamento criado com sucesso');
					$this->redirect(array('action' => 'index'));
				}
				else
				{
					$this->Session->setFlash('Erro ao criar orçamento');
					$this->set('clientes', $clientes);
				}
			}
			else
			{
				$this->set('clientes', $clientes);
				if($clientes = null || count($clientes) == 0)
				{
					$this->Session ->setFlash('Você deve criar um cliente antes de criar um orçamento.');
					$this->redirect(array('controller' => 'clientes', 'action' => 'index'));
				}
			}
		}
		
		public function view($id = null)
		{
			$this->Orcamento->id = $id;
			$this->set('orcamento', $this->Orcamento->read());
			$this->set('total', $this->Orcamento->total_orcamento($id));
		}
		
		public function delete($id)
		{
			if($this->request->is('post'))
			{				
				$this->Orcamento->delete($id);
				$this->Session->setFlash('Orçamento deletado com sucesso');
				$this->redirect(array('controller' => 'orcamentos', 'action' => 'index'));
			}
		}
		
		public function edit($id = null)
		{
			if($this->request->is('get'))
			{
				$this->Orcamento->id = $id;
				$this->request->data = $this->Orcamento->read();
				$clientes = $this->Orcamento->Cliente->find('list', array('fields' => array('Cliente.id', 'Cliente.nome')));
				$this->set('clientes', $clientes);
			}
			else
			{
				$this->request->data['Orcamento']['valor_bruto'] = $this->remove_comma($this->request->data['Orcamento']['valor_bruto']);
				if($this->Orcamento->save($this->request->data))
				{
					$this->Session->setFlash('Orçamento editado com sucesso');
					$this->redirect(array('controller' => 'orcamentos', 'action' => 'index'));
				}
				else				
				{
					$clientes = $this->Orcamento->Cliente->find('list', array('fields' => array('Cliente.id', 'Cliente.nome')));				
					$this->set('clientes', $clientes);
					$this->Session->setFlash('Erro ao editar orçamento');
				}
			}
		}
		
		public function download($id = null)
		{ 
			if (!$id) 
			{ 
				$this->Session->setFlash('Sorry, there was no property ID submitted.'); 
				$this->redirect(array('action'=>'index')); 
			}
			
			$this->Orcamento->id = $id;
			$orcamento = $this->Orcamento->read();
			$this->set('orcamento', $orcamento);
			$this->set('total_orcamento', $this->Orcamento->total_orcamento($id));
			$this->set('total_material', $this->Orcamento->total_material($id));
			$this->set('total_employee', $this->Orcamento->total_employee($id));
			$this->set('total_expense', $this->Orcamento->total_expense($id));			
			
			$this->layout = 'pdf'; //this will use the pdf.ctp layout 
			
			/* for test */			
			//$this->view = 'teste';
			
			$this->render(); 			
		}
	}
?>