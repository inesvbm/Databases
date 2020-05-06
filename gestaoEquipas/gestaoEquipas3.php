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
							<li><a href="listaEquipas.php"><strong>Lista de Equipas</a></strong></li>
							<li><a href="espacoJogador.php"><strong>Espaço de jogador</a></strong></li>
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

								$result=$_GET['dados'];
								$aux=explode('  ', $result);

								echo "<form action='' method='post'>";

								//////////////////////////////////// NOME DA EQUIPA ///////////////////////////////////////////

								echo "<font size='5'><strong>".$aux[1]."</strong></font><br><br>";

								//////////////////////////////////// NOME DO JOGADOR ///////////////////////////////////////////

								echo "<strong>".$aux[2]."  ".$aux[3]."</strong></th><br><br>";

								//////////////////////////////////// POSICAO EM JOGO ///////////////////////////////////////////

								echo "<strong>Posição</strong><br>					 
								<select name='Posicao' style='height:30px'/>";

								if($aux[4]=='Defesa')
									echo "<option value='Defesa' selected>Defesa</option>";
								else
									echo "<option value='Defesa'>Defesa</option>";

								if($aux[4]=='Medio')	
									echo "<option value='Medio' selected>Médio</option>";
								else
									echo "<option value='Medio'>Médio</option>";

								if($aux[4]=='Avancado')	
									echo "<option value='Avancado' selected>Avançado</option>";
								else
									echo "<option value='Avancado'>Avançado</option>";

								if($aux[4]=='Guarda-redes')	
									echo "<option value='Guarda-redes' selected>Guarda-redes</option>";
								else
									echo "<option value='Guarda-redes'>Guarda-redes</option>";
								echo "</select><br>";

								//////////////////////////////////// ESTATUTO ///////////////////////////////////////////

							    echo "<strong>Estatuto</strong><br>";

							    echo "<select name='Estatuto' style='height:30px'/>";

							    if($aux[5]==0){
							    	echo "<option value='Titular' selected>Titular</option>";
							    	echo "<option value='Suplente'>Suplente</option>";
							    }
								else{
									echo "<option value='Suplente' selected>Suplente</option>";
									echo "<option value='Titular'>Titular</option>";
								}
								echo "</select><br>";	

								//////////////////////////////////// PRIORIDADE ///////////////////////////////////////////
								
								echo "<strong>Prioridade</strong><br>";
								echo "<input type='text' value=".$aux[6]." name='Prioridade' style='width:230px;height:30px;'/><br>";

								//////////////////////////////////// FALTOU AO JOGO ///////////////////////////////////////////

								echo "<strong>Faltou</strong><br>
								<input type='text' value=".$aux[7]." name='Faltou' style='width:230px;height:30px;'/><br>";

								//////////////////////////////////// SALDO ///////////////////////////////////////////

								echo "<strong>Saldo</strong><br>
								<input type='text' value=".$aux[8]." name='Saldo' style='width:230px;height:30px;'/><br><br>";

								//////////////////////////////////// ATUALIZAR NA BD ///////////////////////////////////////////

								echo "<input type='submit' name='submit' value='Guardar' style='display:block;width:230px'>		
									
						        </form>";					   

						       	if(isset($_POST['submit'])){

						       		$posicao=$_POST['Posicao'];

						       		$suplente=0;
						       		$estat=$_POST['Estatuto'];
						       		if($estat=='Suplente')
						       			$suplente=1;


						       		$prioridade=$_POST['Prioridade'];
						       		$faltou=$_POST['Faltou'];
						       		$saldo=$_POST['Saldo'];

						       		$connection->query("UPDATE jogadores
													SET jogadores.Prioridade_conv='".$prioridade."', jogadores.Saldo='".$saldo."', jogadores.Numero_falhas=jogadores.Numero_falhas+'".$faltou."'
													WHERE jogadores.CC LIKE '".$aux[9]."'");

						       		$connection->query("UPDATE jogadores_jogo
													SET jogadores_jogo.Posicao='".$posicao."', jogadores_jogo.Suplente='".$suplente."'
													WHERE jogadores_jogo.CC LIKE '".$aux[9]."' AND jogadores_jogo.Nome_equipa LIKE '".$aux[1]."' AND jogadores_jogo.Nome_torneio LIKE '".$aux[10]."'");

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