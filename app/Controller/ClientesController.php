<?php
	class ClientesController extends AppController
	{
		public $helpers = array('Html', 'Form', 'Session');
		public $components = array('Session');
		
		public function index()
		{
			$clientes = $this->Cliente->find('all');
			$this->set('clientes', $clientes);
		}
		
		public function add()
		{
			if ($this->request->is('post'))
			{			
				$this->Cliente->create();				
				if($this->Cliente->save($this->request->data))
				{
					$this->Session->setFlash('Cliente criado com sucesso');
					$this->redirect(array('action' => 'index'));
				}
				else
					$this->Session->setFlash('Erro ao criar cliente!');			
			}
		}
		
		public function delete($id)
		{
			if($this->request->is('post'))
			{				
				$this->Cliente->delete($id);
				$this->Session->setFlash('Cliente deletado com sucesso');
				$this->redirect(array('controller' => 'clientes', 'action' => 'index'));
			}
		}
		
		public function edit($id = null)
		{
			if($this->request->is('get'))
			{
				$this->Cliente->id = $id;
				$this->request->data = $this->Cliente->read();
			}
			else
			{
				if($this->Cliente->save($this->request->data))
				{
					$this->Session->setFlash('Cliente editado com sucesso');
					$this->redirect(array('controller' => 'clientes', 'action' => 'index'));
				}
				else				
					$this->Session->setFlash('Erro ao editar cliente');				
			}
		}
	}
?>