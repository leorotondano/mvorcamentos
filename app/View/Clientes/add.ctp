<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Adicionar Cliente
		</div>
	</div>
</div>
<?php
	echo $this->Form->create('Cliente');
	echo $this->Form->input('nome');
	echo $this->Form->input('razao', array('label' => 'Razão Social'));
	echo $this->Form->input('cnpj_cpf', array('label' => 'CNPJ/CPF'));
	echo $this->Form->input('endereco', array('label' => 'Endereço'));
	echo $this->Form->input('telefone', array('label' => 'Telefone'));
	echo $this->Form->input('falar_com', array('label' => 'Falar com'));
	echo $this->Form->input('email', array('label' => 'Email'));
	echo $this->Form->input('insc_estadual', array('label' => 'Inscrição Estadual'));
	echo $this->Form->input('insc_municipal', array('label' => 'Inscrição Municipal'));
	echo $this->Form->end('Criar Cliente');
?>