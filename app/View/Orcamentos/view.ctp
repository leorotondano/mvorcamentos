<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Orçamento: <?php echo $orcamento['Orcamento']['identificacao']; ?>
		</div>
	</div>
</div>
<span class="bold">Valor Bruto:</span> R$<?php echo str_replace('.', ',', $orcamento['Orcamento']['valor_bruto']); ?>;<br />
<span class="bold">Descrição:</span><br /><?php echo str_replace("\n", "<br />", trim($orcamento['Orcamento']['descricao'])); ?><br />
<span class="bold">Condições Gerais:</span><br /><?php echo str_replace("\n", "<br />", trim($orcamento['Orcamento']['cond_geral'])); ?><br />
<span class="bold">Condições Comerciais:</span><br /><?php echo str_replace("\n", "<br />", trim($orcamento['Orcamento']['cond_comercial'])); ?><br />

<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Cliente: <?php echo $orcamento['Cliente']['nome']; ?>
		</div>
	</div>
</div>
<span class="bold">Razão Social:</span> <?php echo $orcamento['Cliente']['razao']; ?>;<br />
<span class="bold">CNPJ/CPF</span>: <?php echo $orcamento['Cliente']['cnpj_cpf']; ?>;<br />
<span class="bold">Endereço:</span> <?php echo $orcamento['Cliente']['endereco']; ?>;<br />
<span class="bold">Telefone:</span> <?php echo $orcamento['Cliente']['telefone']; ?>;<br />
<span class="bold">Falar com:</span> <?php echo $orcamento['Cliente']['falar_com']; ?>;<br />
<span class="bold">Email:</span> <?php echo $orcamento['Cliente']['email']; ?>;<br />
<span class="bold">Inscrição Estadual:</span> <?php echo $orcamento['Cliente']['insc_estadual']; ?>;<br />
<span class="bold">Inscrição Municipal:</span> <?php echo $orcamento['Cliente']['insc_municipal']; ?>;


<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Materiais
		</div>
	</div>
</div>

<?php echo $this->Html->link('Adicionar Material', array('controller' => 'materials', 'action' => 'add', $orcamento['Orcamento']['id'])); ?><br />
<table>	
	<th>Descrição</th>
	<th>Valor Unitário</th>
	<th>Qtd.</th>
	<th>Grandeza</th>
	<th>Valor Total</th>
	<th>Ação</th>
	<?php foreach ($orcamento['Material'] as $material): ?>	
		<tr>
			<td><?php echo $material['descricao'];?></td>
			<td><?php echo str_replace('.', ',', $material['valor_unitario']);?></td>
			<td><?php echo str_replace('.', ',', $material['qtd_material']);?></td>
			<td><?php echo $material['grandeza'];?></td>
			<?php $valor_total = sprintf("%.2f", $material['valor_unitario'] * $material['qtd_material']); ?>
			<td><?php echo str_replace('.', ',', $valor_total);?></td>
			<td>
				<?php
					echo $this->Html->link('Editar', array('controller' => 'materials', 'action' => 'edit', $material['id']));
					echo '<br />';
					echo $this->Form->postLink('Deletar', 
						array('controller' => 'materials', 'action' => 'delete', $material['id']),
						array('confirm' => 'Tem certeza que deseja deletar este material?'));
				?>
			</td>			
		</tr>
	<?php endforeach; ?>
</table>

<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Mão de Obra
		</div>
	</div>
</div>
<?php echo $this->Html->link('Adicionar Mão de Obra', array('controller' => 'employees', 'action' => 'add', $orcamento['Orcamento']['id'])); ?><br />
<table>		
	<th>Descrição</th>
	<th>Valor Unitário</th>
	<th>Qtd.</th>
	<th>Valor Total</th>
	<th>Ação</th>
	<?php foreach ($orcamento['Employee'] as $employee): ?>	
		<tr>
			<td><?php echo $employee['descricao'];?></td>
			<td><?php echo str_replace('.', ',', $employee['valor_unitario']);?></td>
			<td><?php echo $employee['qtd_dias'];?></td>
			<?php $valor_total = sprintf("%.2f", $employee['valor_unitario'] * $employee['qtd_dias']); ?>
			<td><?php echo str_replace('.', ',', $valor_total);?></td>
			<td>
				<?php
					echo $this->Html->link('Editar', array('controller' => 'employees', 'action' => 'edit', $employee['id']));
					echo '<br />';
					echo $this->Form->postLink('Deletar', 
						array('controller' => 'employees', 'action' => 'delete', $employee['id']),
						array('confirm' => 'Tem certeza que deseja deletar esta mão de obra?'));
				?>
			</td>			
		</tr>
	<?php endforeach; ?>
</table>

<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title">
			Gastos
		</div>
	</div>
</div>

<?php echo $this->Html->link('Adicionar Gastos', array('controller' => 'expenses', 'action' => 'add', $orcamento['Orcamento']['id'])); ?><br />
<table>
	<th>Descrição</th>
	<th>Período</th>
	<th>Valor Unitário</th>
	<th>Qtd.</th>	
	<th>Valor Total</th>
	<th>Ação</th>
	
	<?php foreach ($orcamento['Expense'] as $expense): ?>	
		<tr>
			<td><?php echo $expense['descricao'];?></td>
			<td>
				<?php
					if($expense['use_date'])
					{						
						$start = explode("-", $expense['per_start']);
						$end = explode("-", $expense['per_end']);
						echo 'De ' . date("d/m/Y", mktime(0, 0, 0, $start[1], $start[2], $start[0])) . '<br />à &nbsp;' 
							. date("d/m/Y", mktime(0, 0, 0, $end[1], $end[2], $end[0]));
					}
					else
						echo '--';
				?>				
			</td>
			<td><?php echo str_replace('.', ',', $expense['valor_unitario']);?></td>
			<td><?php echo $expense['qtd'];?></td>
			<?php $valor_total = sprintf("%.2f", $expense['valor_unitario'] * $expense['qtd']); ?>
			<td><?php echo str_replace('.', ',', $valor_total);?></td>
			<td>
				<?php
					echo $this->Html->link('Editar', array('controller' => 'expenses', 'action' => 'edit', $expense['id']));
					echo '<br />';
					echo $this->Form->postLink('Deletar', 
						array('controller' => 'expenses', 'action' => 'delete', $expense['id']),
						array('confirm' => 'Tem certeza que deseja deletar este gasto?'));
				?>
			</td>			
		</tr>
	<?php endforeach; ?>
</table>

<div class="entity_title_right_border">
	<div class="entity_title_left_border">
		<div class="entity_title" style="text-align: right;">
			<?php
				$total = $orcamento['Orcamento']['valor_bruto'] - $total;
				$total = str_replace(".", ",", sprintf('%.2f', $total));
				echo 'Total Líquido: R$' . $total;
			?>
		</div>
	</div>
</div>

