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
				<div class="3u" style="width:400px;">		
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

			 	<div>
					<div class="tab">
					    <?php
					    	session_start();
					    	
							echo "<button class='tablinks' onclick=\"openTable(event, 'Jogos')\"><strong>Jogos da equipa</strong></button>";
							echo "<button class='tablinks' onclick=\"openTable(event, 'Jogadores')\"><strong>Estatísticas de jogadores</strong></button>";
							echo "<button class='tablinks' onclick=\"openTable(event, 'Adicionar')\"><strong>Pedidos de adesão</strong></button>";
							echo "<button class='tablinks' onclick=\"openTable(event, 'Reservas')\"><strong>Reservas do torneio</strong></button>";
							echo "<button class='tablinks' onclick=\"openTable(event, 'Historico')\"><strong>Jogos passados</strong></button>";
						?>
				    </div>

					<?php	
						require_once "connect_db.php";
						mysqli_report(MYSQLI_REPORT_STRICT);
						try{
							$connection = new mysqli($host, $db_user, $db_password, $db_name);
							if ($connection->connect_errno != 0){
								throw new Exception(mysqli_connect_errno());
							}
							else{
								$dados=$_GET['nomeEquipa'];
								$result=explode('  ', $dados);
								$equipa=$result[0];
								$torneio=$result[1];
								///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////////// ECRA JOGOS ////////////////////////////////////////

								echo "<div id='Jogos' class='tabcontent' style='display:block;'>";	
							        echo "<table id='tabelaJogos' name='tabelaJogos'>
							        		<tr> 
							        			<th colspan='13' style='text-align:center;'>$equipa</th>
							        		</tr>
							                <tr>  
							                	<th>ID jogo</th> 					                	
							                	<th>Dia</th> 					                	
							                    <th>Data</th>
							                    <th>Campo</th>
							                    <th>Morada</th>
							                    <th>GPS</th>
							                    <th>Custo</th>
							                    <th>Hora</th>
							                    <th>Adversário</th>
							                    <th>Golos Equipa</th>
							                    <th>Golos Adversário</th>
							                    <th>Pontuação</th>
							                    <th>Detalhes</th>
							                </tr>";

							          	$jogos=$connection->query("SELECT jogos.id_jogo, jogos.Nome_torneio, slot.Dia_semana, jogos.Data, slot.Nome_campo, campos.Rua, campos.Numero, campos.Cidade, campos.GPS, campos.Custo, slot.Hora_inicio, jogos.Nome_equipa_visitada, jogos.Golos_visitantes, jogos.Golos_visitados
							          							FROM jogos, slot, campos
							          							WHERE slot.id_slot LIKE jogos.id_slot AND jogos.Data >= NOW()
							          							AND jogos.Nome_equipa_visitante LIKE '".$equipa."' 
							          							AND slot.Nome_campo LIKE campos.Nome_campo  

							          							UNION

							          							SELECT jogos.id_jogo, jogos.Nome_torneio, slot.Dia_semana, jogos.Data, slot.Nome_campo, campos.Rua, campos.Numero, campos.Cidade, campos.GPS, campos.Custo, slot.Hora_inicio, jogos.Nome_equipa_visitante, jogos.Golos_visitados, jogos.Golos_visitantes
							          							FROM jogos, slot, campos
							          							WHERE slot.id_slot LIKE jogos.id_slot AND jogos.Data >= NOW()
							          							AND jogos.Nome_equipa_visitada LIKE '".$equipa."' 
							          							AND slot.Nome_campo LIKE campos.Nome_campo");

							          	
							          	while($aux=mysqli_fetch_array($jogos)){
							          		echo "<tr>
							          				
							          				<td>".$aux[0]."</td>
							          				<td>".$aux[2]."</td>
							          				<td>".$aux[3]."</td>
							          				<td>".$aux[4]."</td>
							          				<td>".$aux[5]." ".$aux[6].", ".$aux[7]."</td>
							          				<td>".$aux[8]."</td>
							          				<td>".$aux[9]."</td>
							          				<td>".$aux[10]."</td>
							          				<td>".$aux[11]."</td>";

							          				if($aux[12]==null){
							          					echo "<td>-</td>";
							          				}
							          				else{
							          					echo "<td style='text-align:center;'>".$aux[12]."</td>";
							          				}

							          				if($aux[13]==null){
							          					echo "<td>-</td>";
							          				}
							          				else{
							          					echo "<td style='text-align:center;'>".$aux[13]."</td>";
							          				}
							          			echo '<td><input type="button" value=">" onclick="location.href=\'editaPontuacao.php?editaPontuacao='.$aux[0].'  '.$aux[1].'  '.$equipa.'  '.$aux[11].'\'"></td>';
							          			echo '<td><input type="button" value=">" onclick="location.href=\'gestaoEquipas2.php?ID='.$aux[0].'  '.$equipa.'\'"></td>';
							          				
							          		echo '</tr>';
							          	}
								        	
								    echo '</table>'; 

								    ////////////////////////// ESTATÍSTICAS DA EQUIPA ////////////////////////////

								    $pontos=$connection->query("SELECT COUNT(*), (SELECT COUNT(*)
												    							FROM jogos 
												    							WHERE jogos.Nome_equipa_visitante LIKE '".$equipa."' AND jogos.Golos_visitantes < jogos.Golos_visitados
												    							OR jogos.Nome_equipa_visitada LIKE '".$equipa."' AND jogos.Golos_visitados < jogos.Golos_visitantes)
								    							FROM jogos 
								    							WHERE jogos.Nome_equipa_visitante LIKE '".$equipa."' AND jogos.Golos_visitantes > jogos.Golos_visitados
								    							OR jogos.Nome_equipa_visitada LIKE '".$equipa."' AND jogos.Golos_visitados > jogos.Golos_visitantes");

								    $pontos1=$connection->query("SELECT COUNT(*)
								    							FROM jogos 
								    							WHERE jogos.Nome_equipa_visitante LIKE '".$equipa."' AND jogos.Golos_visitantes = jogos.Golos_visitados
								    							OR jogos.Nome_equipa_visitada LIKE '".$equipa."' AND jogos.Golos_visitados = jogos.Golos_visitantes");
								    
								    $aux=mysqli_fetch_array($pontos);
								    $aux1=mysqli_fetch_row($pontos1);

									echo "<h><strong>Número de vitórias: ".$aux[0]."</strong></h><br>";
									echo "<h><strong>Número de derrotas: ".$aux[1]."</strong></h><br>";
									echo "<h><strong>Número de empates: ".$aux1[0]."</strong></h><br><br>";
									
								echo "</div>";
								
								///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////////// ECRÃ JOGADORES ////////////////////////////////////////
							   
							    echo "<table id='Jogadores' class='tabcontent'> 
						        		<tr> 
						        			<th colspan='6' style='text-align:center;'>$equipa</th>
						        		</tr>
						                <tr> 
											<th>CC</th>
						                    <th>Nome</th>
						                    <th>Total golos marcados</th>
						                    <th>Total faltas</th>
						                    <th>Ações</th>
						                    
						                </tr>";

						            $somaGolos=$connection->query("SELECT DISTINCT SUM(jogadores_jogo.Golos_marcados)
																							  FROM jogadores_jogo
																							  WHERE jogadores_jogo.Nome_equipa LIKE '".$equipa."'
																							  GROUP BY jogadores_jogo.CC");
						            $aux2=mysqli_fetch_row($somaGolos);

						            if($aux2>0){
						            	$jogadores=$connection->query("SELECT DISTINCT jogadores.CC, utilizadores.Primeiro_nome, utilizadores.Ultimo_nome, golos.conta, jogadores.Numero_falhas
																FROM utilizadores, jogadores_jogo, jogadores, (SELECT jogadores_jogo.CC, SUM(jogadores_jogo.Golos_marcados) conta
																							  FROM jogadores_jogo
																							  WHERE jogadores_jogo.Nome_equipa LIKE '".$equipa."'
																							  GROUP BY jogadores_jogo.CC) as golos
																WHERE jogadores.CC LIKE golos.CC
																AND utilizadores.CC LIKE golos.CC
																AND jogadores.CC LIKE utilizadores.CC
																AND jogadores_jogo.Nome_equipa LIKE '".$equipa."'"); 

						            }

						            else{
						            	$jogadores=$connection->query("SELECT DISTINCT jogadores.CC, utilizadores.Primeiro_nome, utilizadores.Ultimo_nome, '0', jogadores.Numero_falhas
																FROM utilizadores, jogadores, `equipas jogadores`
																WHERE utilizadores.CC LIKE jogadores.CC AND utilizadores.CC LIKE `equipas jogadores`.CC AND `equipas jogadores`.Nome_equipa LIKE '".$equipa."'"); 
						            }
							        
							        while($aux1=mysqli_fetch_array($jogadores)){
						          		echo '<tr>
						          				<td>'.$aux1[0].'</td>
						          				<td>'.$aux1[1].' '.$aux1[2].'</td>
						          				<td style="text-align:center;">'.$aux1[3].'</td>
						          				<td style="text-align:center;">'.$aux1[4].'</td>
						          				<td><input type="button" value=">" onclick="location.href=\'notificar.php?dados='.$aux1[0].'  '.$aux1[1].'  '.$aux1[2].'  '.$equipa.'\'"></td>
						          			 </tr>';
						          	}

							    echo '</table>';

							    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////////// ECRÃ ADICIONAR JOGADORES ////////////////////////////////////////

							    echo "<table id='Adicionar' class='tabcontent'> ";
							    echo "<tr> 
					        			<th colspan='6' style='text-align:center;'>Pedidos</th>
					        		</tr>
					                <tr> 
										<th>CC</th>
					                    <th>Nome</th>
					                    <th>Posições desejadas</th>
					                    <th>Adicionar a equipa</th>
					                    <th>Adicionar a jogos</th>
					                    <th>Eliminar pedido</th>
					                </tr>";

					                $pedidos=$connection->query("SELECT notifica.CC_autor, utilizadores.Primeiro_nome, utilizadores.Ultimo_nome, notificacoes.texto, notifica.id_notificacao, `posicoes desejadas`.Posicao
					                							FROM notifica, utilizadores, notificacoes, `posicoes desejadas`
					                							WHERE notifica.id_notificacao=notificacoes.id_notificacao 
					                							AND notificacoes.texto LIKE '".$equipa."' 
					                							AND notifica.CC_autor LIKE utilizadores.CC
					                							AND `posicoes desejadas`.CC LIKE notifica.CC_autor");

					                $contaJogos=$connection->query("SELECT COUNT(*)
																FROM jogos
																WHERE jogos.Nome_equipa_visitada LIKE '".$equipa."' OR jogos.Nome_equipa_visitante LIKE '".$equipa."'");

									$conta=mysqli_fetch_row($contaJogos);
									
					                while($aux2=mysqli_fetch_array($pedidos)){

					                	echo '<tr>
						          				<td>'.$aux2[0].'</td>
						          				<td>'.$aux2[1].' '.$aux2[2].'</td>
						          				<td style="text-align:center;">'.$aux2[5].'</td>
						          				<td style="text-align:center;"><input type="button" value="+" onclick="location.href=\'adicionarJogador.php?dados='.$aux2[0].'  '.$aux2[1].'  '.$aux2[2].'  '.$aux2[3].'  '.$aux2[4].'  '.$aux2[5].'\'"></td>';

						          		if($conta[0]>0){
							          		echo '<td style="text-align:center;"><input type="button" value="+" onclick="location.href=\'adicionarJogadorJogo.php?dados='.$aux2[0].'  '.$aux2[1].'  '.$aux2[2].'  '.$aux2[3].'  '.$aux2[4].'  '.$aux2[5].'\'"></td>';
						          		}
						          		else{
						          			echo '<td style="text-align:center;">Sem jogos</td>';
						          		}

						          		echo '<td style="text-align:center;"><input type="button" value="-" onclick="location.href=\'removerPedido.php?dados='.$aux2[0].'  '.$aux2[4].'\'"></td>
							          			 </tr>';
					                }


							    echo "</table>";

							    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////////// ECRÃ RESERVAS ////////////////////////////////////////

							    echo "<table id='Reservas' class='tabcontent'>";
							    echo "<tr> 
										<th>CC</th>
					                    <th>Nome</th>
					                    <th>Adicionar</th>
					                </tr>";

					                $reservas=$connection->query("SELECT `reservas torneios`.CC, utilizadores.Primeiro_nome, utilizadores.Ultimo_nome, `reservas torneios`.Nome_torneio 
					                							FROM `reservas torneios`, utilizadores
					                							WHERE `reservas torneios`.CC LIKE utilizadores.CC
					                							AND `reservas torneios`.Nome_torneio LIKE '".$torneio."'");

					                while($aux3=mysqli_fetch_array($reservas)){
					                	echo '<tr>
						          				<td>'.$aux3[0].'</td>
						          				<td>'.$aux3[1].' '.$aux3[2].'</td>';

						          		echo '<td style="text-align:center;"><input type="button" value=">" onclick="location.href=\'adicionarReserva_1.php?dados='.$aux3[0].'  '.$equipa.'\'"></td>';
						          		
						          		echo '</tr>';
					                }

							    echo "</table>";

							    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								///////////////////////////////////////////////////////////////////////////// HISTÓRICO DE JOGOS ////////////////////////////////////////

								echo "<div id='Historico' class='tabcontent'>";	
							        echo "<table id='historico' name='historico'>
							        		<tr> 
							        			<th colspan='13' style='text-align:center;'>$equipa</th>
							        		</tr>
							                <tr>  
							                	<th>ID jogo</th> 					                	
							                	<th>Dia</th> 					                	
							                    <th>Data</th>
							                    <th>Campo</th>
							                    <th>Morada</th>
							                    <th>GPS</th>
							                    <th>Custo</th>
							                    <th>Hora</th>
							                    <th>Adversário</th>
							                    <th>Golos Equipa</th>
							                    <th>Golos Adversário</th>
							                    <th>Pontuação</th>
							                    <th>Detalhes</th>
							                </tr>";

							          	$jogos=$connection->query("SELECT jogos.id_jogo, jogos.Nome_torneio, slot.Dia_semana, jogos.Data, slot.Nome_campo, campos.Rua, campos.Numero, campos.Cidade, campos.GPS, campos.Custo, slot.Hora_inicio, jogos.Nome_equipa_visitada, jogos.Golos_visitantes, jogos.Golos_visitados
							          							FROM jogos, slot, campos
							          							WHERE slot.id_slot LIKE jogos.id_slot AND jogos.Data < NOW() 
							          							AND jogos.Nome_equipa_visitante LIKE '".$equipa."' 
							          							AND slot.Nome_campo LIKE campos.Nome_campo  

							          							UNION

							          							SELECT jogos.id_jogo, jogos.Nome_torneio, slot.Dia_semana, jogos.Data, slot.Nome_campo, campos.Rua, campos.Numero, campos.Cidade, campos.GPS, campos.Custo, slot.Hora_inicio, jogos.Nome_equipa_visitante, jogos.Golos_visitados, jogos.Golos_visitantes
							          							FROM jogos, slot, campos
							          							WHERE slot.id_slot LIKE jogos.id_slot AND jogos.Data < NOW() 
							          							AND jogos.Nome_equipa_visitada LIKE '".$equipa."' 
							          							AND slot.Nome_campo LIKE campos.Nome_campo");

							          	
							          	while($aux=mysqli_fetch_array($jogos)){
							          		echo "<tr>
							          				
							          				<td>".$aux[0]."</td>
							          				<td>".$aux[2]."</td>
							          				<td>".$aux[3]."</td>
							          				<td>".$aux[4]."</td>
							          				<td>".$aux[5]." ".$aux[6].", ".$aux[7]."</td>
							          				<td>".$aux[8]."</td>
							          				<td>".$aux[9]."</td>
							          				<td>".$aux[10]."</td>
							          				<td>".$aux[11]."</td>";

							          				if($aux[12]==null){
							          					echo "<td>-</td>";
							          				}
							          				else{
							          					echo "<td style='text-align:center;'>".$aux[12]."</td>";
							          				}

							          				if($aux[13]==null){
							          					echo "<td>-</td>";
							          				}
							          				else{
							          					echo "<td style='text-align:center;'>".$aux[13]."</td>";
							          				}
							          			echo '<td><input type="button" value=">" onclick="location.href=\'editaPontuacao.php?editaPontuacao='.$aux[0].'  '.$aux[1].'  '.$equipa.'  '.$aux[11].'\'"></td>';
							          			echo '<td><input type="button" value=">" onclick="location.href=\'gestaoEquipas2.php?ID='.$aux[0].'  '.$equipa.'\'"></td>';
							          				
							          		echo '</tr>';
							          	}
								        	
								    echo '</table>'; 

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