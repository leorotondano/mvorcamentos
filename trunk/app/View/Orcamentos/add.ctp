<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Criar Orçamento
		</div>
	</div>
</div>
<?php
	echo $this->Form->create('Orcamento');
	echo $this->Form->input('identificacao', array('label' => 'Orçamento'));
	echo $this->Form->input('cliente_id', array('label' => 'Cliente'));
	echo $this->Form->input('descricao', array('label' => 'Descrição'));
	echo $this->Form->input('valor_bruto', array('label' => 'Valor Bruto', 'type' => 'text'));
	echo $this->Form->input('cond_geral', array('label' => 'Condições Gerais'));
	echo $this->Form->input('cond_comercial', array('label' => 'Condições Comerciais'));
	echo $this->Form->end('Criar Orçamento');
?>