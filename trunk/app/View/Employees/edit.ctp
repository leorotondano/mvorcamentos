<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Editar Mão de Obra
		</div>
	</div>
</div>
<?php
	echo $this->Form->create('Employee',  array('action' => 'edit'));
	echo $this->Form->input('descricao', array('label' => 'Descrição'));
	echo $this->Form->input('valor_unitario', array('label' => 'Valor Unitário', 'type' => 'text'));
	echo $this->Form->input('qtd_dias', array('label' => 'Quantidade'));
	echo $this->Form->input('orcamento_id', array('type' => 'hidden'));
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->end('Editar Mão de Obra');
?>