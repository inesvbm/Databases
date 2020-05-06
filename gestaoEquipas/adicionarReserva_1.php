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
			$equipa=$result[1];

			$connection->query("INSERT INTO `equipas jogadores`(`Nome_equipa`, `CC`) VALUES ('".$equipa."','".$cc."')");
			$connection->query("INSERT INTO `jogadores`(`CC`, `Prioridade_conv`, `Numero_falhas`, `Saldo`) VALUES ('".$cc."','-',0,20)");

			$adicionaJogadorJogos=$connection->query("SELECT DISTINCT jogadores_jogo.id_jogo, jogadores_jogo.Nome_torneio
									FROM jogadores_jogo
									WHERE jogadores_jogo.Nome_equipa LIKE '".$equipa."'");

			while($add=mysqli_fetch_array($adicionaJogadorJogos)){
				$connection->query("INSERT INTO `jogadores_jogo`(`id_jogo`, `Nome_torneio`, `CC`, `Nome_equipa`, `Posicao`, `Suplente`, `Golos_marcados`) VALUES ('".$add[0]."', '".$add[1]."', '".$cc."', '".$equipa."','-',0,0)");
			}

			$connection->query("DELETE FROM reservas
							WHERE reservas.CC LIKE '".$cc."'");

			$connection->query("DELETE FROM `reservas torneios`
							WHERE `reservas torneios`.CC LIKE '".$cc."'");
			

			//header('Location: gestaoEquipas.php');

			$connection->close();

		}
	}catch(Exception $e){
		echo '<span style="color:red;">Server error! Try later</span>';
		echo '<br />Developer info: '.$e;
	}

?>