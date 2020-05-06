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
			$posicao=$result[2];

			$cap=$connection->query("SELECT equipas.CC
										FROM equipas
										WHERE equipas.Nome_equipa LIKE '".$equipa."'");

			$capitao=mysqli_fetch_row($cap);

			$num=rand(1,10000);

			$connection->query("INSERT INTO `posicoes desejadas`(`Posicao`, `CC`) VALUES ('".$posicao."','".$cc."')");
			
			if($connection->query("INSERT INTO `notifica`(`CC_autor`, `CC`, `id_notificacao`, `Lida`) VALUES ('".$cc."', '".$capitao[0]."', '".$num."', 0)")){
				$connection->query("INSERT INTO `notificacoes`(`id_notificacao`, `Texto`, `Data`) VALUES ('".$num."','".$equipa."',NOW())");
			}
			

			header('Location: juntarEquipa.php');

			$connection->close();

		}
	}catch(Exception $e){
		echo '<span style="color:red;">Server error! Try later</span>';
		echo '<br />Developer info: '.$e;
	}

?>