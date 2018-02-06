<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8"/>
	<title>Busca em banco de dados</title>
	<script src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
	<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
	<script>
	$(function() {
	    $( ".calendario" ).datepicker({dateFormat: 'dd/mm/yy',
	    	changeMonth: true,changeYear: true,
	        dateFormat: 'dd/mm/yy',
	        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
	        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
	    });
	});
	</script>
	<style type="text/css">
	.carregando{
		color:#666;
		display:none;
	}
	</style>
</head>
<body>
	<?php
	if (empty($_POST['sigla']) && empty($_GET['sigla'])) {
		$estado = 'SP';
	} else {
		$estado = (empty($_GET['sigla'])? $_POST['sigla'] : $_GET['sigla']);
	}
	if (empty($_POST['cod_cidades']) && empty($_GET['cod_cidades'])) {
		$cod_cidade = '3550308';
	} else {
		$cod_cidade = (empty($_GET['cod_cidades'])? $_POST['cod_cidades'] : $_GET['cod_cidades']);
	}
	if (empty($_POST['start_date']) && empty($_GET['start_date'])) {
		$start_date = date('d/m/Y', time()-3*24*60*60);
	} else {
		$start_date = (empty($_GET['start_date'])? $_POST['start_date'] : $_GET['start_date']);
	}
	if (empty($_POST['end_date']) && empty($_GET['end_date'])) {
		$end_date = date('d/m/Y', time());
	} else {
		$end_date = (empty($_GET['end_date'])? $_POST['end_date'] : $_GET['end_date']);
	}
	?>
	<h2>Busca do que você quiser por cidade e período:</h2>
	<!-- Busca por estado e cidade -->
	<form name="f1" action="busca_cidades.php" method="post">
	<br><label for="sigla">Estado:</label>
	<select name="sigla" id="sigla">
		<option value=""></option>
		<?php
			// Conexão DB
			include("arquivos/DBconn.php");
			$dbname="NOME_DATABASE";
			$link = connectToDB($dbname) or die('Não foi possível conectar ao banco de dados.');
			// Consulta DB
			$sql = "SELECT sigla
					FROM estados
					ORDER BY sigla";
			$res = mysql_query( $sql );
			while ( $row = mysql_fetch_assoc( $res ) ) {
				echo '<option value="'.$row['sigla'].'">'.$row['sigla'].'</option>';
			}
		?>
	</select>
	<label for="cod_cidades">Cidade:</label>
	<span class="carregando">Aguarde, carregando...</span>
	<select name="cod_cidades" id="cod_cidades">
		<option value="">-- Escolha um estado --</option>
	</select>
	<script type="text/javascript">
	$(function(){
		$('#sigla').change(function(){
			if( $(this).val() ) {
				$('#cod_cidades').hide();
				$('.carregando').show();
				$.getJSON('cidades.ajax.php?search=',{sigla: $(this).val(), ajax: 'true'}, function(j){
					var options = '<option value=""></option>';	
					for (var i = 0; i < j.length; i++) {
						options += '<option value="' + j[i].cod_cidades + '">' + j[i].nome + '</option>';
					}	
					$('#cod_cidades').html(options).show();
					$('.carregando').hide();
				});
			} else {
				$('#cod_cidades').html('<option value="">– Escolha um estado –</option>');
			}
		});
	});
	</script>
	
	<!-- Busca por datas -->
	<br><p>Pesquisa de 
	<input type="text" class="calendario" name="start_date" value="<?php echo $start_date;?>" autocomplete="off"/>
	 a 
	<input type="text" class="calendario" name="end_date" value="<?php echo $end_date;?>" autocomplete="off"/>
	</p>
	
	<!-- Fechar formulário e botão de busca -->
	<input type="submit" value="Busca">
	</form>
	<br><br>
	<?php
	// Montar query
	$data1=explode("/", $start_date);
	$data2=explode("/", $end_date);
	$dia_inicial= sprintf("%04d",$data1[2])."-".sprintf("%02d",$data1[1])."-".sprintf("%02d",$data1[0]);
	$dia_final=sprintf("%04d",$data2[2])."-".sprintf("%02d",$data2[1])."-".sprintf("%02d",$data2[0]);
	$query = "SELECT * FROM `".$estado."` WHERE codigo = \"".$cod_cidade."\" AND data BETWEEN \"".$dia_inicial."\" AND \"".$dia_final."\" ORDER BY data;";
	//echo $query;
	$result = mysql_query($query) or die("Nao foi possivel obter os dados");
	// Montar tabela HTML
	echo "<table>";
	echo "<thead><tr><th>Estado</th><th>Cidade</th><th>Data</th><th>Quantidade</th></tr></thead>";
	echo "<tbody>";
	while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
		echo "<tr><td>".$row['estado']."</td><td>".$row['cidade']."</td><td>".$row['data']."</td><td>".$row['raios']."</td></tr>";
	}
	echo "</tbody></table>";
	mysql_close($link);
	?>
</body>
</html>
