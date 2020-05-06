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
				<div class="3u" style="width:550px;">		
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

								$dados=$_GET['dados'];
								$result=explode('  ', $dados);
								$cc=$result[0];
								$torneio=$result[1];
								$equipa=$result[2];
								$disponibilidade=$result[3];

						    	echo "<form action='' method='post'>";

						    		///////////////////////////////////// EQUIPAS /////////////////////////////////////////////////

						    		echo "<font size='5'><strong>".$result[2]."</strong></font><br><br>";
						    		
									echo "<th><strong>Selecione a posição em que deseja jogar</strong></th>";


									$contagemPos=$connection->query("SELECT 5-COUNT(*), (SELECT 4-COUNT(*) 
																				FROM jogadores_jogo a 
																				WHERE a.Nome_equipa LIKE '".$equipa."' AND a.Posicao LIKE 'Medio') 
																	FROM jogadores_jogo a 
																	WHERE a.Nome_equipa LIKE '".$equipa."' AND a.Posicao LIKE 'Defesa'");

									$contagemPos1=$connection->query("SELECT 5-COUNT(*), (SELECT 2-COUNT(*) 
																					FROM jogadores_jogo a 
																					WHERE a.Nome_equipa LIKE '".$equipa."' AND a.Posicao LIKE 'Guarda-redes')   
																	FROM jogadores_jogo a 
																	WHERE a.Nome_equipa LIKE '".$equipa."' AND a.Posicao LIKE 'Avancado'");				

									$aux = mysqli_fetch_array($contagemPos);
									$aux1 = mysqli_fetch_array($contagemPos1);

									$countDefesas = $aux[0];
									$countMedios = $aux[1];
									$countAvancados = $aux1[0];
									$countGuarda = $aux1[1];

									////////////////////////////////////////////////////////////// TABELA DE POSIÇÕES DE JOGO /////////////////////////////////

									$defesa='Defesa';
									$medio='Medio';
									$avancado='Avancado';
									$guarda='Guarda-redes';
								
									echo "<table name='posicao'>
											<tr>
											 	<th>Posição</th>
											 	<th>Disponibilidade</th>
											 	<th>Adicionar</th>
											 	
										  	</tr>	
										  	<tr>
											 	<td><h>Defesa</h></td>
											 	<td>$countDefesas</td>";

											 	if($countDefesas!=0)
											 		echo '<td><a href="posicoesDesejadas.php?dados='.$cc.'  '.$equipa.'  '.$defesa.'">Adicionar</a></td>';
											 	else
											 		echo "<td>Sem vagas</td>";

										echo "</tr>
										  	<tr>
											 	<td><h>Avançado</h></td>
											 	<td>$countAvancados</td>";

											 	if($countAvancados!=0)
											 		echo '<td><a href="posicoesDesejadas.php?dados='.$cc.'  '.$equipa.'  '.$avancado.'">Adicionar</a></td>';
											 	else
											 		echo "<td>Sem vagas</td>";
										  	
									    echo "</tr>
										  	<tr>
											 	<td><h>Médio</h></td>
											 	<td>$countMedios</td>";

											 	if($countMedios!=0)
													echo '<td><a href="posicoesDesejadas.php?dados='.$cc.'  '.$equipa.'  '.$medio.'">Adicionar</a></td>';
												else
													echo "<td>Sem vagas</td>";
									
										echo "</tr>
										  	<tr>
										  		<td><h>Guarda-redes</h></td>
											 	<td>$countGuarda</td>";

											 	if($countGuarda!=0)
											 		echo '<td><a href="posicoesDesejadas.php?dados='.$cc.'  '.$equipa.'  '.$guarda.'">Adicionar</a></td>';
											 	else
											 		echo "<td>Sem vagas</td>";

										echo "</tr>
										
										</table>";

									echo "</form>";

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