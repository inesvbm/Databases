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
			$id_jogo=$result[0];
			$cc=$result[1];
			$equipa=$result[2];
			$posicao=$result[3];
			$titulo=$result[4];
			$prioridade=$result[5];
			$torneio=$result[6];
			$substituto=$result[7];

			$connection->query("DELETE FROM jogadores_jogo 
							WHERE jogadores_jogo.id_jogo='".$id_jogo."' AND jogadores_jogo.CC LIKE '".$cc."' AND jogadores_jogo.Nome_torneio LIKE '".$torneio."' AND jogadores_jogo.Nome_equipa LIKE '".$equipa."'");

			$connection->query("INSERT INTO `jogadores_jogo`(`id_jogo`, `Nome_torneio`, `CC`, `Nome_equipa`, `Posicao`, `Suplente`, `Golos_marcados`) VALUES ('".$id_jogo."', '".$torneio."', '".$substituto."', '".$equipa."','".$posicao."','".$titulo."','')");


			$connection->query("INSERT INTO `jogadores`(`CC`, `Prioridade_conv`, `Numero_falhas`, `Saldo`) VALUES ('".$substituto."','".$prioridade."','','')");

			//header('Location: gestaoEquipas.php');

			$connection->close();

		}
	}catch(Exception $e){
		echo '<span style="color:red;">Server error! Try later</span>';
		echo '<br />Developer info: '.$e;
	}

?>