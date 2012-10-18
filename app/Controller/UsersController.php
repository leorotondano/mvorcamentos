<?php
	//App::uses('AuthComponent', 'Controller/Component');
	class UsersController extends AppController
	{
		public function login()
		{
			if ($this->request->is('post'))
			{
				if ($this->Auth->login())
				{
					$this->redirect($this->Auth->redirect());
				}
				else
				{
					$this->Session->setFlash(__('Usuário ou senha incorretos. Tente novamente.'));
				}
			}
			$log = $this->Auth->user('id');
			if($log != null)
				$this->Auth->logout();
		}		
		
		public function logout()
		{
			$this->redirect($this->Auth->logout());
		}
	}
?>