<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/endereco.php';

$endereco = new Endereco($_REQUEST['lat'], $_REQUEST['lon']);

$resultado = $endereco->buscar();

if ($resultado) {
	
	http_response_code(200);

	echo json_encode($resultado);

} else {
	
	http_response_code(404);

	echo json_encode(array("mensagem" => "Endereço não encontrado."));

}

?>