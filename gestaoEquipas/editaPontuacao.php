<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA_Compatible" content="IE=edge,chrome=1">
		<title>Futebol Amador</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<script src="js/gestaoEquipas.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style_base.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />			
		</noscript>
	</head>
	<body>
		<!-- Header -->
		<header id="header">
			<h1><a href="index.html">Futebol Amador</a></h1>
			<nav id="nav">
				<ul>
					<li><a href="#">Torneios</a></li>
					<li><a href="#">Equipas</a></li>
					<li>
						<a href="notificacoes.php" class="icon rounded fa-bell"></a>
					</li>
					<li>
						<div class="dropdown">
						    <button class="dropbtn">
						      <img src="images/foto.jpg" onerror="this.src='images/user.png';" style="width:auto;height:50px; border-radius:50%">
						      <br><a>Inês Moreira</a>
						    </button>
						    <div class="dropdown-content">
						      <a href="#">Ver perfil</a>
						      <a href="#">Editar perfil</a>
						      <a href="#">Terminar sessão</a> 	
						    </div>
						</div>
					</li>
				</ul>				
			</nav>
		</header>
	
		<!-- Colocar conteudo do ecra -->
		<div class="box alt">
			<div class="row">
				<div class="3u" style="width:600px;">		
					<section class="sidebar">
						<!--<header style="padding-left: 50px;">
							<h2>Nulla eleifend</h2>
						</header> -->
						<ul class="default" style="padding-left: 40px;">
							<li><a href="criarEquipa.php"><strong>Criar Nova Equipa</a></strong></li>
							<li><strong style="color:red;">Gestão de Equipas</strong></li>
							<li><a href="juntarEquipa.php"><strong>Juntar-se a Equipa</a></strong></li>
							<li><a href="listaEquipas.php"><strong>Listar de Equipas</a></strong></li>
						</ul>				
					</section>	
				</div>
				
				<div class="tab">
					<?php
						session_start();
						require_once "connect_db.php";
						mysqli_report(MYSQLI_REPORT_STRICT);
						try{
							$connection = new mysqli($host, $db_user, $db_password, $db_name);
							if ($connection->connect_errno != 0){
								throw new Exception(mysqli_connect_errno());
							}
							else{

								$result=$_GET['editaPontuacao'];
								$aux=explode('  ', $result);

								echo "<form action='' method='post'>
								<th>Equipa: <strong>".$aux[2]."</strong></th><br>					 
								<input type='text' name='textField1' style='width:230px;height:25px;'/><br>				
							    <th>Adversário: <strong>".$aux[3]."</strong></th><br>
								<input type='text' name='textField2' style='width:230px;height:25px;'/><br><br>

								<input type='submit' name='submit' value='Guardar' style='display:block;width:230px'>		
									
						        </form>";					   

						       	if(isset($_POST['submit'])){

						       		$golosE=$_POST['textField1'];
						       		$golosA=$_POST['textField2'];

						       		$connection->query("UPDATE jogos
													SET jogos.Golos_visitantes='".$golosE."', jogos.Golos_visitados='".$golosA."'
													WHERE jogos.id_jogo LIKE '".$aux[0]."' AND jogos.Nome_torneio LIKE '".$aux[1]."'");

						       		echo '<script language="javascript">';
									echo 'alert("Dados de jogo atualizados!")';
									echo '</script>';
						       	}

					    		$connection->close();
													    		
							}

						}catch(Exception $e){
							echo '<span style="color:red;">Server error! Try later</span>';
							echo '<br />Developer info: '.$e;
						}
  						
				    ?>	
				</div>  
		
			</div>

		</div>
		<footer id="footer">
			<div class="container">
				<div class="row">
					<div class="8u 12u$(medium)">
						<ul class="copyright">
							<li>&copy; Untitled. All rights reserved.</li>
							<li>Design: <a href="http://templated.co">TEMPLATED</a></li>
							<li>Images: <a href="http://unsplash.com">Unsplash</a></li>
						</ul>
					</div>
					<div class="4u$ 12u$(medium)">
						<ul class="icons">
							<li>
								<a class="icon rounded fa-facebook"><span class="label">Facebook</span></a>
							</li>
							<li>
								<a class="icon rounded fa-twitter"><span class="label">Twitter</span></a>
							</li>
							<li>
								<a class="icon rounded fa-google-plus"><span class="label">Google+</span></a>
							</li>
							<li>
								<a class="icon rounded fa-linkedin"><span class="label">LinkedIn</span></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>