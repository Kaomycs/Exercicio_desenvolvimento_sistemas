<?php
//process.php
if ($_SERVER["REQUEST_METHOD"] == "POST") //verifica de veio do formulario
	
	if ($turma < 10000){
  $turma = 10000
  }

	$descricao = filter_var($_POST["descricao"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$vagas = filter_var($_POST["vagas"], FILTER_SANITIZE_STRING);
	$professor = filter_var($_POST["professor"], FILTER_SANITIZE_STRING);

	if (empty($descricao)){
		die("Erro: Descrição não informada.");
	}
	if (empty($vaga){
		die("Erro: Número de vagas não informado.");
	}
		
	if (empty($professor)){
		die("Erro: Professor responsável não informado.");
	}	

	print "Obrigada por se cadastrar!";
	print "Verifique as informações listadas abaixo:";
	print "Número da Turma: " . $turma;
	print "Descrição: " . $descricao;
	print "Número de Vagas: " . $vagas;
	print "Professor Responsável: " . $professor;
	
	$turma = $turma++
	    
	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
	
	$statement = $mysqli->prepare("INSERT INTO users_data (turma, descricao, vagas, professor) VALUES(s, s, s, s)");
	$statement->bind_param('sss', $turma, $descricao, $vagas, $professor); 
	
	if($statement->execute()){
		print "A turma " . $turma . "!, foi cadastrada com sucesso!";
	}else{
		print $mysqli->error; //show mysql error if any
	}
}
?>
