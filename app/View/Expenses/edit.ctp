<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Editar Gasto
		</div>
	</div>
</div>
<?php 	
	$display_none = ($this->request->data['Expense']['use_date']) ? '' : "style = 'display: none;'";
	echo $this->Form->create('Expense');
	echo $this->Form->input('descricao', array('label' => 'Descrição'));
	echo $this->Form->input('use_date', array('label' => 'Usar Data', 'class' => 'use_date_check'));
	echo "<div class=\"use_date_box\" $display_none>";
	echo $this->Form->input('per_start', array('label' => 'Data Inicial', 'dateFormat' => 'DMY'));
	echo $this->Form->input('per_end', array('label' => 'Data Final', 'dateFormat' => 'DMY'));
	echo '</div>';
	echo $this->Form->input('valor_unitario', array('label' => 'Valor Unitário', 'type' => 'text'));
	echo $this->Form->input('qtd', array('label' => 'Quantidade'));	
	echo $this->Form->input('orcamento_id', array('type' => 'hidden'));
	echo $this->Form->input('id', array('type' => 'hidden'));	
	echo $this->Form->end('Editar Gasto');
	echo $this->Html->script('jquery.js');
	echo $this->Html->script('use_date.js');	
?>