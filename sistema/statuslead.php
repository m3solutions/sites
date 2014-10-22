<?php


require_once '/home/cpsistemacom/public_html/classes/dbClass.php';
//variaveis bco  depois pegar direto das configs do sistema 
//incluir todos os campos do sistema e fazer um swhit por porduto e exibir campos do no email a ser enviado 

$DB["host"] = 'localhost';
$DB["user"] = 'cpsistem_base';
$DB["pass"] = '160977';
$DB["dbName"] = 'cpsistem_base';


//variaveis recebidas 

$idlead = $_POST['leadID'];
$motivo =$_POST['motivo'];
$status =$_POST['status'];

//print_r($_POST);

mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());
mysql_select_db($DB["dbName"]) or die(mysql_error());

$query2 = ("UPDATE lcm_contacts SET lstatus = {$status}, motivo ='{$motivo}' where id= {$idlead}");
$result2 = mysql_query($query2);


$jsonData['result'] = 1;

if ($result2)
    echo json_encode($jsonData);
else
    echo "A mensagem não pode ser enviada";
