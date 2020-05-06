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
				<div class="3u" style="width:250px;">		
					<section class="sidebar">
						<!--<header style="padding-left: 50px;">
							<h2>Nulla eleifend</h2>
						</header> -->
						<ul class="default" style="padding-left: 40px;">
							<li><a href="criarEquipa.php"><strong>Criar Nova Equipa</a></strong></li>
							<li><a href="gestaoEquipas.php"><strong>Gestão de Equipas</strong></li>
							<li><a href="juntarEquipa.php"><strong>Juntar-se a Equipa</a></strong></li>
							<li><a href="listaEquipas.php"><strong>Lista de Equipas</a></strong></li>
							<li><strong style="color:red;">Espaço de jogador</a></strong></li>
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

								$cc=$_GET['cc'];
								

			    				echo "<font size='5'><strong>Próximos jogos</strong></font><br><br>";

			    				$jogos=$connection->query("SELECT jogadores_jogo.Nome_torneio, jogos.Nome_equipa_visitante, slot.Dia_semana, jogos.Data, slot.Nome_campo, campos.Rua, campos.Numero, campos.Cidade, campos.GPS, slot.Hora_inicio, jogos.Nome_equipa_visitada, jogadores_jogo.id_jogo, equipas.CC
														FROM jogos, slot, campos, jogadores_jogo, equipas
														WHERE jogos.id_slot LIKE slot.id_slot 
														AND jogos.id_jogo LIKE jogadores_jogo.id_jogo
														AND jogadores_jogo.CC LIKE '".$cc."' 
														AND slot.Nome_campo LIKE campos.Nome_campo 
														AND jogadores_jogo.Nome_torneio LIKE jogos.Nome_torneio 
														AND jogadores_jogo.Nome_equipa LIKE jogos.Nome_equipa_visitante 
														AND equipas.Nome_equipa LIKE jogos.Nome_equipa_visitante 

														UNION

														SELECT jogadores_jogo.Nome_torneio, jogos.Nome_equipa_visitada, slot.Dia_semana, jogos.Data, slot.Nome_campo, campos.Rua, campos.Numero, campos.Cidade, campos.GPS, slot.Hora_inicio, jogos.Nome_equipa_visitante, jogadores_jogo.id_jogo, equipas.CC
														FROM jogos, slot, campos, jogadores_jogo, equipas
														WHERE jogos.id_slot LIKE slot.id_slot 
														AND jogos.id_jogo LIKE jogadores_jogo.id_jogo
														AND jogadores_jogo.CC LIKE '".$cc."' 
														AND slot.Nome_campo LIKE campos.Nome_campo 
														AND jogadores_jogo.Nome_torneio LIKE jogos.Nome_torneio 
														AND jogadores_jogo.Nome_equipa LIKE jogos.Nome_equipa_visitada 
														AND equipas.Nome_equipa LIKE jogos.Nome_equipa_visitada");

		    					echo "<table>";

			    					echo "<tr>
										 	<th>Torneio</th>
										 	<th>Equipa</th>
										 	<th>Dia</th>
										 	<th>Data</th>
										 	<th>Campo</th>
										 	<th>Morada</th>
										 	<th>GPS</th>
										 	<th>Hora</th>
										 	<th>Adversário</th>
										 	<th>Capitão</th>
										 	<th>Substituto</th>
									  	</tr>";

								        while($aux=mysqli_fetch_array($jogos)){
											echo '<tr>
										             <td>'.$aux[0].'</td>
										             <td>'.$aux[1].'</td>
										             <td>'.$aux[2].'</td>
										             <td>'.$aux[3].'</td>
										             <td>'.$aux[4].'</td>
										             <td>'.$aux[5].'  '.$aux[6].', '.$aux[7].'</td>
										             <td>'.$aux[8].'</td>
										             <td>'.$aux[9].'</td>
										             <td>'.$aux[10].'</td>
										             <td>'.$aux[12].'</td>
										             <td><a href="pedirSubstituto.php?dados='.$cc.'  '.$aux[1].'  '.$aux[11].'">Solicitar</a></td>
										           </tr>'; 
										}

							    echo "</table>";
							    echo"</form>";
					    				
					    								    			
					    							    		
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