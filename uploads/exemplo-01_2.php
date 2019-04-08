<?php

$filename = "usuarios.csv";

if(file_exists($filename)){
	
	$file = fopen($filename, "r");
	
	$headers = explode(",", fgets($file));
	
	$data = array();
	
	//$linha = array();
	
	while($rom = fgets($file)){
		
		$rowData = explode(",", $rom);
		
		$linha = array();
		
		for($i=0; $i<count($headers); $i++){
			
			$linha[$headers[$i]] = $rowData[$i];
			
		}
		//Cada linha que é 'processada' no 'while' acima, vai sendo
		//acumulada/transferida para o array '$data'.
		array_push($data, $linha);
		
	}
	
	fclose($file);
	
	echo json_encode($data);
}



?>
