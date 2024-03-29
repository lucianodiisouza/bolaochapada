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
		<h4>Rodadas</h4>
	</div>
	<!-- botoes do topo (enviar e voltar para a página anterior) -->
	<div class="header_flexFinal">
		<a href="index.php" class="btn btn-danger">Cancelar</a> &nbsp;
		<button type="submit" class="btn btn-success">Salvar</button>
		<input type="hidden" name="envia" value="envia">
	<!-- botoes do topo (enviar e voltar para a página anterior) -->
	</div>
	<br>
	<div class="row">
		<div class="col">
			<?php $dadosGravados = false;
			if ($dadosGravados = false) {
			?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				Preencha até o <strong>final e volte conferindo</strong> O botão de salvar não está aqui em cima por acaso!
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			 	</button>
			</div>
			<?php }elseif($dadosGravados = true){ ?>
				<div class="alert alert-success" role="alert">
				  Sua rodada foi gravada com sucesso <a href="index.php" class="success-link">clique aqui</a> para visualizar.
				</div>
			<?php } ?>
			<!-- Alert com dismiss  -->

			<!-- Alert com dismiss -->
		</div>		
	</div>
	<?php 
		$id = $_GET['id'];
		$sql = "SELECT * FROM rodada WHERE id = $id";
		$qry = mysqli_query($conecta, $sql);

		$resultado = mysqli_fetch_assoc($qry);
		
		$dataInicial = date( 'd/m/Y', strtotime($resultado["dataInicio"]));
		$horaInicial = date( 'H:i', strtotime($resultado["dataInicio"]));		
		$dataFinal = date( 'd-m-Y', strtotime($resultado["dataTermino"]));
		$horaFinal = date('H:i', strtotime($resultado["dataTermino"]));

	?>
	<div class="row">
		<div class="col-md-3">
			Nome atual:
			<input type="text" name="nome" class="form-control" maxlength="250" minlength="5" value="<?php echo $resultado['nome'] ?>" readonly>
		</div>
		<div class="col-md-1">
			Valor:
			<input type="text" name="valor" class="form-control" value="<?php echo $resultado['valor'] ?>" readonly>
		</div>
		<div class="col-md-4">
			Início (atual):
			<input type="text" name="dataInicio" class="form-control" value="<?php echo $dataInicial.' '.$horaInicial ?>" readonly >
		</div>
		<div class="col-md-4">
			Término (atual):
			<input type="text" name="dataTermino" class="form-control" value="<?php echo $dataFinal.' '.$horaFinal ?>" readonly>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			Nome:
			<input type="text" name="nome" class="form-control" maxlength="250" minlength="5" value="<?php echo $resultado['nome'] ?>" required>
		</div>
		<div class="col-md-1">
			Valor:
			<input type="text" name="valor" class="form-control" value="<?php echo $resultado['valor'] ?>">
		</div>
		<div class="col-md-4">
			Início:
			<input type="datetime-local" name="dataInicio" class="form-control" value="<?php echo $dataInicial.' '.$horaInicial ?>" >
		</div>
		<div class="col-md-4">
			Término:
			<input type="datetime-local" name="dataTermino" class="form-control" value="<?php echo $resultado['dataTermino'] ?>">
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<!--  -->
			Jogo 1:
			<?php
				if ($resultado["jogoA"] == 'vazio') {
			?>
				<select name="jogoA" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoA" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoA"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
		<div class="col-md-6">
			<!--  -->
			Jogo 2:
			<?php
				if ($resultado["jogoB"] == 'vazio') {
			?>
				<select name="jogoB" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoB" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoB"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<!--  -->
			Jogo 3:
			<?php
				if ($resultado["jogoC"] == 'vazio') {
			?>
				<select name="jogoC" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoC" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoC"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php $linha['id'] ?>" selected hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
		<div class="col-md-6">
			<!--  -->
			Jogo 4:
			<?php
				if ($resultado["jogoD"] == 'vazio') {
			?>
				<select name="jogoD" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoD" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoD"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<!--  -->
			Jogo 5:
			<?php
				if ($resultado["jogoE"] == 'vazio') {
			?>
				<select name="jogoE" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoE" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoE"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
		<div class="col-md-6">
			<!--  -->
			Jogo 6:
			<?php
				if ($resultado["jogoF"] == 'vazio') {
			?>
				<select name="jogoF" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoF" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoF"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<!--  -->
			Jogo 7:
			<?php
				if ($resultado["jogoG"] == 'vazio') {
			?>
				<select name="jogoG" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoG" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoG"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
		<div class="col-md-6">
			<!--  -->
			Jogo 8:
			<?php
				if ($resultado["jogoH"] == 'vazio') {
			?>
				<select name="jogoH" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoH" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoH"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<!--  -->
			Jogo 9:
			<?php
				if ($resultado["jogoI"] == 'vazio') {
			?>
				<select name="jogoI" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoI" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoI"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
		<div class="col-md-6">
			<!--  -->
			Jogo 10:
			<?php
				if ($resultado["jogoJ"] == 'vazio') {
			?>
				<select name="jogoJ" class="form-control" >
					<option value="vazio" selected default>Selecione uma partida...</option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}else{
			?>
				<select name="jogoJ" class="form-control" >
					<?php 
						$select = "SELECT * FROM jogos where id = {$resultado["jogoJ"]}";
						$exibir = mysqli_query($conecta, $select);
						$linha = mysqli_fetch_assoc($exibir);
						$data = date( 'd/m', strtotime($linha['data']));
						$hora = date( 'H:i', strtotime($linha['hora']));

					?>
					<option value="<?php echo $linha['id'] ?>" selected  hidden><?php echo $linha['timeA']." X ".$linha['timeB']." - Data: ".$data." - Hora: ".$hora ?></option>
					<?php
						$sql = "SELECT * FROM jogos ORDER BY data DESC";
						$exibe = mysqli_query($conecta, $sql);
						while ($row = mysqli_fetch_assoc($exibe)){
							
							$data = date( 'd/m', strtotime($row['data']));
							$hora = date( 'H:i', strtotime($row['hora']));

							echo("<option value='".$row['id']."'>".$row['timeA']." X ".$row['timeB']." - Data: ".$data." - Hora: ".$hora."</option>");
						}
					?>
				</select>
			<?php
				}
			?>
			<!--  -->
		</div>
	</div>		
	<!-- enviando dados ao DB -->
	<?php 
		if (isset($_POST['envia'])) {
			// declarando as variaveis POST para mandar tudo para o DataBase em uma viagem só
			$nome = $_POST["nome"];
			$valor = $_POST["valor"];
			$dataInicio = $_POST["dataInicio"];
			$dataTermino = $_POST["dataTermino"];
			// Agora começa a brincadeira! eu sequenciei os jogos com letras, pegando apenas o ID, quero ver como isso vai ficar depois hahaha
			$jogoA = $_POST["jogoA"];
			$jogoB = $_POST["jogoB"];
			$jogoC = $_POST["jogoC"];
			$jogoD = $_POST["jogoD"];
			$jogoE = $_POST["jogoE"];
			$jogoF = $_POST["jogoF"];
			$jogoG = $_POST["jogoG"];
			$jogoH = $_POST["jogoH"];
			$jogoI = $_POST["jogoI"];
			$jogoJ = $_POST["jogoJ"];

			$sql = "UPDATE rodada SET nome='$nome', dataInicio='$dataInicio', dataTermino='$dataTermino', valor='$valor', jogoA='$jogoA', jogoB='$jogoB', jogoC='$jogoC', jogoD='$jogoD', jogoE='$jogoE', jogoF='$jogoF', jogoG='$jogoG', jogoH='$jogoH', jogoI='$jogoI', jogoJ='$jogoJ' WHERE id = $id;";

				if ($conecta->query($sql) === TRUE) {
					$dadosGravados = true;
				} else {
					echo "Erro: " . $sql . "<br>" . $conecta->error;
				}					
			}
		?>
</form>
<?php require('../_footer.php'); ?>