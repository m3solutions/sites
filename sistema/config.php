<?php
/**
 * pagina principal de configurações do sistema 
 *
 * */


require_once 'header.php';
if ($_SESSION['access'] != '1') {        // somente administradores tem acesso 
    header('Location: index.php');
}



$sql = "select * from {$dbPre}leadSource order by sourceName asc";
$leadSource = $db->extQuery($sql);
$sql = "select * from {$dbPre}leadType order by typeName asc";
$leadType = $db->extQuery($sql);
$sql = "select * from {$dbPre}leadStatus order by statusName asc";
$leadStatus = $db->extQuery($sql);
$sql = "select * from {$dbPre}users order by last asc";
$users = $db->extQuery($sql);
$sql = "select * from {$dbPre}siteSettings";
$siteSettings = $db->extQueryRowObj($sql);
$sql = "select * from {$dbPre}sortOrder order by orderSet";
$sortOrder = $db->extQuery($sql);

//motivos 

$sql = "select * from motivo_aux";
$motivos = $db->extQuery($sql);




?>
<script>
    var token = "<?php echo $token; ?>";
    var page = "<?php echo isset($_GET['page']) ? $_GET['page'] : ''; ?>";

    var siteSettings = {};
    siteSettings = (<?php echo json_encode($siteSettings); ?>);
   
 $.datepicker.setDefaults( $.datepicker.regional[ "pt" ] );  

$(function() {
    $( "#calendario" ).datepicker({ dateFormat: 'yy-mm-dd' });
});

$(function() {
    $( "#calendariof" ).datepicker({ dateFormat: 'yy-mm-dd' });
});



//relatorio1 

$(document).on('click', '.relat1', function() {  // Continue removing Lead
  // var leadID = $('.leadDelete').attr('class').split(' ')[1];
  //  var produt = $(".produtosel").val();  
   
       var produt = $(".produtosel option:selected").text();  
        
        // var leadID = $('.enviaLead').attr('class');//.split('=')[1];
   var type = '1';
  //   var owner =$('.leadOwner').val();
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "relats.php",  
        
       
       
    //  data:  {type:type, firstName:firstName, lastName:lastName, phone:phone, secondaryPhone:secondaryPhone,
     //          fax:fax, email:email, secondaryEmails:secondaryEmails, address:address, zipCode:zipCode,
     //          city:city, state:state, country:country, leadSource:leadSource, leadType:leadType, leadStatus:leadStatus,
       //        customField:customField, customField2:customField2, customField3:customField3, token:token,
          //     existing:existing, id:id, leadOwner:leadOwner},
        
         data:{produt:produt ,type:type,},//token:token , leadID:leadID , email:email,owner:owner },  
        success: function(response) {
           if (response.result == '1') {
            //    $('.enviaLead.lead' + leadID);
                
           //     $.modal.close();
                alert('Relatório Gerado com Sucesso! \n PRODUTO:= '+ produt);
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});
    
   
   
   //relatorio2 

$(document).on('click', '.relat2', function() {  // Continue removing Lead
  // var leadID = $('.leadDelete').attr('class').split(' ')[1];
  //  var produt = $(".produtosel").val();  
   
      //  var produt = $(".produtosel option:selected").text();  
      //  var dataini =$('#calendario').val();
        
        var dataini =$('#calendario').datepicker({ dateFormat: 'dd-mm-yy' }).val()
        var datafim =$('#calendariof').val(); 
        // var leadID = $('.enviaLead').attr('class');//.split('=')[1];
   var type = '2';
  //   var owner =$('.leadOwner').val();
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "relats.php",  
        
       
       
    //  data:  {type:type, firstName:firstName, lastName:lastName, phone:phone, secondaryPhone:secondaryPhone,
     //          fax:fax, email:email, secondaryEmails:secondaryEmails, address:address, zipCode:zipCode,
     //          city:city, state:state, country:country, leadSource:leadSource, leadType:leadType, leadStatus:leadStatus,
       //        customField:customField, customField2:customField2, customField3:customField3, token:token,
          //     existing:existing, id:id, leadOwner:leadOwner},
        
         data:{dataini:dataini,datafim:datafim ,type:type,},//token:token , leadID:leadID , email:email,owner:owner },  
        success: function(response) {
           if (response.result == '1') {
            //    $('.enviaLead.lead' + leadID);
                
           //     $.modal.close();
                alert('Relatório Gerado com Sucesso! \nPERÍODO DE '+ dataini +' ATÉ '+datafim);
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});
    
   
   
   //relatorio3

$(document).on('click', '.relat3', function() {  // Continue removing Lead
          var cliente = $(".clientesel option:selected").text();           
          var type = '3';
  
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "relats.php",  
     
             data:{cliente:cliente ,type:type,},//token:token , leadID:leadID , email:email,owner:owner },  
        success: function(response) {
           if (response.result == '1') {
          
                alert('Relatório  em Desenvolvimento !');
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});
    
   
   
    //relatorio4

$(document).on('click', '.relat4', function() {  // Continue removing Lead
          var cliente = $(".clientesel option:selected").text();           
          var type = '4';
  
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "relats.php",  
     
             data:{cliente:cliente ,type:type,},//token:token , leadID:leadID , email:email,owner:owner },  
        success: function(response) {
           if (response.result == '1') {
          
                alert('Relatório  em Desenvolvimento - Enviados  !');
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});
   
   
   
   //relatorio5

$(document).on('click', '.relat5', function() {  // Continue removing Lead
        var cliente = $(".clientesel option:selected").text();           
          var type = '5';
  
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "relats.php",  
     
             data:{cliente:cliente ,type:type,},//token:token , leadID:leadID , email:email,owner:owner },  
        success: function(response) {
           if (response.result == '1') {
          
                alert('Relatório gerado com sucesso');
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});


//relatorio6

$(document).on('click', '.relat6', function() {  // Continue removing Lead
        var origem  = $(".selorigem option:selected").text();           
          var type = '6';
  
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "relats.php",  
     
             data:{origem:origem ,type:type,},//token:token , leadID:leadID , email:email,owner:owner },  
        success: function(response) {
           if (response.result == '1') {
          
                alert('Relatório Gerado com sucesso ! \nORIGEM = '+origem);
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});
</script>


<!-- Settings specific js file -->
<script type="text/javascript" src="js/config.js"></script>



<div class="outer">
    <div class="statusSelect">
        <ul>
            <li><a href="#" class="manageSite sections">Configuração do Sistema </a></li>
            <li><a href="#" class="outras sections">Outras Configs </a></li>
            <li><a href="#" class="manageExp sections">Importar / Exportar</a></li>
            <li><a href="#" class="showrelat sections">Relatórios </a></li>
            <li><a href="#" class="manageStatus sections">Status</a></li>
            <li><a href="#" class="managemotivos sections">Motivos</a></li>
            <li><a href="#" class="manageSource sections ">Origens</a></li>
            <li><a href="#" class="manageType sections">Produtos</a></li>
            <li><a href="#" class="manageUsers sections">Usuários</a></li>
     <?//    <li><a href="#" class="emptyDatabase sections">Limpar bco de Dados</a></li> ?>
            <li><a href="#" class="showLogging sections">Log de Atividades </a></li>
        </ul>
    </div>

    <div class="sourceDisplay section hidden">

        
        <div class="configLeft">
            <br />
            <h3 class="secTitle">Gerenciar Origens .</h3>
            <hr class="thinLine">
            <br /><br />
            <table class="configure">
                <?php
                foreach ($leadSource as $row => $source) {
                    if ($source->sourceName != 'None') {   // Do not display None group to edit
                        ?>
                        <tr class="entryItem <?php echo $source->sourceID; ?>">
                            <td><?php echo $source->sourceID?></td>
                            
                            
                            <td>Nome: </td>
                            <td class="itemName">
                                <input type="text" class="name lnField" size="50" value="<?php echo $source->sourceName; ?>" />
                            </td>
                            <td>Descrição:</td>
                            <td class="notes"><input type="text" class="description lnDesc" value="<?php echo $source->description; ?>" />
                            </td>
                            <td><button class="smallButtons blueButton saveSource">Salvar</button>&nbsp;
                                <button class="smallButtons redButton removeSource">Apagar</button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
        <div class="configRight">
            <br /><br /><br /><br />
            Add nova Origem ?
            <hr class="thinLine">
            <table class="addNewSource">
                <tr>
                    <td>Nome:</td><td><input type="text" class="newLeadSource lnField" /></td>
                </tr>
                <tr>
                    <td>Descrição:</td><td><input type="text" class="newLeadDesc lnDesc" /></td>
                </tr>
                <tr>
                    <td></td><td><button class="buttons yellowButton saveNewSource">Salvar</button></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="typeDisplay section hidden">
        <div class="configLeft">
            <br />
            <h3 class="secTitle">Gerenciar Produtos.</h3>
            <hr class="thinLine">
            <br /><br />
            <table class="configureT">
                <?php
                foreach ($leadType as $row => $type) {
                    if ($type->typeName != 'None') {   // Do not display None group to edit
                        ?>
                        <tr class="entryItem <?php echo $type->typeID; ?>">
                            <td><strong>ID: <?php echo $type->typeID; ?></strong>  /Nome: </td>
                            <td class="itemName">
                                <input type="text" class="name lnField" size="50" value="<?php echo $type->typeName; ?>" />
                            </td>
                            <td>Descrição:</td>
                            <td class="notes"><input type="text" class="description lnDesc" value="<?php echo $type->description; ?>" />
                            </td>
                            <td><button class="smallButtons blueButton saveType">Salvar</button>&nbsp;
                                <button class="smallButtons redButton removeType">Apagar</button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
        <div class="configRight">
            <br /><br /><br /><br />
            Add novo Produto ? 
            <hr class="thinLine">
            <table class="addNewType">
                <tr>
                    <td>Nome:</td>
                    <td><input type="text" class="newLeadType lnField" /></td>
                </tr>
                <tr>
                    <td>Descrição:</td><td><input type="text" class="newLeadDesc lnDesc" /></td>
                </tr>
                <tr>
                    <td></td><td><button class="buttons yellowButton saveNewType">Salvar</button></td>
                </tr>
            </table>
        </div>

    </div>

    <div class="statusDisplay section hidden">

        <div class="configLeft">
            <br />
            <h3 class="secTitle">Gerenciar Status do Lead.</h3>
            <hr class="thinLine">
            <br /><br />
            <table class="configureS">
                <?php
                foreach ($leadStatus as $row => $status) {
                    if ($status->statusName != 'None') {   // Do not display None group to edit
                        ?>
                        <tr class="entryItem <?php echo $status->id; ?>">
                            
                            <td> <?php echo $status->id; ?></td>
                            <td>Nome: </td>
                            <td class="itemName">
                                <input type="text" class="name lnField" size="50" value="<?php echo $status->statusName; ?>" />
                            </td>
                            <td>Descrição:</td>
                            <td class="notes"><input type="text" class="description lnDesc" value="<?php echo $status->description; ?>" />
                            </td>
                            <td><button class="smallButtons blueButton saveStatus">Save</button>&nbsp;
                                <button class="smallButtons redButton removeStatus">Delete</button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
        <div class="configRight">
            <br /><br /><br /><br />
            Add Novo Status?
            <hr class="thinLine">
            <table class="addNewStatus">
                <tr>
                    <td>Nome:</td>
                    <td><input type="text" class="newLeadStatus lnField" /></td>
                </tr>
                <tr>
                    <td>Descrição:</td><td><input type="text" class="newLeadDesc lnDesc" /></td>
                </tr>
                <tr>
                    <td></td><td><button class="buttons yellowButton saveNewStatus">Save</button></td>
                </tr>
            </table>
        </div>
    </div>

    
    <?php
    //motivos 
    
    ?>
    
 <div class="managemotivos section hidden">

        <div class="configLeft">
            <br />
            <h3 class="secTitle">Gerenciar Motivos do Status do Lead.</h3>
            <hr class="thinLine">
            <br /><br />
            <table class="configureS">
                <?php
                foreach ($motivos as $row => $motivo) {
                    if ($motivo->motivo != 'None') {   // Do not display None group to edit
                        ?>
                        <tr class="entryItem <?php echo $motivo->id; ?>">
                            
                            <td> <?php echo $motivo->id; ?></td>
                            <td>Status: </td>
                            <td class="itemName">
                                <input type="text" class="name lnField" size="50" value="<?php echo $motivo->status; ?>" />
                            </td>
                            <td>Motivo:</td>
                            <td class="notes"><input type="text" class="description lnDesc" value="<?php echo $motivo->motivo; ?>" />
                            </td>
                            <td><button class="smallButtons blueButton savemotivo">Salvar</button>&nbsp;
                                <button class="smallButtons redButton removemotivo">Apagar</button>
                            </td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </table>
        </div>
        <div class="configRight">
            <br /><br /><br /><br />
            Add Novo Motivo?
            <hr class="thinLine">
            <table class="addNewmotivo">
                <tr>
                    <td>Status:</td>
                    <td><input type="text" class="newLeadStatus lnField" /></td>
                </tr>
                <tr>
                    <td>Motivo:</td><td><input type="text" class="newLeadDesc lnDesc" /></td>
                </tr>
                <tr>
                    <td></td><td><button class="buttons yellowButton saveNewmotivo">Salvar</button></td>
                </tr>
            </table>
        </div>
    </div>
    
    
    <div class="showrelat section hidden">
        <div class="configLeft">

            <h3 class="secTitle">Gerar Relatórios </h3>
            <hr class="thinLine">
            <br />
<br>
  
  
               
      
    <div class="tabs" id="tabs">
            <ul>
                <li><a href="#leadp">Leads por Produto</a></li>
                <li><a href="#leadpe">Leads por Periodo</a></li>
                <li><a href="#leadc">Leads por Cliente </a></li>
                <li><a href="#leade">Leads Enviados</a></li>
                <li><a href="#leadcp">Leads Cliente x Produto</a></li>
                <li><a href="#leado">Leads por Origem</a></li>
                <li><a href="#leadt">Todos os Leads</a></li>
            </ul>


        
        <div id="leadt">
            
            <p>     Exporta Todos Leads do sistema </p>
            <br>
           <button class="buttons redButton relat1">Gerar Relatório </button>
            
        </div>
        
        <div id="leadp">
            
           <p> Selecione o produto: 
           
               <select class="produtosel">
                   
                  <option>Selecione...</option>
                 
 <br>
            
 
             <?php 
 
             
             $file= 'Leads-CPTarget.xlsx';
            $DB["host"] = '192.169.90.60';
            $DB["user"] = 'cpsistem_base';
            $DB["pass"] = '160977';
            $DB["dbName"] = 'cpsistem_base';

    mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());
    mysql_select_db($DB["dbName"]) or die(mysql_error());
        
    $query1 = ("SELECT *  FROM lcm_leadType ");
    
    $res= mysql_query($query1);
 
 while($prod = mysql_fetch_array($res)) { ?>
 <option value="<?php  $prod['typeID'] ?>"><?php echo $prod['typeName'] ?></option>
 <?php } ?>
                   
               </select>
                      
           </p><br>
           <button class="buttons redButton relat1" >Gerar Relatório </button> <br><br>
           
        
           <li>
                        <form action="http://cpsistema.com.br/baixar.php?file=Leads-por-produto-CPTarget.xlsx" method="post">
                            <a href="#" onclick="$(this).closest('form').submit()" class="exportExcel">Clique aqui para baixar o relatório</a>
                            <input type="hidden" name="type" value="excel" />
                        </form>
                    </li>
           
           
       
                    
                    
      
         
          
        </div>
        
         <div id="leadpe">
            
           <p>Data Inicial : <input type="text" id="calendario" />
           Data Final : <input type="text" id="calendariof" /></p>
           
           <br>
           <button class="buttons redButton relat2" >Gerar Relatório </button><br><br>
          
             <form action="http://cpsistema.com.br/baixar.php?file=Leads-por-periodo-CPTarget.xlsx" method="post">
                            <a href="#" onclick="$(this).closest('form').submit()" class="exportExcel">Clique aqui para baixar o relatório</a>
                            <input type="hidden" name="type" value="excel" />
                        </form>
 
            
            
        </div>
        
         <div id="leadc">
             <p> Selecione o Cliente: 
           
               <select class="clientesel">
                   
                  <option>Selecione...</option>
            
            <?php 
 
            $DB["host"] = '192.169.90.60';
            $DB["user"] = 'cpsistem_base';
            $DB["pass"] = '160977';
            $DB["dbName"] = 'cpsistem_base';

    mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());
    mysql_select_db($DB["dbName"]) or die(mysql_error());
        
    $query1 = ("SELECT *  FROM lcm_users ");
    
    $res= mysql_query($query1);
 
 while($prod = mysql_fetch_array($res)) { ?>
 <option value="<?php  $prod['id'] ?>"><?php echo $prod['userName'] ?></option>
 <?php } ?>
                   
               </select>
                      
           </p><br>
           <button class="buttons redButton relat3" >Gerar Relatório </button>
            
        </div>
        
        
         <div id="leadcp">
            
         <p> Selecione o Cliente: 
           
               <select>
                   
                  <option>Selecione...</option>
            
            <?php 
 
            $DB["host"] = '192.169.90.60';
            $DB["user"] = 'cpsistem_base';
            $DB["pass"] = '160977';
            $DB["dbName"] = 'cpsistem_base';

    mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());
    mysql_select_db($DB["dbName"]) or die(mysql_error());
        
    $query1 = ("SELECT *  FROM lcm_users ");
    
    $res= mysql_query($query1);
 
 while($prod = mysql_fetch_array($res)) { ?>
 <option value="<?php  $prod['id'] ?>"><?php echo $prod['userName'] ?></option>
 <?php } ?>
                   
               </select>
             
             
                Selecione o produto: 
           
               <select>
                   
                  <option>Selecione...</option>
 
 <?php 
 
            $DB["host"] = '192.169.90.60';
            $DB["user"] = 'cpsistem_base';
            $DB["pass"] = '160977';
            $DB["dbName"] = 'cpsistem_base';

    mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());
    mysql_select_db($DB["dbName"]) or die(mysql_error());
        
    $query1 = ("SELECT *  FROM lcm_leadType ");
    
    $res= mysql_query($query1);
 
 while($prod = mysql_fetch_array($res)) { ?>
 <option value="<?php  $prod['typeId'] ?>"><?php echo $prod['typeName'] ?></option>
 <?php } ?>
                   
               </select>
     
                
                <br> <br>
           <button class="buttons redButton relatcp
                   " >Gerar Relatório </button>
                   
                   <br><br>
          
             <form action="http://cpsistema.com.br/baixar.php?file=Leads-Enviados-CPTarget.xlsx" method="post">
                            <a href="#" onclick="$(this).closest('form').submit()" class="exportExcel">Clique aqui para baixar o relatório</a>
                            <input type="hidden" name="type" value="excel" />
                        </form>
            
        </div>
        
         <div id="leado">
            
              <p> Selecione a Origem: 
           
               <select class="selorigem">
                   
                  <option>Selecione...</option>
            
            <?php 
 
            $DB["host"] = '192.169.90.60';
            $DB["user"] = 'cpsistem_base';
            $DB["pass"] = '160977';
            $DB["dbName"] = 'cpsistem_base';

    mysql_connect($DB["host"], $DB["user"], $DB["pass"]) or die(mysql_error());
    mysql_select_db($DB["dbName"]) or die(mysql_error());
    mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
        
    $query1 = ("SELECT *  FROM lcm_leadSource ");
    
    $res= mysql_query($query1);
 
 while($prod = mysql_fetch_array($res)) { ?>
 <option value="<?php  $prod['sourceID'] ?>"><?php echo $prod['sourceName'] ?></option>
 <?php } ?>
                   
               </select>
                      
           </p><br>
           <button class="buttons redButton relat6" >Gerar Relatório </button>
            
           <br><br>
          
             <form action="http://cpsistema.com.br/baixar.php?file=Leads-por-Origem-CPTarget.xlsx" method="post">
                            <a href="#" onclick="$(this).closest('form').submit()" class="exportExcel">Clique aqui para baixar o relatório</a>
                            <input type="hidden" name="type" value="excel" />
                        </form>
           
           
        </div>  
        
        <div id="leade">
            
           <br>
           <button class="buttons redButton relat5" >Gerar Relatório </button>
           
           
          <form action="http://cpsistema.com.br/baixar.php?file=Leads-Enviados-CPTarget.xlsx" method="post">
                            <a href="#" onclick="$(this).closest('form').submit()" class="exportExcel">Clique aqui para baixar o relatório</a>
                            <input type="hidden" name="type" value="excel" />
                        </form> 
            
        </div>
        
    
    
    
    
    </div> 
 
        </div> 
    
    </div>
  
    <div class="outras section hidden">

        <div class="configLeft">
            <h3 class="secTitle">Outras Configurações  </h3>
            <hr class="thinLine">
            <br /><br />




        </div>


    </div>
        
    <div class="usersDisplay section hidden">
        <div class="configLeft">
            <br />
            <h3 class="secTitle">Gerenciar  Usuários.</h3>
            <hr class="thinLine">
            <br /><br />
            <table class="currentUsers">
                <tr><th></th><th>Usuário</th><th>Nome </th><th>Email</th><th>Criado</th><th>Regra</th><th>Editar</th></tr>
                <?php
                $i = 0;
                foreach ($users as $row => $user) {
                    $created = strtotime($user->created);
                    $created = date('m-d-Y h:m:s', $created);
                    if ($user->isAdmin == '1') {
                        $adminUser = 'Admin';
                    } elseif ($user->isAdmin == '2') {
                        $adminUser = 'User';
                    } elseif ($user->isAdmin == '0') {
                        $adminUser = 'Read Only';
                    }
                    if ($adminUser == 'User' && $user->ownLeadsOnly == 1) { // User manages only their own leads
                        $ownLeads = 'ownLeads';
                    } else {
                        $ownLeads = '';
                    }
                    $i++;
                    // print_r($users);
                    ?>



                    <tr>
                        <td><?php echo $i; ?>).
                        <td><?php echo $user->first . ' ' . $user->last; ?></td>
                        <td><?php echo $user->userName; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $created; ?></td>

                        <td class="<?php echo $ownLeads; ?>"><?php echo $adminUser; ?></td>
                        <td>
                            <button class="smallButtons blackButton changeAccount <?php echo $user->id; ?>">Atualizar</button>&nbsp;
                            <button class="smallButtons redButton removeUser <?php echo $user->id; ?>">Apagar</button>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div class="configRight">
            <br /><br /><br /><br />
            <table class="addNewUser">
                <tr class="addUser">
                    <td><button class="buttons yellowButton addNewUser">Add novo Usuário</button></td>
                </tr>
            </table>
        </div>

    </div>

    <div class="exportDisplay section hidden">
        <div id="tabs1">
            <ul>
                <li><a href="#imports">Importar Leads</a></li>
                <li><a href="#exports">Exportar Leads</a></li>
            </ul>

            <div id="imports">
                <h3 class="modalH">Importar leads </h3>
                <div class="importSteps">
                    <b>Passo 1.</b> Importar contatos de um arquivo de dados.  <br />
                    <br>
                    Observações Importantes : 
                    <ul>
                        <li>Formatos suportados csv, xlsx, xls. </li>
                        <li>Certifique-se de ter pelo menos um campo de nome e sobrenome em seus dados ou ele será ignorado.</li>
                        <li>Os endereços de email ou deve ser válido ou em branco ou a entrada será rejeitada.</li>
                        <li>Para importar dados o arquivo deve ter uma linha de cabeçalho com os campos identicos do sistema .</li>
                    </ul>
                    <br />
                    <form method="post" enctype="multipart/form-data" id="UploadForm">
                        <input id="fileToUpload" type="file" name="fileToUpload" class="input">
                        <button class="buttons blueButton uploadContacts" id="buttonUpload" onclick="return ajaxFileUpload();">Enviar</button>
                        <img id="loading" src="img/loaderb32.gif" alt="Loading" style="float:right; display:none;">  </form>
                </div>
            </div>

            <div id="exports">
                <h3 class="modalH">Exportar Leads </h3>
                <ul>
                    <li>
                        <form action="ajax/exportDirect.php" method="post">
                            Exportar para  <a href="#" onclick="$(this).closest('form').submit()" class="exportExcel">Planilha Excel</a>
                            <input type="hidden" name="type" value="excel" />
                        </form>
                    </li>
                    <li>
                        <form action="ajax/exportDirect.php" method="post">
                            Exportar para  <a href="#" onclick="$(this).closest('form').submit()" class="exportCSV">CSV</a>
                            <input type="hidden" name="type" value="csv" />
                        </form>
                    </li>
                </ul>
                <div class="results"></div>
            </div>
        </div>
    </div>

    <div class="siteDisplay section hidden">

        <div class="configLeft">
            <br />
            <h3 class="secTitle">Gerenciar Configurações.</h3>
            <hr class="thinLine">
            <br /><br />

            <h3 class="secTitle">1.) Paginação </h3> 
            <p>Escolha quantos resultados a serem exibidos por página nas seções do site. </p>
            <p class="pageResultsP">
                Resultados Por Pagina: 
                <input type="text" class="pageResults lnField" size="10" value="<?php echo $siteSettings->pageResults; ?>" />
                <button class="buttons blackButton savePageResults">Salvar</button>
            </p>
            <hr class="thinLine">
            <br />
            <h3 class="secTitle">2.) Nome dos Campos</h3>
            <p>Personalize os nomes dos campos do sistema , incluindo os campos extras (personalizados) 10.</p>
            <table class="fieldNames">
                <tr>
                    <td class="addresstd">
                        <span class="fieldNameC">Endereço:</span>
                        <input type="text" class="Address lnField" size="12" value="<?php echo $siteSettings->Address; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <td class="citytd">
                        <span class="fieldNameC">Cidade:</span>
                        <input type="text" class="City lnField" size="12" value="<?php echo $siteSettings->City; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <td class="statetd">
                        <span class="fieldNameC">Estado:</span>
                        <input type="text" class="State lnField" size="12" value="<?php echo $siteSettings->State; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                </tr>
                <tr>
                    <td class="countrytd">
                        <span class="fieldNameC">Pais:</span>
                        <input type="text" class="Country lnField" size="12" value="<?php echo $siteSettings->Country; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <td class="ziptd">
                        <span class="fieldNameC">CEP:</span>
                        <input type="text" class="Zip lnField" size="12" value="<?php echo $siteSettings->Zip; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <td class="phonetd">
                        <span class="fieldNameC">Telefone:</span>
                        <input type="text" class="Phone lnField" size="12" value="<?php echo $siteSettings->Phone; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                </tr>
                <tr>
                    <td class="secondaryPtd">
                        <span class="fieldNameC">Celular:</span>
                        <input type="text" class="secondaryPhone lnField" size="12" value="<?php echo $siteSettings->secondaryPhone; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <td class="faxtd">
                        <span class="fieldNameC">Fax:</span>
                        <input type="text" class="Fax lnField" size="12" value="<?php echo $siteSettings->Fax; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                     
                  <td class="referencia">
                        <span class="fieldNameC">Referencia:</span>
                        <input type="text" class="referencia lnField" size="12" value="<?php echo $siteSettings->referencia; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                 
                    <tr>
                    
                
            
                    <tr>     
                    <td class="customFieldP">
                        <span class="fieldNameC">Extra1:</span>
                        <input type="text" class="customField1 lnField" size="12" value="<?php echo $siteSettings->customField1; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                   
                    <td class="customField2td">
                        <span class="fieldNameC">Extra2:</span>
                        <input type="text" class="customField2 lnField" size="12" value="<?php echo $siteSettings->customField2; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <td class="customField3td">
                        <span class="fieldNameC">Extra3:</span>
                        <input type="text" class="customField3 lnField" size="12" value="<?php echo $siteSettings->customField3; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>

                    
       <tr>
                    <td class="customField4P">
                        <span class="fieldNameC">Extra4:</span>
                        <input type="text" class="customField4 lnField" size="12" value="<?php echo $siteSettings->customField4; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>

                    <td class="customField5P">
                        <span class="fieldNameC">Extra5:</span>
                        <input type="text" class="customField5 lnField" size="12" value="<?php echo $siteSettings->customField5; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                    <td class="customField6P">
                        <span class="fieldNameC">Extra6:</span>
                        <input type="text" class="customField6 lnField" size="12" value="<?php echo $siteSettings->customField6; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                      
         <tr>           
                    <td class="customField7P">
                        <span class="fieldNameC">Extra7:</span>
                        <input type="text" class="customField7 lnField" size="12" value="<?php echo $siteSettings->customField7; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>

                    <td class="customField8P">
                        <span class="fieldNameC">Extra8:</span>
                        <input type="text" class="customField8 lnField" size="12" value="<?php echo $siteSettings->customField8; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                    <td class="customField9P">
                        <span class="fieldNameC">Extra9:</span>
                        <input type="text" class="customField9 lnField" size="12" value="<?php echo $siteSettings->customField9; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                    
                    <tr>           
                    <td class="customField10P">
                        <span class="fieldNameC">Extra10:</span>
                        <input type="text" class="customField10 lnField" size="12" value="<?php echo $siteSettings->customField10; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                  <?  // +10 campos extras? ?>
                  
                      
                    <td class="customFieldP">
                        <span class="fieldNameC">Extra11:</span>
                        <input type="text" class="customField11 lnField" size="12" value="<?php echo $siteSettings->customField11; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                   
                    <td class="customField12td">
                        <span class="fieldNameC">Extra12:</span>
                        <input type="text" class="customField12 lnField" size="12" value="<?php echo $siteSettings->customField12; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <tr>
                    <td class="customField13td">
                        <span class="fieldNameC">Extra13:</span>
                        <input type="text" class="customField13 lnField" size="12" value="<?php echo $siteSettings->customField13; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>

                    
       
                    <td class="customField14P">
                        <span class="fieldNameC">Extra14:</span>
                        <input type="text" class="customField14 lnField" size="12" value="<?php echo $siteSettings->customField14; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>

                    <td class="customField15P">
                        <span class="fieldNameC">Extra15:</span>
                        <input type="text" class="customField15 lnField" size="12" value="<?php echo $siteSettings->customField15; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <tr>
                    <td class="customField16P">
                        <span class="fieldNameC">Extra16:</span>
                        <input type="text" class="customField16 lnField" size="12" value="<?php echo $siteSettings->customField16; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                      
                  
                    <td class="customField17P">
                        <span class="fieldNameC">Extra17:</span>
                        <input type="text" class="customField17 lnField" size="12" value="<?php echo $siteSettings->customField17; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>

                    <td class="customField18P">
                        <span class="fieldNameC">Extra18:</span>
                        <input type="text" class="customField18 lnField" size="12" value="<?php echo $siteSettings->customField18; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <tr>
                    <td class="customField19P">
                        <span class="fieldNameC">Extra19:</span>
                        <input type="text" class="customField19 lnField" size="12" value="<?php echo $siteSettings->customField19; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                    
                             
                    <td class="customField20P">
                        <span class="fieldNameC">Extra20:</span>
                        <input type="text" class="customField20 lnField" size="12" value="<?php echo $siteSettings->customField20; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                    
                    <?  // +10 campos extras? 20-30  ?>
                  
                      
                    <td class="customFieldP">
                        <span class="fieldNameC">Extra21:</span>
                        <input type="text" class="customField21 lnField" size="12" value="<?php echo $siteSettings->customField21; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                 <tr>  
                    <td class="customField22td">
                        <span class="fieldNameC">Extra22:</span>
                        <input type="text" class="customField22 lnField" size="12" value="<?php echo $siteSettings->customField22; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                   
                    <td class="customField23td">
                        <span class="fieldNameC">Extra23:</span>
                        <input type="text" class="customField23 lnField" size="12" value="<?php echo $siteSettings->customField23; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>

                     
       
                    <td class="customField24P">
                        <span class="fieldNameC">Extra24:</span>
                        <input type="text" class="customField24 lnField" size="12" value="<?php echo $siteSettings->customField24; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
<tr>
                    <td class="customField25P">
                        <span class="fieldNameC">Extra25:</span>
                        <input type="text" class="customField25 lnField" size="12" value="<?php echo $siteSettings->customField25; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                   
                    <td class="customField26P">
                        <span class="fieldNameC">Extra26:</span>
                        <input type="text" class="customField26 lnField" size="12" value="<?php echo $siteSettings->customField26; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                      
                  
                    <td class="customField27P">
                        <span class="fieldNameC">Extra27:</span>
                        <input type="text" class="customField27 lnField" size="12" value="<?php echo $siteSettings->customField27; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
<tr>
                    <td class="customField28P">
                        <span class="fieldNameC">Extra28:</span>
                        <input type="text" class="customField28 lnField" size="12" value="<?php echo $siteSettings->customField28; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                   
                    <td class="customField29P">
                        <span class="fieldNameC">Extra29:</span>
                        <input type="text" class="customField29 lnField" size="12" value="<?php echo $siteSettings->customField29; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                    
                             
                    <td class="customField30P">
                        <span class="fieldNameC">Extra30:</span>
                        <input type="text" class="customField30 lnField" size="12" value="<?php echo $siteSettings->customField30; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    <tr>
                    <td class="idd">
                        <span class="fieldNameC">IDD:</span>
                        <input type="text" class="idd lnField" size="12" value="<?php echo $siteSettings->idd; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
                    
                    <td class="operadora">
                        <span class="fieldNameC">Operadora:</span>
                        <input type="text" class="operadora lnField" size="12" value="<?php echo $siteSettings->operadora; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>

          <?
          idd
          /*
          incluir bloco abaixo para cada campo extra
          
           
                    <td class="idd">
                        <span class="fieldNameC">IDD:</span>
                        <input type="text" class="idd lnField" size="12" value="<?php echo $siteSettings->idd; ?>" />
                        <button class="buttons blackButton saveField">Salvar</button>
                    </td>
          
          
          
          
          */
          
          
          ?>
                    
                    
                    
                </tr>
            </table>
            <br>
            <hr class="thinLine">
            <br />

            <h3 class="secTitle">3.) Organizar Campos </h3>
            <p>Escolha os campos e a ordem  de exibição . Clique e arraste para organizar.

            </p>
            <div class='colContainer'>
                <b>Campos Usados :</b>
                <ul id="sortableCols" class="connectedSortable">
                    <?php
                    require_once 'classes/general.php';
                    $GEN = new GEN();

                    foreach ($sortOrder as $row => $field) {
                        if ($field->used == 1) {
                            $name = $GEN->nameField($field->setName, $siteSettings);
                            ?>
                            <li class="id<?php echo $field->id; ?>"><?php echo $name; ?></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <br />
                <b>Campos Não Usados:</b>
                <ul id="sortableCols2" class="connectedSortable">
                    <?php
                    foreach ($sortOrder as $row => $field) {
                        if ($field->used == 0) {
                            $name = $GEN->nameField($field->setName, $siteSettings);
                            ?>
                            <li class="id<?php echo $field->id; ?>"><?php echo $name; ?></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
                <p class="buttonRow"><button class="buttons blueButton saveOrder">Salvar Ordem</button></p>
            </div>
        </div>
    </div>


    <div class="emptyDBDisplay section hidden">
        <div class="configLeft">
            <br />
            <h3 class="secTitle">Apagar Todos Leads do Banco de Dados </h3>
            <hr class="thinLine">
            <br /><br />
            <p>Você pode optar por remover todos os dados da base de dados .</p>
            <p><b>CUIDADO!!</b> Isto irá apagar todos Leads da base de dados!  Se você tem certeza que quer fazer isso ???</p>
            <br /><br />
            <button class="buttons redButton emptyDB">APAGAR TODOS OS LEADS </button>
        </div>
    </div>

    <div class="loggingDisplay section hidden">
        <div class="configLeft">
            <br />
            <h3 class="secTitle">Log de Atividades </h3> Hora do Servidor : <?php echo date('Y-m-d H:i:s'); ?>
            <hr class="thinLine">
            <br /><br />
            <div class="activityLog">
            </div>
        </div>
        <div class="configRight">
            <br /><br /><br /><br />
            <p class="buttonRow"><button class="buttons blueButton showLogging">Atualizar </button></p>
        </div>
    </div>


</div>
<div class="push"></div>
</div>
<script>
// Trigger events
    if (page == 'users') {
        $('.manageUsers').trigger('click');
    }
    if (page == 'import') {
        $('.manageExp').trigger('click');
    }
    if (page == 'logging') {
        $('.showLogging').trigger('click');
    }
    if (page == 'siteSettings') {
        $('.manageSite').trigger('click');
    }
</script>





<?php
require_once 'footer.php';
?>
