<?php
session_start();
require('inc/conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Luciano dii Souza - Web Developer FullStack And MobileDev">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="O Bolão Chapada é uma iniciativa entre amigos para os amantes do Futebol! Entre, cadastre-se e se divirta! Usuários de Android poderão baixar nosso App na PlayStore!">

	<title>Dashboard - BolãoChapada</title>

	<!-- Arquivos de StyleSheet e ThirdParty Libraries -->
	<!-- css meu -->
	<!-- <link rel="stylesheet" type="text/css" href="css/dashboard.css"> -->
	<!-- css base do bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- css do datatables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- css terminam aqui -->
</head>
	<body>
        <div class="container">
            <div class="block_login">
                <br><br><br><br>
                <center>
                    <img src="img/bg.png" alt="Bolão Chapada" title="Bolão Chapada" style="width: 128px; height: 128px;">
                </center>
                <form method="post">
                    <?php
                        if(isset($_SESSION['nao_autenticado'])):
                    ?>
                        <div class="row">
                        <div class="col-md-4">
                        </div>
                            <div class="col-md-4">
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Usuário ou senha incorretos.
                                </div>
                            </div>
                        <div class="col-md-4">
                        </div>
                     </div>
                    <?php
                        endif;
                        unset($_SESSION['nao_autenticado']);
                    ?>
                
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="usuario" placeholder="usuário" class="form-control" autocomplete="false" required><br>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <input type="password" name="senha" placeholder="senha" class="form-control" autocomplete="false" required><br>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        <center>
                            <button type="submit" value="Entrar" name="entrar" class=" btn btn-primary">Entrar</button>
                            <button type="reset" value="Limpar" name="limpar" class=" btn btn-danger">Limpar</button>
                            <input type="hidden" value="login" name="login" />
                        </center>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                     <?php
                        if (isset($_POST['login'])) {
                            $usuario = $_POST['usuario'];
                            $senha = $_POST['senha'];

                            $sql = "SELECT id, usuario FROM usuarios WHERE usuario = '{$usuario}' AND senha = md5('{$senha}') AND role = 'admin';";
                            
                            $consulta = mysqli_query($conecta, $sql);
                            $linha = mysqli_num_rows($consulta);
                            
                            if($linha == 1){
                                $_SESSION['usuario'] = $usuario;
                                $_SESSION['id'] = $id_usarioAtual;
                                header('Location: index.php');
                                exit();
                            }else{
                                $_SESSION['nao_autenticado'] = true;
                                header('Location: login.php');
                                exit();
                            }
                        }
                        ?>
                 </form>
             </div>
        </div>
	</body>
</html>