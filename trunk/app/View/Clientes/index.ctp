<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Clientes
		</div>
	</div>
</div>
<?php echo $this->Html->link('Adicionar Cliente', array('controller' => 'clientes', 'action' => 'add')); ?>
<table>
	<th>
		Cliente
	</th>
	<th>
		Ação
	</th>
	<?php foreach ($clientes as $cliente): ?>
	<tr>
		<td>
			<?php echo $cliente['Cliente']['nome']; ?>
		</td>
		<td>
			<?php echo $this->Html->link('Editar', array('controller' => 'clientes', 'action' => 'edit', $cliente['Cliente']['id'])); ?>
			<?php echo $this->Form->postLink('Deletar',
					array('action' => 'delete', $cliente['Cliente']['id']),
					array('confirm' => 'Ao deletar o cliente, todos os orçamentos deste cliente serão deletados.\nTem certeza que deseja deletar este cliente?')
				);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>