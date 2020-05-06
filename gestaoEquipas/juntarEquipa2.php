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

		<div class="box alt">
			<div class="row">
				<div class="3u" style="width:450px;">		
					<section class="sidebar">
						<ul class="default" style="padding-left: 40px;">
							<li><a href="criarEquipa.php"><strong>Criar Nova Equipa</a></strong></li>
							<li><a href="gestaoEquipas.php"><strong>Gestão de Equipas</strong></li>
							<li><a href="#"><strong style="color:red;">Juntar-se a Equipa</a></strong></li>
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
								$cc=$aux[0];
								$torneio=$aux[1];


						    	echo "<form action='' method='post'>";

						    		///////////////////////////////////// EQUIPAS /////////////////////////////////////////////////

						    		echo "<font size='5'><strong>".$aux[1]."</strong></font><br><br>";
						    		
									echo "<th><strong>Selecione uma equipa</strong></th>";

									echo "<table name='equipas' id='tabela'>
											<tr>
											 	<th>Equipa</th>
											 	<th>CC Capitão</th>
											 	<th>Nome Capitão</th>
											 	<th>Disponibilidade</th>
											 	<th>Aderir</th>
										  	</tr>";

										  	$totalEquipas=$connection->query("SELECT equipas.Nome_equipa, equipas.CC, COALESCE(disponibilidade.conta, 16) 'Disponibilidade', utilizadores.Primeiro_nome, utilizadores.Ultimo_nome 
																			FROM torneios, utilizadores, equipas LEFT JOIN (
																			                SELECT `equipas jogadores`.Nome_equipa, 16-COUNT(*) 'conta'
																			                FROM `equipas jogadores`
																			                GROUP BY Nome_equipa) as disponibilidade
																			ON equipas.Nome_equipa LIKE disponibilidade.Nome_equipa
																			WHERE equipas.Nome_torneio LIKE torneios.Nome_torneio 
																			AND equipas.Nome_torneio LIKE '".$torneio."'
																			AND utilizadores.CC LIKE equipas.CC
																			ORDER BY disponibilidade DESC");

										  	while($aux=mysqli_fetch_array($totalEquipas)){
										  		echo '<tr>
									            		<td>'.$aux[0].'</td>	
									            		<td>'.$aux[1].'</td>
									            		<td>'.$aux[3].' '.$aux[4].'</td>
									            		<td style="text-align:center;">'.$aux[2].'</td>';
									            		if($aux[2]!=0)	
									               			echo '<td><input type="button" value=">" onclick="location.href=\'juntarEquipa3.php?dados='.$cc.'  '.$torneio.'  '.$aux[0].'  '.$aux[1].'\'"></td>';
									               		else
									               			echo "<td><h>Sem vagas</h></td>";

									         	echo "</tr>";
										  	}
										  	
									echo "</table>";

									echo "<th><strong>Inscrição como reserva do torneio</strong></th><br><br>";

									echo "<input type='submit' name='submit' value='Inscrever' style='display:block;width:544px'><br>";

									if(isset($_POST['submit'])){
										$connection->query("INSERT INTO `reservas`(`CC`) VALUES ('".$cc."')");
										$connection->query("INSERT INTO `reservas torneios`(`CC`, `Nome_torneio`) VALUES ('".$cc."', '".$torneio."')");
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