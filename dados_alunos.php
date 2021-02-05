<?php
//process.php
if ($_SERVER["REQUEST_METHOD"] == "POST") //verifica de veio do formulario
	
	$matricula = 10000

	$nome = filter_var($_POST["nome"], FILTER_SANITIZE_STRING); //set PHP variables like this so we can use them anywhere in code below
	$sexo = filter_var($_POST["sexo"], FILTER_SANITIZE_STRING);
	$data_nasc = filter_var($_POST["data_nasc"], FILTER_SANITIZE_STRING);
	$cidade = filter_var($_POST["cidade"], FILTER_SANITIZE_STRING);
	$bairro = filter_var($_POST["bairro"], FILTER_SANITIZE_STRING);
	$rua = filter_var($_POST["rua"], FILTER_SANITIZE_STRING);
	$numero = filter_var($_POST["numero"], FILTER_SANITIZE_STRING);
	$complemento = filter_var($_POST["complemento"], FILTER_SANITIZE_STRING);

	if (empty($nome)){
		die("Erro: Nome não informado.");
	}
	if (empty($sexo) || !filter_var($sexo, FILTER_VALIDATE_STRING)){
		die("Erro: Sexo não informado.");
	}
		
	if (empty($data_nasc)){
		die("Erro: Data de nascimento não informada.");
	}	
	
	//print output text
	print "Obrigada por se cadastrar " . $nome . "!";
	print "Verifique as informações listadas abaixo:";
	print "Número de Matrícula: " . $matricula;
	print "Nome Completo: " . $nome;
	print "Sexo: " . $sexo;
	print "Data de Nascimento: " . $data_nasc;
	print "Endereço: " . $rua . " número " . $numero;
	print "Bairro " . $bairro . ", cidade de " . $cidade . ". Complemento: " . $complemento;
	
	$matricula = $matricula++

	$mysqli = new mysqli($mysql_host, $mysql_username, $mysql_password, $mysql_database);
	
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}	
	
	$statement = $mysqli->prepare("INSERT INTO users_data (nome, sexo, data_nasc, cidade, bairro, rua, numero, complemento, matricula) VALUES(s, s, s, s, s, s, s, s, s, s)");
	$statement->bind_param('sss', $nome, $sexo, $data_nasc, $cidade, $bairro, $rua, $numero, $complemento, $matricula); 
	
	if($statement->execute()){
		print "Olá " . $nome . "!, seu cadastro foi concluído!";
	}else{
		print $mysqli->error; //show mysql error if any
	}
}
?>
