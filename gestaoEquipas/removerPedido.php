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
			$id_notif=$result[1];

			$connection->query("DELETE FROM notificacoes
							WHERE notificacoes.id_notificacao LIKE '".$id_notif."'");

			$connection->query("DELETE FROM notifica
							WHERE notifica.id_notificacao LIKE '".$id_notif."'");

			$connection->query("DELETE FROM `posicoes desejadas`
							WHERE `posicoes desejadas`.CC LIKE '".$cc."'");

			$connection->close();

		}
	}catch(Exception $e){
		echo '<span style="color:red;">Server error! Try later</span>';
		echo '<br />Developer info: '.$e;
	}

?>