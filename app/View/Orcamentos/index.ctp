<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Orçamentos
		</div>
	</div>
</div>
<?php echo $this->Html->link('Criar Orçamento', array('controller' => 'orcamentos', 'action' => 'add')); ?>
<table>
	<th>
		Orçamento
	</th>
	<th>
		Cliente
	</th>
	<th>
		Ação
	</th>
	<?php foreach ($orcamentos as $orcamento): ?>
	<tr>
		<td>
			<?php
				echo $this->Html->link($orcamento['Orcamento']['identificacao'],
					array('controller' => 'orcamentos', 'action' => 'view', $orcamento['Orcamento']['id'])
				);
			?>
		</td>
		<td>
			<?php echo $orcamento['Cliente']['nome']; ?>
		</td>
		<td>
			<?php echo $this->Html->link('Editar', array('controller' => 'orcamentos', 'action' => 'edit', $orcamento['Orcamento']['id'])) . '&nbsp;'; ?>
			<?php echo $this->Form->postLink('Deletar', 
				array('controller' => 'orcamentos', 'action' => 'delete', $orcamento['Orcamento']['id']),
				array('confirm' => 'Tem certeza que deseja deletar este orçamento?'));				
			?>
			<?php			
				echo $this->Html->link('Download', array('controller' => 'orcamentos', 'action' => 'download', $orcamento['Orcamento']['id']));
			?>
				
		</td>
	</tr>
	<?php endforeach; ?>
</table>