<!-- Arquivo de índice da aplicação  -->
<?php require('../_header_sub.php'); ?>
<link rel="stylesheet" type="text/css" href="../css/dashboard.css">
<?php require('../_navegar_sub.php'); ?>
<div class="container-fluid" style="width: 90% !important;">
<br>
<br>
<br>
<form method="post">
	<div class="header_FlexInicio">
		<h4>Jogos</h4>
	</div>
	<div class="header_flexFinal">
		<a href="index.php" class="btn btn-danger">Voltar</a> &nbsp;
		<button type="submit" class="btn btn-success">Enviar <i class="far fa-paper-plane"></i></button>
		<input type="hidden" name="envia" value="envia">
	</div>
		<div class="row">
			<div class="col">
				Time Mandante:
				<select name="timeMandante" class="form-control" required>
					<option value="" selected disabled hidden>Selecione um time...</option>
					<?php
						$sql = "SELECT * FROM times order by nome asc";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							echo("<option value='".$row['id']."'>".$row['nome']."</option>");
						}
					?>
				</select>
			</div>
			<div class="col">
				Time Visitante:
				<select name="timeVisitante" class="form-control" required>
					<option value="" selected disabled hidden>Selecione um time...</option>
					<?php
						$sql = "SELECT * FROM times order by nome asc";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							echo("<option value='".$row['id']."'>".$row['nome']."</option>");
						}
					?>
				</select>
			</div>	
		</div>
		<div class="row">
			<div class="col">
				Data:
				<input type="date" name="data" class="form-control" required>
			</div>
			<div class="col">
				Hora:
				<input type="time" name="hora" class="form-control" required>
			</div>
			<div class="col">
				Local:
				<input type="text" name="local" class="form-control">
			</div>
		</div>
	</div>
	<?php 
		if (isset($_POST['envia'])) {
			$mandante = $_POST['timeMandante'];
			$sql = "SELECT * FROM times WHERE id = $mandante";
			$qry = mysqli_query($conecta, $sql);
			$nomeTime1 = mysqli_fetch_assoc($qry);
			$siglaTimeA = $nomeTime1['sigla'];
			$nomeTimeA = $nomeTime1['nome'];
			
			$visitante = $_POST['timeVisitante'];
			$sqlV = "SELECT * FROM times WHERE id = $visitante";
			$qryV = mysqli_query($conecta, $sqlV);
			$nomeTime2 = mysqli_fetch_assoc($qryV);
			$siglaTimeB = $nomeTime2['sigla'];
			$nomeTimeB = $nomeTime2['nome'];

			$data = $_POST['data'];
			$hora = $_POST['hora'];
			$local = $_POST['local'];

			$sql = "INSERT INTO jogos (timeA, nomeTimeA, nomeTimeB, timeB, data, hora, local) VALUES ( '$siglaTimeA', '$nomeTimeA', '$nomeTimeB', '$siglaTimeB', '$data', '$hora', '$local' )";
			if ($conecta->query($sql) === TRUE) {
				    echo "Jogo cadastrado";
				} else {
				    echo "Erro: " . $sql . "<br>" . $conecta->error;
				}
				
			}
		 ?>
</form>
<?php require('../_footer.php'); ?>