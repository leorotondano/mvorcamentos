<?php 
App::import('Vendor','xtcpdf');  
//$tcpdf = new XTCPDF(); 
$tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans' 

// set default header data
$copyright  = 'Copyright (C) %d MV SERVIÇOS. Todos os direitos reservados.';
$copyright = sprintf($copyright, date('Y'));
$tcpdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'MV SERVIÇOS', 'www.mvservicoseletricos.com.br');

// set header and footer fonts
$tcpdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$tcpdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$tcpdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$tcpdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$tcpdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$tcpdf->SetAuthor("MV Serviços em http://www.mvservicoseletricos.com.br"); 
$tcpdf->SetAutoPageBreak(true, PDF_MARGIN_FOOTER);

// add a page (required with recent versions of tcpdf)
$tcpdf->SetFont('helvetica', '', 10);
$tcpdf->AddPage();
/* Style */
$style =<<<STYLE
	<style>
		*
		{
			padding: 0px;
			margin: 0px;
		}
		*
		.bold
		{
			font-weight: bold;
		}
		.justify
		{
			text-align: justify;
		}
	</style>
STYLE;
/* end Style */

/* Orcamento */
$orc = $orcamento['Orcamento'];
$identificacao = $orc['identificacao'];
$orc_val_bruto = str_replace('.', ',', $orcamento['Orcamento']['valor_bruto']);
$orc_descricao = str_replace("\n", "<br />", trim($orc['descricao']));
$orc_cond_geral = str_replace("\n", "<br />", trim($orc['cond_geral']));
$orc_cond_comercial = str_replace("\n", "<br />", trim($orc['cond_comercial']));

$orcamento_html = <<<ORCAMENTO
	<div><span class="bold">ORÇAMENTO $identificacao</span></div>
	<div class="orcamento">
		<span class="bold">Valor Bruto:</span> R$ $orc_val_bruto; <br />
		<span class="bold">Descrição:</span> <span class="justify"><br />$orc_descricao</span><br />
		<span class="bold">Condições Gerais:</span> <span class="justify"><br />$orc_cond_geral</span><br />
		<span class="bold">Condições Comerciais:</span> <span class="justify"><br />$orc_cond_comercial</span>
	</div>
ORCAMENTO;

/* end Orcamento */

/* Cliente */
$cliente = $orcamento['Cliente'];
$cliente_html = <<<CLIENTE
	<div><span class="bold">CLIENTE</span></div>
	<div class="cliente">
		<span class="bold">Razão Social:</span> $cliente[razao];<br />		
		<span class="bold">CNPJ/CPF</span>: $cliente[cnpj_cpf];<br />
		<span class="bold">Endereço:</span> $cliente[endereco];<br />
		<span class="bold">Telefone:</span> $cliente[telefone];<br />
		<span class="bold">Falar com:</span> $cliente[falar_com];<br />
		<span class="bold">Email:</span> $cliente[email];<br />
		<span class="bold">Inscrição Estadual:</span> $cliente[insc_estadual];<br />
		<span class="bold">Inscrição Municipal:</span> $cliente[insc_municipal];		
	</div>
CLIENTE;
/* end Cliente */

/* Material */
$materials = $orcamento['Material'];
$materials_html = '';
if(!empty($materials))
{
	$materials_html = <<<MATERIAL
		<br /><br />
		<table border="1" align="center">
			<thead>
				<tr>
					<th style="background-color:#DDDDDD" colspan="5" align="center" width="510"><b>MATERIAIS</b></th>
				</tr>
				<tr style="background-color:#DDDDDD">
					<th width="270"><b>Descrição</b></th>
					<th width="80"><b>Valor Unitário</b></th>
					<th width="50"><b>Qtd.</b></th>
					<th width="50"><b>Grandeza</b></th>
					<th width="60"><b>Valor Total</b></th>
				</tr>			
			</thead>
			
MATERIAL;
	foreach ($materials as $material):
		$valor_unitario = str_replace('.', ',', $material['valor_unitario']);
		$qtd_material = str_replace('.', ',', $material['qtd_material']);
		$valor_total = sprintf("%.2f", $material['valor_unitario'] * $material['qtd_material']);
		$valor_total = str_replace('.', ',', $valor_total);
		$materials_html = $materials_html . '<tr>';
		$materials_html = $materials_html . "<td width=\"270\">$material[descricao]</td>";
		$materials_html = $materials_html . "<td width=\"80\">$valor_unitario</td>";	
		$materials_html = $materials_html . "<td width=\"50\">$qtd_material</td>";
		$materials_html = $materials_html . "<td width=\"50\">$material[grandeza]</td>";	
		$materials_html = $materials_html . "<td width=\"60\">$valor_total</td>";
		$materials_html = $materials_html . '</tr>';	
	endforeach;
	$materials_html = $materials_html . '</table>';
	$total_material = str_replace('.', ',', sprintf("%.2f", $total_material));
	$materials_html = $materials_html . "<span><b>TOTAL MATERIAIS:</b> R$</span>$total_material;";
}
/* end Material */
	
/* Employee */
$employees = $orcamento['Employee'];
$employees_html = '';
if(!empty($employees))
{
	$employees_html = <<<EMPLOYEE
		<br /><br />
		<table border="1" align="center">
			<thead>
				<tr>
					<th style="background-color:#DDDDDD" colspan="4" align="center" width="510"><b>MÃO DE OBRA</b></th>
				</tr>
				<tr style="background-color:#DDDDDD">
					<th width="320"><b>Descrição</b></th>
					<th width="80"><b>Valor Unitário</b></th>
					<th width="50"><b>Qtd.</b></th>
					<th width="60"><b>Valor Total</b></th>
				</tr>			
			</thead>
EMPLOYEE;
	foreach ($employees as $employee):
		$valor_unitario = str_replace('.', ',', $employee['valor_unitario']);
		$qtd_dias = str_replace('.', ',', $employee['qtd_dias']);
		$valor_total = sprintf("%.2f", $employee['valor_unitario'] * $employee['qtd_dias']);
		$valor_total = str_replace('.', ',', $valor_total);
		$employees_html = $employees_html . '<tr>';
		$employees_html = $employees_html . "<td width=\"320\">$employee[descricao]</td>";
		$employees_html = $employees_html . "<td width=\"80\">$valor_unitario</td>";	
		$employees_html = $employees_html . "<td width=\"50\">$qtd_dias</td>";
		$employees_html = $employees_html . "<td width=\"60\">$valor_total</td>";
		$employees_html = $employees_html . '</tr>';	
	endforeach;
	$employees_html = $employees_html . '</table>';
	$total_employee = str_replace('.', ',', sprintf("%.2f", $total_employee));
	$employees_html = $employees_html . "<span><b>TOTAL MÃO DE OBRA:</b> R$</span>$total_employee;";
}
/* end Employee*/

/* Expense */
$expenses = $orcamento['Expense'];
$expenses_html = '';
if(!empty($expenses))
{
	$expenses_html = <<<EXPENSE
		<br /><br />
		<table border="1" align="center">
			<thead>
				<tr>
					<th style="background-color:#DDDDDD" colspan="4" align="center" width="510"><b>GASTOS DIVERSOS</b></th>
				</tr>
				<tr style="background-color:#DDDDDD">
					<th width="200"><b>Descrição</b></th>
					<th width="60"><b>Dt. Início</b></th>
					<th width="60"><b>Dt. Fim</b></th>
					<th width="80"><b>Valor Unitário</b></th>
					<th width="50"><b>Qtd.</b></th>
					<th width="60"><b>Valor Total</b></th>
				</tr>			
			</thead>
EXPENSE;
	foreach ($expenses as $expense):
		$valor_unitario = str_replace('.', ',', $expense['valor_unitario']);
		$qtd = str_replace('.', ',', $expense['qtd']);
		$valor_total = sprintf("%.2f", $expense['valor_unitario'] * $expense['qtd']);
		$valor_total = str_replace('.', ',', $valor_total);
		if($expense['use_date'])
		{
			$start = explode("-", $expense['per_start']);
			$start = date("d/m/Y", mktime(0, 0, 0, $start[1], $start[2], $start[0]));
			$end = explode("-", $expense['per_end']);
			$end = date("d/m/Y", mktime(0, 0, 0, $end[1], $end[2], $end[0]));
		}
		else
		{
			$start = '--';
			$end = '--';
		}
		$expenses_html = $expenses_html . '<tr>';
		$expenses_html = $expenses_html . "<td width=\"200\">$expense[descricao]</td>";
		$expenses_html = $expenses_html . "<td width=\"60\">$start</td>";
		$expenses_html = $expenses_html . "<td width=\"60\">$end</td>";
		$expenses_html = $expenses_html . "<td width=\"80\">$valor_unitario</td>";	
		$expenses_html = $expenses_html . "<td width=\"50\">$qtd</td>";
		$expenses_html = $expenses_html . "<td width=\"60\">$valor_total</td>";
		$expenses_html = $expenses_html . '</tr>';	
	endforeach;
	$expenses_html = $expenses_html . '</table>';
	$total_expense = str_replace('.', ',', sprintf("%.2f", $total_expense));
	$expenses_html = $expenses_html . "<span><b>TOTAL GASTOS DIVERSOS:</b> R$</span>$total_expense;";
}
/* end Expense*/

$total_orcamento = str_replace('.', ',', sprintf("%.2f", $total_orcamento));
$total_html = "<br /> <br /><span><b>TOTAL CUSTOS:</b> R$</span>$total_orcamento;";

$html = $style . $orcamento_html . $cliente_html . $materials_html . $employees_html. $expenses_html . $total_html;
//$html = $materials_html;

//$tcpdf->writeHTMLCell($w=0, $h=0, $x='', $y='10', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
$tcpdf->writeHTML($html, true, false, false, false, '');

$tcpdf->lastPage();
echo $tcpdf->Output('orcamento.pdf', 'D');


?>