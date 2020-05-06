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
			$nome=$result[1].' '.$result[2];
			$equipa=$result[3];
			$id_notif=$result[4];
			$posicao=$result[5];

			$add=$connection->query("SELECT equipas.CC
										FROM equipas
										WHERE equipas.Nome_equipa LIKE '".$equipa."'");

			$novo=mysqli_fetch_row($add);

			$connection->query("INSERT INTO `equipas jogadores`(`Nome_equipa`, `CC`) VALUES ('".$equipa."','".$cc."')");
			$connection->query("INSERT INTO `jogadores`(`CC`, `Prioridade_conv`, `Numero_falhas`, `Saldo`) VALUES ('".$cc."',0,0,20)");

			$connection->close();

		}
	}catch(Exception $e){
		echo '<span style="color:red;">Server error! Try later</span>';
		echo '<br />Developer info: '.$e;
	}

?>