<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>	
	<title>
		MV Serviços Orçamentos
	</title>
	<link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css" />
	<?php		
		echo $this->Html->charset();		
		echo $this->Html->css('style01.css');		
		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="top">
		<div class="logout">
		<?php 
			if($showLogout)
				echo $this->Html->link('Logout', array('controller' => 'users', 'action' => 'logout'));
		?>
		</div>
		<div class="logo">
		</div>
	</div>
	<div class="menu">
		<div class="menu_left">
			<?php echo $this->Html->link('Orçamentos', array('controller' => 'orcamentos', 'action' => 'index'));?>
			<div class="clear_both"></div>
		</div>
		<div class="menu_center">
		</div>
		<div class="menu_right">
			<?php echo $this->Html->link('Clientes', array('controller' => 'clientes', 'action' => 'index'));?>
			<div class="clear_both"></div>
		</div>
	</div>
	<div class="site_body">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		
		<?php //echo $this->element('sql_dump'); ?>
		<div class="clear_both" />		
	</div>
	<div class="footer">
		<div class="footer_left">
			Copyright (C) 2012 MV SERVIÇOS.
		</div>
		<div class="footer_right">
			Tel.: <span class="ddd">(71) </span>3024-0293
			<span class="email"><br />mvservicos@ymail.com</span>
		</div>
		<div class="clear_both">
		</div>
	</div>
</body>
</html>
