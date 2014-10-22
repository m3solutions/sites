<?php
header('Content-Type: application/json');
require_once 'classes/general.php';

require_once '/home/cpsistemacom/public_html/classes/dbClass.php';

 //$GEN = new GEN();
        $DB["host"] = 'localhost';
        $DB["user"] = 'cpsistem_base';
        $DB["pass"] = '160977';
        $DB["dbName"] = 'cpsistem_base';

        
//busca lead  a ser enviado e  monta array de dados do lead 
$idlead = $_POST['leadID'];


    mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());
mysql_select_db($DB["dbName"]) or die(mysql_error());

$query1 = (" SELECT *  FROM lcm_contacts WHERE  lcm_contacts.id = {$idlead} ");

$result = mysql_query($query1);
$row = mysql_fetch_array($result);
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


$dados = $row; 

$produtoid= $dados['leadType'];

 $tel= $row['Phone'];
 $tel1= substr($dados['Phone'], 4);
 $ddd1 = substr($tel ,1 ,2);
  
 $tel2= $row['secondaryPhone'];
 $tel3= substr($dados['secondaryPhone'], 4);
 $ddd2 = substr($tel2 ,1 ,2);
 
  if  (!isset($ddd1)) {
        $sql1="SELECT  id,produtos ,regioes,last,`first` FROM lcm_users";      
      echo 'vazio ';
     //query completa sem filtros  
                     }
               //query com filtro          
                     //   echo 'ddd'.$ddd1.'tel'.$tel1 ."tipo".$produtoid;  
                     
                  $sql2="SELECT id,produtos ,regioes,last FROM lcm_users WHERE produtos  LIKE '%{$produtoid}%' and regioes like '%{$ddd1}%'";      
                      
                                       
               $resultado = mysql_query($sql2) or die (mysql_error());  
         
       
        //  $sql = "select * from {$dbPre}leadType order by typeName asc";
//$lista = $db->extQuery($sql2);      
   //   while ($row5 = mysql_fetch_row($result)) {
          
  //    }
               
   while ($row = mysql_fetch_array($resultado, MYSQL_BOTH)){
       
  $linha =$row['id'];
  
   $linha2 = $row['last'];
  
//  echo    $retorno =  json_encode($linha)    ;
 
  $resultados[] = Array ( 'id'=> $linha , 'nome'=>$linha2      );
      // echo $linha;
  }
 
 echo json_encode($resultados)    ;
               
               
              
                          
                           
             
  ?>