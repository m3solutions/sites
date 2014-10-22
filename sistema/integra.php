<?php

    // recebe.php ---  funcoes para receber os leads dos sites ----  12/05/2014
// autor: Jones Junior 
//gravr obs na tabela notes 
//rotina de selecao de proprietario com base no cadastro por regiar produto e contadores ...
// 
//variaveis bco  depois pegar direto das configs do sistema 

//pegar url de origem $url=  $_SERVER['QUERY_STRING']; 
$DB["host"] = 'localhost';

$DB["user"] = 'easylead_gerenc';

$DB["pass"] = '160977';

$DB["dbName"] = 'easylead_gerencia';

$dados = $_POST;

//monta array do post 

//echo 'post' . '<br>' . '<pre>';

//print_r($dados);

///echo '</pre>';

// grava  lead  no bco 

$origem = 2; // origem numerico da tab source 

$endereco = 'busca pelo cep';

$referencia = 'Site - vivo PF';

$ip = 'ip do visitante';



mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());

mysql_select_db($DB["dbName"]) or die(mysql_error());







$query1 = ("insert into lcm_contacts (firstName,lastName,Address,Phone,secondaryPhone,Email,City,State,Country,Zip,leadType,leadSource,dateAdded,

dateModified,lastModifiedBy,assignedTo,lStatus,customField,customField2,customField3,score,estado,referencia,ip) 


values   


('{$dados['pessoa_de_contato']}','','{$endereco}', '{$dados['telefone']}','{$dados['telefone2']}', '{$dados['email']}','{$dados['cidade']}','{$dados['estado']}','Brasil','{$dados['cep']}','2','2',now(),'','','1','3','{$dados['cnpj']}','{$dados['nome_empresa']}','','','','{$referencia}','{$ip}'   ) ");



$result1 = mysql_query($query1);

$idl = mysql_insert_id();





$leadid1 = $idl;





$query2 = (" insert into lcm_leadNotes (leadID, Note,creator,dateAdded) values ('{$leadid1}','{$dados['comentarios']}','1',now() )  ");



$result2 = mysql_query($query2);



if (!$result2) {

    die('Invalid query: ' . mysql_error());
}

echo 'grava' . $result2;
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Vivo - Encontre o melhor plano da Vivo de acordo com sua necessidade</title>
<meta name="description" content="Encontre o melhor plano da Vivo de acordo com sua necessidade" />
<meta name="language" content="pt-br" />
<meta name="author" content="Alessandro Rods | CP Target Inteligência Online" />
<meta name="url" content="http://meu-melhor-plano-vivo.com" />
<meta name="abstract" content="Encontre o melhor plano da Vivo de acordo com sua necessidade" />
<meta name="alexa" content="100" />
<meta name="pagerank" content="10" />
<meta name="revisit" content="2 days" />
<meta name="revisit-after" content="2 days" />
<meta name="robots" content="all, index, follow" />
<meta name="subject" content="Encontre o melhor plano da Vivo de acordo com sua necessidade" />

<link href="images/favicon.ico" rel="shortcut icon" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1 user-scalable=no" />

<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="themes/light/light.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

<script type="text/javascript" src="js/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript" src="js/anchor-animate.js"></script>
<script type="text/javascript" 	src="js/jquery.smint.js"></script>
<script type="text/javascript" src="js/jquery.nivo.slider.js"></script>


<script type="text/javascript" src="js/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>

<script type="text/javascript" src="http://rods.la/jquery.validartelefone.js"></script>

<script type="text/javascript">
$(document).ready(function () {
	$("#dados").validate({
		rules: {
			nome: {required: true},
			email: {required: true, email: true},
			//telefone: {required: true, minlength: 10},
			telefone2: {minlength: 10},
			telefone: {
					  required: function(element) {
						return $("#telefone").val() < 9;
					  }, minlength: 10
					},
			cep: {required: true},
			estado: {required: true},
			cidade: {required: true}
		},
		
		// define messages para cada campo
		messages: {
			nome: "Por favor, informe o nome completo do contato.",
			email: "Por favor, informe um e-mail válido.",
			telefone: "Por favor, informe um número de telefone fixo válido.",
			telefone2: "Por favor, informe um número de telefone celular válido.",
			estado: "Por favor, informe o seu Estado.",
			cidade: "Por favor, informe a sua Cidade."
		},
		submitHandler: function(form) {
			// your ajax loading logic
			form.submit(); // use this to finally submit form data at the last step
			return false;  // prevent form submit because you are doing the ajax
		}
	});

});
</script>

<script>	
	$(document).ready(function(){
	$('#telefone').mask('(99)9999-9999').ValidarTelefone(); 
	$('#telefone2').focusout(function(){
			var phone, element;
			element = $(this);
			element.unmask();
			phone = element.val().replace(/\D/g, '');
			if(phone.length > 10) {
				element.mask("(99)99999-999?9");
			} else {
				element.mask("(99)9999-9999?9");
			}
		}).trigger('focusout').ValidarTelefone({celular: true});
	
	$('#telefone-retornar').focusout(function(){
			var phone, element;
			element = $(this);
			element.unmask();
			phone = element.val().replace(/\D/g, '');
			if(phone.length > 10) {
				element.mask("(99)99999-999?9");
			} else {
				element.mask("(99)9999-9999?9");
			}
		}).trigger('focusout').ValidarTelefone({celular: true});
});


//valida CEP
function ValidaCep(cep){
		exp = /\d{5}\-\d{3}/
		if(!exp.test(cep.value))
				alert('Numero de Cep Invalido!');               
}
</script>

<!-- BOTAO -->
<script type='text/javascript'>
$(document).ready(function(){
$(".button img.a").hover(
function() {
$(this).stop().animate({"opacity": "0"}, "slow");
},
function() {
$(this).stop().animate({"opacity": "1"}, "slow");
});
 
});
</script>



<!-- FANCYBOX -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('.fancybox').fancybox();
		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>

<!-- SLIDER -->
<script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider({
		effect: 'fade',               // Specify sets like: 'fold,fade,sliceDown'
		animSpeed: 500,                 // Slide transition speed
		pauseTime: 3000,                // How long each slide will show
		startSlide: 0,                  // Set starting Slide (0 index)
		directionNav: false,             // Next and Prev navigation
		controlNav: true,               // 1,2,3... navigation
		controlNavThumbs: false,        // Use thumbnails for Control Nav
		pauseOnHover: true,             // Stop animation while hovering
		manualAdvance: false,           // Force manual transitions
		prevText: 'Prev',               // Prev directionNav text
		nextText: 'Next',               // Next directionNav text
		randomStart: false,             // Start on a random slide
		}
		);
    });
</script>
   
<!-- MENU -->


<!-- FORMULARIO -->
<script type="text/javascript">
var animate = {
    'time': 750,
    'randMin': 1000,
    'randMax': 1000
};

$(function(){
var top = $("#formulario").offset().top;
	$(window).scroll(function (event) {
	// what the y position of the scroll is
	var y = $(this).scrollTop();
	// whether that's below the form
	if (y >= top) {
	// if so, ad the fixed class
	$('#formulario, #sucesso').stop().animate({'top': y+10}, 500);
	} else {
	// otherwise remove it
	$('#formulario, #sucesso').stop().animate({'top': 0}, 500);
	}
});
});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50468307-33', 'meu-melhor-plano-vivo.com');
  ga('send', 'pageview');

</script>
</head>
<body onload="setTimeout(function() { window.scrollTo(0, 1) }, 100);">

<div class="wrap">    
  <div class="subMenu" >
		<div class="inner" style="text-align: center">
			<a href="index.php" id="sTop" class="subNavBtn"><img src="images/logo.png" alt="Vivo" /></a>
		</div>	
	</div>
</div>




<?php				
				$optin = $_POST["optin"];
				$nome = $_POST['nome'];
				$email= strtolower($_POST["email"]); 
				$telefone= $_POST["telefone"];
				$telefone2= $_POST["telefone2"]; 
				$estado= $_POST["estado"]; 
				$cidade= $_POST["cidade"];
				$interesse= $_POST["interesse"];
				$produto= $_POST["produto"];
				$quantidade_linhas = '';
				$cep = '';
				$plano_pj = '';
				
				$ness = $_POST['necessidades'];
				$necessidades = "";
				foreach($ness as $necessidade){
					$necessidades .= $necessidade . ', ';
				}
	
				if ($produto == "" || $produto == null) {
					// no data passed by get
				}			
					
					$url= $_POST['url'];
					if (( $url=="")){
						$url = 'http://meu-melhor-plano-vivo.com/';// $_SERVER['REQUEST_URI']; 
					}else {
						$url = 'http://meu-melhor-plano-vivo.com/'.$_POST['url'];
					}
				
				
				
				/*	$client = new SoapClient('http://187.72.86.221:8080/LeadsWS/services/TargetLeadsWSImpl?wsdl');
					$function = 'recebeLead';
				
					//ParÃ¢metros que o WS estÃ¡ preparado para receber, caso o site nÃ£o tenha algum campo desse, o parÃ¢metro deverÃ¡ ser "setado" como null.
					$arguments= array('recebeLead' => array(
							'idSite' => 55,
							'senha' => 'cpt123',
							'nome' =>  $nome, //tamanho mÃ¡ximo 60
							'email' => $email, //tamanho mÃ¡ximo 50
							'cep' => NULL, //tamanho mÃ¡ximo 9
							'telefone' => $telefone, //(00)0000-0000, // tamanho mÃ¡ximo 15
							'endereco' => NULL, //tamanho mÃ¡ximo 60
							'complemento' => NULL, //tamanho mÃ¡ximo 40
							'cidade' => $cidade, //tamanho mÃ¡ximo 50
							'estado' => $estado, //tamanho mÃ¡ximo 4
							'bairro' => NULL, //tamanho mÃ¡ximo 50
							'numero' => NULL, //tamanho mÃ¡ximo 10
							'celular' => $telefone2,//(00)00000-0000 //tamanho mÃ¡ximo 15
							'quantidade_linhas' => NULL, //tamanho mÃ¡ximo 30
							'interesse' => $interesse,//tamanho mÃ¡ximo 100
							'plano_pj' => NULL,//tamanho mÃ¡ximo 30
							'necessidades' => $necessidades, //tamanho mÃ¡ximo 150
							'empresa' => NULL, //tamanho mÃ¡ximo 60
							'tipo_veiculo' => NULL, //tamanho mÃ¡ximo 20
							'ano_veiculo' => NULL,//tamanho mÃ¡ximo 8
							'marca_veiculo' => NULL, //tamanho mÃ¡ximo 30
							'contaCartao' => NULL, //tamanho mÃ¡ximo 30
							'nascimento' => NULL, //tamanho mÃ¡ximo 30
							'cnpj' => NULL , //tamanho mÃ¡ximo 20
							'url' => $url,
							'produto' => '29' //de acordo com o sistema leads
					));
				
					$options = array('location' => 'http://187.72.86.221:8080/LeadsWS/services/TargetLeadsWSImpl');
					 
					//$result = $client->__call($function, $arguments, $options);
					$result = $client->__soapCall($function, $arguments, $options);

					//print_r($result);//Executa o pixel apenas se o retorno for OK
				*/
					
					
					
					//Executa o pixel apenas se o retorno for OK
				$pos = strpos($url, 'utm_source=weach');
				if ($pos !== false){
					$boom = explode(";", $result->return);
					if ($boom[0] == "ok"){
						$transaction_id = $boom[1];
						echo '<!-- WEACH -->';
						echo '<iframe src="http://securetkr.net/p.ashx?o=22&t='.$transaction_id.'" height="1" width="1" frameborder="0"></iframe>';
						echo '<!-- WEACH -->';
					}
				}
				
				
					// O remetente deve ser um e-mail do seu domÃ­nio conforme determina a RFC 822.
					// O return-path deve ser ser o mesmo e-mail do remetente.
					$headers = "MIME-Version: 1.1\n";
					$headers .= "Content-type: text/plain; charset=UTF-8\n";
					$headers .= "From: Meu melhor plano Vivo <contato@cptarget.com.br>"."\n"; // remetente
					$headers .= "Return-Path: Meu melhor plano Vivo <contato@cptarget.com.br>"."\n"; // return-path
		
					$body = "Cadastro - Meu melhor plano Vivo \n";
					$body .= "Nome: $nome \n";
					$body .= "E-Mail: $email \n";
					$body .= "Telefone: $telefone \n";
					$body .= "Celular: $telefone2 \n";
					$body .= "Cidade: $cidade \n";
					$body .= "Estado: $estado \n";
					$body .= "Interesse: $interesse \n";
					$body .= "Necessidades: $necessidades \n";
					$body .= "URL: $url \n";
					
					$envio = mail("contato@cptarget.com.br", "Cadastro - Meu melhor plano Vivo", $body, $headers);
					
					
?>



<div class="section s1" style="
    position: relative;
    top: 250px;
    text-align: center;
	min-height: 10px;
">		
	<div class="inner">
	<?php
	$fim = explode(";", $result->return);
	if ($fim[0] == 'ok'){
	?>
		<h1 class="verde" style="font-size:54px"><b>AGRADECEMOS O SEU INTERESSE!</b></h1>
		<h1>Em breve você receberá o contato de um de nossos consultores.</h1>
		<a href="index.php" class="cinza"><b>« Voltar</b></a>
	<?php
	}else{
	?>
		<h1 class="verde" style="font-size:54px"><b>ALGUMA COISA DEU ERRADO :(</b></h1>
		<h1>Por favor, tente novamente.</h1>
		<a href="index.php" class="cinza"><b>« Voltar</b></a>
	<?php
	}
	?>
	</div>
</div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.js"></script>
</body>
</html>