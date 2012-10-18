<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Adicionar Mão de Obra
		</div>
	</div>
</div>
<?php 	
	echo $this->Form->create('Employee');
	echo $this->Form->input('descricao', array('label' => 'Descrição'));
	echo $this->Form->input('valor_unitario', array('label' => 'Valor Unitário', 'type' => 'text'));
	echo $this->Form->input('qtd_dias', array('label' => 'Quantidade'));	
	echo $this->Form->end('Adicionar Mão de Obra');
?>