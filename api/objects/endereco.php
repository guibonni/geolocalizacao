<?php

/**
 * Essa classe contém as funções relacionadas à obtenção de endereço
 *
 * @author Gui Castro <gui.bonni@gmail.com> github.com/guibonni
 */

include_once '../config/config.php';

class Endereco {

	// Atributos
	private $latitude;
	private $longitude;

	public function __construct($lat, $lon) {
		
		$this->latitude = $lat;
		
		$this->longitude = $lon;

	}

	public function buscar() {

		// TODO - Procurar o endereço solicitado no cache
		$endereco = false;

		// Caso não seja encontrado no cache, chamar a api do nominatim
		if (!$endereco) {
			
			// Criando um contexto para mudar o User-Agent da chamada, se não o nominatim não aceita a requisição
			$context = stream_context_create(
			    array(
			        "http" => array(
			            "header" => "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36"
			        )
			    )
			);

			$search = json_decode(file_get_contents("https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=".$this->latitude."&lon=".$this->longitude."&addressdetails=1", false, $context), true);

			if (array_key_exists("address", $search)) {
				
				$endereco = array(
					"cep"    		 => array_key_exists("postcode", $search["address"]) ? $search["address"]["postcode"] : "",
					"nome"   		 => array_key_exists("recycling", $search["address"]) ? $search["address"]["recycling"] : "",
					"numero" 		 => array_key_exists("house_number", $search["address"]) ? $search["address"]["house_number"] : "",
					"logradouro" => array_key_exists("road", $search["address"]) ? $search["address"]["road"] : "",
					"bairro" 		 => array_key_exists("suburb", $search["address"]) ? $search["address"]["suburb"] : "",
					"cidade" 		 => array_key_exists("city", $search["address"]) ? $search["address"]["city"] : "",
					"regiao" 		 => array_key_exists("county", $search["address"]) ? $search["address"]["county"] : "",
					"estado" 		 => array_key_exists("state", $search["address"]) ? $search["address"]["state"] : "",
					"pais"   		 => array_key_exists("country", $search["address"]) ? $search["address"]["country"] : ""
				);

				// TODO - Salvar no cache

			} else {

				$endereco = false;

			}

		}

		return $endereco;

	}

}
?>