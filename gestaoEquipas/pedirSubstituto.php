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
			$id_jogo=$result[2];

			$substituto='Substituto';

			echo "<h>$cc</h><br>";
			echo "<h>$equipa</h><br>";
			echo "<h>$id_jogo</h><br>";

			$connection->query("UPDATE jogadores_jogo
								SET jogadores_jogo.Pediu_subs=1 
								WHERE jogadores_jogo.id_jogo='".$id_jogo."' AND jogadores_jogo.CC LIKE '".$cc."' AND jogadores_jogo.Nome_equipa LIKE '".$equipa."'");
		
			//header('Location: espacoJogador.php');

			$connection->close();

		}
	}catch(Exception $e){
		echo '<span style="color:red;">Server error! Try later</span>';
		echo '<br />Developer info: '.$e;
	}

?>