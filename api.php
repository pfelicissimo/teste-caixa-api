<?php 
	$token = "227d3e9787e8bbccc51542d944a600fa691556420cc304863375feee6a15de0c";
	$headers = getallheaders() ;

	header('Content-Type: application/json');
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
     	$input = json_decode(file_get_contents('php://input'), TRUE); 
     	$continuar = true;
     	$arr = array('sucesso' => true, 'erro' => "");

     	if($input["usuario"] === "usuario@teste.com.br" && 
     		$input["senha"] === "123456"){

     		$arr["data"] = [
     						"nome" => "Pennywise Derry", 
     						"agencia" => "1234",
     						"conta" => "12346-6",
     						"tipo" => "CC",
     						"avatar" => "http://horror.wpengine.netdna-cdn.com/wp-content/uploads/2016/06/1-TC.jpg",
     						"token" => $token
     						];

     	} else{
     		$arr["sucesso"] = false;
     		$arr["erro"] = "Usuário ou senha inválidos tente novamente";
     		$arr["data"] = [];
     	}

		echo json_encode($arr);


	}elseif ($_SERVER['REQUEST_METHOD'] === 'GET') { 

		$arr = array('sucesso' => true, 'erro' => "");

		if(isset($headers['Authorization'])){
		    
		    $autorization = split(" ", $headers['Authorization']);

		    if($autorization[0] !== "Bearer" && $autorization[1] !== $token){
		    	$arr["sucesso"] = false;
	     		$arr["erro"] = "Token expirado ou não enviado, efetue o login novamente";
	     		$arr["data"] = [];
		    }else{

		    	$arr = fill_operations($arr);
		    }

		}else{

			$arr["sucesso"] = false;
     		$arr["erro"] = "Token expirado ou não enviado, efetue o login novamente";
     		$arr["data"] = [];
		}

    	echo json_encode($arr);
	}
	

	function fill_operations($arr){

		$operations = [
			"saldo" => "R$ 15.919,10",
			"operacoes" => [
				["descricao" => "Pagamento Stephen King LTDA", "tipo" => "C", "valor" => "R$ 20.000", "data" => "2017-07-16"],
				["descricao" => "MERCEARIA DINO LTDA", "tipo" => "D", "valor" => "R$ 25,30", "data" => "2017-07-16"],
				["descricao" => "COMPRA DEBITO NACIONAL", "tipo" => "D", "valor" => "R$ 150,35", "data" => "2017-07-16"],
				["descricao" => "COMPRA DEBITO NACIONAL", "tipo" => "D", "valor" => "R$ 200,65", "data" => "2017-07-19"],
				["descricao" => "UBER", "tipo" => "D", "valor" => "R$ 50,00", "data" => "2017-07-20"],
				["descricao" => "PAGAMENTO DE CONTAS", "tipo" => "D", "valor" => "R$ 400,00", "data" => "2017-07-22"],
				["descricao" => "TRANSFERÊNCIA Banco - 237 - Ag - 2781 - Conta - 8710-10 - ANNIE WILKES", "tipo" => "D", "valor" => "R$ 2500,00", "data" => "2017-07-30"],
				["descricao" => "TEMAKERIA DERRY IT", "tipo" => "D", "valor" => "R$ 75,00", "data" => "2017-07-25"],
				["descricao" => "EXTRA SUPERMERCADOS", "tipo" => "D", "valor" => "R$ 620,00", "data" => "2017-07-30"],
				["descricao" => "CINEMARK", "tipo" => "D", "valor" => "R$ 55,00", "data" => "2017-08-01"],
				["descricao" => "TRANSFERÊNCIA Banco - 001 - Ag - 4321 - Conta - 09876-54 - LOUIS CREED", "tipo" => "D", "valor" => "R$ 1.500,00", "data" => "2017-08-05"],
				["descricao" => "TED - SERIAL KILLERS INC", "tipo" => "C", "valor" => "R$ 3.500,00", "data" => "2017-08-05"],
				["descricao" => "RELAX DERRY MASSAGENS", "tipo" => "D", "valor" => "R$ 300,00", "data" => "2017-08-07"],
				["descricao" => "COMPRA DEBITO NACIONAL", "tipo" => "D", "valor" => "R$ 45,00", "data" => "2017-08-07"],
				["descricao" => "COMPRA DEBITO NACIONAL", "tipo" => "D", "valor" => "R$ 200,00", "data" => "2017-08-09"],
				["descricao" => "UBER", "tipo" => "D", "valor" => "R$ 52,95", "data" => "2017-08-11"],
				["descricao" => "COMPRA DEBITO NACIONAL", "tipo" => "D", "valor" => "R$ 20,00", "data" => "2017-08-11"],
				["descricao" => "COMPRA DEBITO NACIONAL", "tipo" => "D", "valor" => "R$ 150,35", "data" => "2017-08-11"],
				["descricao" => "UBER", "tipo" => "D", "valor" => "R$ 30,80", "data" => "2017-08-14"],
				["descricao" => "COMPRA DEBITO NACIONAL", "tipo" => "D", "valor" => "R$ 5,00", "data" => "2017-08-16"],
				["descricao" => "FATURA CARTÃO DE CRÉDITO JULHO", "tipo" => "D", "valor" => "R$ 1.200,50", "data" => "2017-08-16"]
				
			]
		];

		$arr["data"] = $operations;

		return $arr;

	}

	
 ?>