<!--
tags html fora do bloco php:

enctype: tipo de informação a ser enviada pelo formulário
         por padrão, um formulário envia textos/strings
multipart/form-data: será como dados binários.
-->
<form method="POST" enctype="multipart/form-data">

	<input type="file" name="fileUpload">
	
	<button type="submit">Send</button>

</form>

<?php

//Verifica se o tipo de solicitação é o método 'POST':
//array/variável pré-definida nativa super global '$_SERVER':
if($_SERVER["REQUEST_METHOD"] === "POST"){
	
	//Variável receberá informações do arquivo a ser feito upload
	//como, nome, tamanho, se ouve êrros no upload, nome temporário, etc...
	//através do array/variável nativa super global '$_FILES':
	$file = $_FILES["fileUpload"];
	
	//Se ouve êrro no upload, será tratado com uma exceção:
	if($file["error"]){
		//A mensagem do êrro estará na chave 'error' acima,
		//que está dentro do 'throw' para ser exibido:
		throw new Exception("Error: ".$file["error"]);
		
	}
	
	//Diretório que irá receber os uploads:
	$dirUploads = "uploads";
	
	//Se não existir este diretório,
	//irá criá-lo:
	if(!is_dir($dirUploads)){
		
		mkdir($dirUploads);
	}
	
	//função nativa do php que fará o upload própriamente dito:
	//Se der tudo certo, essa função retorna 'true':
	//Parâmetros: Origem: Caminho e nome temporário do arquivo- Propriedade 'tmp_name'.
	//            Destino: Pasta e nome original do arquivo- Propriedade 'name'.
	if(move_uploaded_file($file["tmp_name"], $dirUploads . DIRECTORY_SEPARATOR . $file["name"])){
		
		echo "Upload realizado com sucesso.";
		
	} else {
		
		throw new Exception("Não foi possível realizar o upload.");
	}
	
}

?>