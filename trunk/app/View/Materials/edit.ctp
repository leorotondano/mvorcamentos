<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Editar Material
		</div>
	</div>
</div>
<?php
	echo $this->Form->create('Material',  array('action' => 'edit'));
	echo $this->Form->input('descricao', array('label' => 'Descrição'));
	echo $this->Form->input('valor_unitario', array('label' => 'Valor Unitário', 'type' => 'text'));
	echo $this->Form->input('qtd_material', array('label' => 'Quantidade', 'type' => 'text'));
	echo $this->Form->input('grandeza', array('label' => 'Grandeza'));
	echo $this->Form->input('orcamento_id', array('type' => 'hidden'));
	echo $this->Form->input('id', array('type' => 'hidden'));
	echo $this->Form->end('Editar Material');
?>