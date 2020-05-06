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
				<div class="3u" style="width:200px;">		
					<section class="sidebar">
						<ul class="default" style="padding-left: 40px;">
							<li><a href="criarEquipa.php"><strong>Criar Nova Equipa</a></strong></li>
							<li><strong style="color:red;">Gestão de Equipas</strong></li>
							<li><a href="juntarEquipa.php"><strong>Juntar-se a Equipa</a></strong></li>
							<li><a href="listaEquipas.php"><strong>Lista de Equipas</a></strong></li>
							<li><a href="espacoJogador.php"><strong>Espaço de jogador</a></strong></li>
						</ul>				
					</section>	
				</div>

			 	<div>
					<div class="tab">
					    <?php
					    	session_start();
					    	require_once "connect_db.php";

					    	$result=$_GET['ID'];
					    	$aux=explode('  ', $result);
					    	$id_jogo=$aux[0];
					    	$equipa=$aux[1];

							try{
								$connection = new mysqli($host, $db_user, $db_password, $db_name);
								if ($connection->connect_errno != 0){
									throw new Exception(mysqli_connect_errno());
								}
								else{

									$jogadores=$connection->query("SELECT jogadores.CC, utilizadores.Primeiro_nome, utilizadores.Ultimo_nome, jogadores_jogo.Posicao, jogadores_jogo.Suplente, jogadores.Prioridade_conv, jogadores_jogo.Golos_marcados, jogadores.Numero_falhas, jogadores.Saldo, jogadores_jogo.Nome_torneio, jogadores_jogo.Pediu_subs
																FROM jogadores_jogo, jogadores, utilizadores
																WHERE jogadores_jogo.id_jogo='".$id_jogo."' AND jogadores_jogo.Nome_equipa LIKE '".$equipa."' AND jogadores.CC LIKE jogadores_jogo.CC AND jogadores.CC LIKE utilizadores.CC");
								
							        echo "<table id='tabelaJogos' name='tabelaJogos'>
							        		<tr> 
							        			<th colspan='13' style='text-align:center;'>Jogo $result</th>
							        		</tr>
							                <tr>  
							                	<th>CC</th>
							                	<th>Nome</th> 					                	
							                    <th>Posição</th> 
							                	<th>Estatuto</th> 					                	
							                    <th>Prioridade</th>
							                    <th>Golos marcados</th>
							                    <th>Faltou</th>
							                    <th>Saldo</th>
							                    <th>Pediu substituição</th>
							                    <th style='text-align:center;'>Editar</th>
							                    <th style='text-align:center;'>Substituir</th>
							                </tr>";

							                while($aux1=mysqli_fetch_array($jogadores)){
							          			echo "<tr>
							          					<td>".$aux1[0]."</td>
							          					<td>".$aux1[1]." ".$aux1[2]."</td>
								          				<td>".$aux1[3]."</td>";
								          				if($aux1[4]==1){
								          					echo "<td>Suplente</td>";
								          				}
								          				else{
								          					echo "<td>Titular</td>";
								          				}
								          			echo "<td style='text-align:center;'>".$aux1[5]."</td>
								          				<td style='text-align:center;'>".$aux1[6]."</td>
								          				<td style='text-align:center;'>".$aux1[7]."</td>
								          				<td style='text-align:center;'>".$aux1[8]."</td>
								          				<td style='text-align:center;'>".$aux1[10]."</td>";
								          			echo "<td style='text-align:center;'><input type='button' value='>' onclick='location.href=\"gestaoEquipas3.php?dados=".$id_jogo."  ".$equipa."  ".$aux1[1]."  ".$aux1[2]."  ".$aux1[3]."  ".$aux1[4]."  ".$aux1[5]."  ".$aux1[7]."  ".$aux1[8]."  ".$aux1[0]."  ".$aux1[9]."\"'></td>";

								          			echo "<td style='text-align:center;'><input type='button' value='>' onclick='location.href=\"verReservas.php?dados=".$id_jogo."  ".$aux1[0]."  ".$equipa."  ".$aux1[3]."  ".$aux1[4]."  ".$aux1[5]."  ".$aux1[9]."\"'></td>";
								          			echo "</tr>";
								          	}

							        echo "</table>";
							        
								}
							}catch(Exception $e){
								echo '<span style="color:red;">Server error! Try later</span>';
								echo '<br />Developer info: '.$e;
							}

						?>
						
				    </div>	    
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