<?php
$servername = "localhost";
$db_username = "";
$db_password = "";
$db_name = "clinica_upm";

$DNI = $_POST['usr'];
$password = $_POST['passwd']

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("No se pudo conectar a la base de datos: " . $conn->connect_error);
}
$query = "SELECT * FROM usuario WHERE DNI = '$DNI' AND password = '$password'";
$result = conn->query($query) or die("Unable to verify user because " . mysql_error());
$row = mysql_fetch_assoc($result);

if ($row['total'] == 1) {
	$query = "SELECT TIPO_USUARIO FROM usuario WHERE DNI = '$DNI'";
	$result = mysql_query($query) or die("Unable to verify user because " . mysql_error());
	$line = mysql_fetch_array($result, MYSQL_ASSOC);
	if($line[TIPO_USUARIO] == "medico"){
		$response["medico"] = 1;
	}
	elseif ($line[TIPO_USUARIO] == "admin") {
		$response["admin"] = 1;
	}
	else{
		$response["errorTr"] = 1;
	}
    echo json_encode($response);
}


else {

    $response["errorAu"] = 1;

    echo json_encode($response);
}

?>
