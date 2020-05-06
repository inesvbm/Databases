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
				<div class="3u">		
					<section class="sidebar">
						<!--<header style="padding-left: 50px;">
							<h2>Nulla eleifend</h2>
						</header> -->
						<ul class="default" style="padding-left: 40px;">
							<li><a href="criarEquipa.php"><strong>Criar Nova Equipa</a></strong></li>
							<li><a href="gestaoEquipas.php"><strong>Gestão de Equipas</a></strong></li>
							<li><a href="juntarEquipa.php"><strong>Juntar-se a Equipa</a></strong></li>
							<li><a href="#"><strong style="color:red;">Lista de Equipas</a></strong></li>
							<li><a href="espacoJogador.php"><strong>Espaço de jogador</a></strong></li>
						</ul>				
					</section>	
				</div>

				<div>


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

								///////////////////////////////////////////////////////////////////// BOTÕES DE SELEÇÃO DE TABELAS /////////////////////////////
								
								$totalTorneios=$connection->query("SELECT COUNT(torneios.Nome_torneio) FROM torneios");
								$aux = mysqli_fetch_row($totalTorneios);
								$count_torneios = $aux[0];

								$Todas="Todas";
								echo "<div class='tab'>
										<button class='tablinks' onclick=\"openTable(event, '$Todas')\"><strong>$Todas</strong></button>";

										$nomeTorneio=$connection->query("SELECT torneios.Nome_torneio FROM torneios");

										while($torneio=mysqli_fetch_array($nomeTorneio)){
											$n=$torneio[0];
											echo "<button class='tablinks' onclick=\"openTable(event, '$n')\"><strong>$n</strong></button>";
										}
							
							    echo "</div>";

							    ///////////////////////////////////////////////////////////////////// TABELA COM TODAS AS EQUIPAS, SEM FILTRO POR TORNEIO /////////////

						        echo "<table id='$Todas' class='tabcontent' style='display:block;'> 
						                <tr>     
						                    <th>Nome da equipa</th>
						                    <th>Torneio</th> 
						                    <th>Capitão</th>
						                    <th>Disponibilidade</th>
						                </tr>";
				              
						            $totalEquipas=$connection->query("SELECT COUNT(equipas.Nome_equipa) FROM equipas");
									$aux1 = mysqli_fetch_row($totalEquipas);
									$count_equipas = $aux1[0];

									$nomeEquipas=$connection->query("SELECT equipas.Nome_equipa, equipas.Nome_torneio, utilizadores.Primeiro_nome, utilizadores.Ultimo_nome, COALESCE(disponibilidade.conta, 16) 'Disponibilidade'
																	 FROM utilizadores, equipas LEFT JOIN (
																		SELECT `equipas jogadores`.Nome_equipa, 16-COUNT(*) 'conta'
    																	FROM `equipas jogadores`
    																	GROUP BY Nome_equipa) as disponibilidade
																	 ON equipas.Nome_equipa LIKE disponibilidade.Nome_equipa
																	 WHERE utilizadores.CC LIKE equipas.CC
																	 ORDER BY equipas.Nome_equipa");
  
							        while($equipa = mysqli_fetch_array($nomeEquipas)){	
										echo '<tr>
								            	<td>'.$equipa[0].'</td>	
								            	<td>'.$equipa[1].'</td>	
								            	<td>'.$equipa[2].' '.$equipa[3].'</td>
								            	<td style="text-align:center;">'.$equipa[4].'</td>									            	          	
								         	</tr>';
							        }
							        
							    echo '</table>'; 

							    ///////////////////////////////////////////////////////////////////// TABELAS DE EQUIPAS FILTRADAS POR TORNEIO /////////////////////////////

							    $nomeTorneio1=$connection->query("SELECT torneios.Nome_torneio FROM torneios");
								while($torneio1=mysqli_fetch_array($nomeTorneio1)){									
									$n=$torneio1[0];
									echo "<table id='$n' class='tabcontent'> 
						                <tr>    
						                    <th>Nome da equipa</th>
						                    <th>Torneio</th> 
						                    <th>Capitão</th>
						                    <th>Disponibilidade</th>
						                </tr>";

									$nomeEquipas2=$connection->query("SELECT equipas.Nome_equipa, equipas.Nome_torneio, utilizadores.Primeiro_nome, utilizadores.Ultimo_nome, COALESCE(disponibilidade.conta, 16) 'Disponibilidade'
																	 FROM utilizadores, equipas LEFT JOIN (
																		SELECT `equipas jogadores`.Nome_equipa, 16-COUNT(*) 'conta'
    																	FROM `equipas jogadores`
    																	GROUP BY Nome_equipa) as disponibilidade
																	 ON equipas.Nome_equipa LIKE disponibilidade.Nome_equipa
																	 WHERE equipas.Nome_torneio LIKE '".$n."' AND utilizadores.CC LIKE equipas.CC
																	 ORDER BY equipas.Nome_equipa");

							        while($equipa1=mysqli_fetch_array($nomeEquipas2)){
							        	echo '<tr>
									            <td>'.$equipa1[0].'</td>
									            <td>'.$equipa1[1].'</td>
									            <td>'.$equipa1[2].' '.$equipa1[3].'</td>
								            	<td style="text-align:center;">'.$equipa1[4].'</td>									          									      
									          </tr>'; 
							        }
								}

								echo "</table>";
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