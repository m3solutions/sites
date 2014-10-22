<?php
/**
  * This is the Individual lead view. 
  *
**/
require_once 'header.php';
$leadID = intval($_GET['lead']);
$sql = "select c.*, ls.sourceName, lt.typeName, lst.statusName from {$dbPre}contacts c, {$dbPre}leadStatus lst"
     . ", {$dbPre}leadSource ls, {$dbPre}leadType lt where c.id='$leadID' and c.lStatus=lst.id"
     . " and c.leadSource=sourceID and c.leadType=typeID limit 1";
$lead = $db->extQueryRowObj($sql);

$sql = "select * from {$dbPre}otherEmails where contact='$leadID'";
$otherEmails = $db->extQuery($sql);

$sql = "select * from {$dbPre}leadNotes where leadID='$leadID' order by dateAdded desc";
$notes = $db->extQuery($sql);

$sql = "select * from {$dbPre}leadSource order by sourceName asc";
$leadSource = $db->extQuery($sql);
$sql = "select * from {$dbPre}leadType order by typeName asc";
$leadType = $db->extQuery($sql);
$sql = "select * from {$dbPre}leadStatus order by statusName asc";
$leadStatus = $db->extQuery($sql);

$sql = "select * from {$dbPre}users where id='$lead->lastModifiedBy'";
$lastModified = $db->extQueryRowObj($sql);

$sql = "select * from {$dbPre}siteSettings";
$siteSettings = $db->extQueryRowObj($sql);

$ownLeads = false;
if ($access == 2) { // user
    if ($_SESSION['ownLeadsOnly'] == 1) { //own Leads
        $ownLeads = true;
    }
}

if ($ownLeads == true) {
    $sql = "select * from {$dbPre}users where id='{$_SESSION['userID']}'";
} else {
    $sql = "select * from {$dbPre}users order by last asc";
}
$Owners = $db->extQuery($sql);

?>
<script>
var token = "<?php echo $token; ?>";
var access = "<?php echo $access; ?>";
var leadSources = {};
leadSources = ( <?php echo json_encode($leadSource);?> );

var leadTypes = {};
leadTypes = ( <?php echo json_encode($leadType);?> );

var leadStatuss = {};
leadStatuss = ( <?php echo json_encode($leadStatus);?> );

var siteSettings = {};
siteSettings = ( <?php echo json_encode($siteSettings);?> );

var Owners = {};
Owners = ( <?php echo json_encode($Owners);?> );


$(document).on('click', '.envialead', function() { // envia o lead por email 
    var leadID = $(this).attr('class').split(' ')[1].replace(/\D+/g,'');
    var leadName = $(this).closest('tr').find('.viewLead').text();
    var email =$('#mail').val(); 
    var owner =$('.leadOwner').val();
    var content = '<h3 class="modalH">Enviar lead por email  ???</h3>'
                + '<p class="leadDelete ' + leadID + '">Deseja enviar o lead <b>' + leadName + '  por E-mail ?</b></p>'
        
        
        +'<table class="contactInfo"><tbody><tr><td class="leadField">Email do Destinatário: </td><td><input id="mail" type="text" class="email" value="" tabindex="13"></td>'
    + '<p> Para multiplos destinatários separe os emails com virgula</p><br>'
    +'<p>ou selecione abaixo os clientes pré selecionados pelo sistema</p>'
            + '<tr><td class="leadField">' + siteSettings.assignedTo + ':</td>' 
    
    
      + '<td class="selectDrop"><select class="leadOwner">'; 
      
    $.each(Owners, function(key, val) {
                  content += '<option value="' + val.id + '">' + val.first + ' ' + val.last + '</option>'
       
                      
    });
               
            
         content +=    '</tr></tbody></table>'
      //   + '<div id=""infolead > <p>teste</p>'
 + '</div>'
                                 
                + '<p class="buttonRow"><button class="buttons redButton envialeadLeadConf">Enviar </button>&nbsp;&nbsp;'
                + '<button class="closeModal buttons blueButton">Cancelar</button></p>';
      //  $.each(Owners, function(key, val) {
                  //  content += '<option value="' + val.id + '">' + val.first + ' ' + val.last + '</option>';

           
                
         
    $(content).modal({onOpen: function (dialog) {
        dialog.overlay.fadeIn('fast', function () {
            dialog.container.fadeIn('fast', function () {
                dialog.data.fadeIn('fast');
            });
        });
        
      
    }, minHeight:240});
    return false;
}); // });


$(document).on('click', '.envialeadLeadConf', function() {  // Continue removing Lead
   var leadID = $('.leadDelete').attr('class').split(' ')[1];
    var email =$('#mail').val(); 
     var owner =$('.leadOwner').val();
    // var leadID = $('.enviaLead').attr('class');//.split('=')[1];
    var type = 'enviaLead';
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "enviamail.php",  
        
       
        
    //  data:  {type:type, firstName:firstName, lastName:lastName, phone:phone, secondaryPhone:secondaryPhone,
     //          fax:fax, email:email, secondaryEmails:secondaryEmails, address:address, zipCode:zipCode,
     //          city:city, state:state, country:country, leadSource:leadSource, leadType:leadType, leadStatus:leadStatus,
       //        customField:customField, customField2:customField2, customField3:customField3, token:token,
          //     existing:existing, id:id, leadOwner:leadOwner},
        
         data: {type:type, token:token , leadID:leadID , email:email,owner:owner},  
        success: function(response) {
           if (response.result == '1') {
                $('.enviaLead.lead' + leadID);
                $.modal.close();
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});

</script>
<!-- Lead specific js file -->
<script type="text/javascript" src="js/lead.js"></script>

<div class="outer">
  <p class="backLink">
    <a href="index.php?<?php echo $_SESSION['leadsQ']; ?>">
    <img src='img/subscription.png' alt='Voltar' /> Voltar para os Leads </a>
  </p>
  <div class="individualDiv">
    <div class="leadDetails" style="table-layout: fixed;width: 350px;word-wrap: break-word;">
      <h2 class="left">Detalhes</h2>
      <p>
      <?php if ($access != 0) { ?>
        <a href="#" class="addEditContact exists lead<?php echo $lead->id; ?>">
          <img src="img/table_edit.png" alt='Edit' />&nbsp;&nbsp;Editar</a>      
      <?php } ?>
          <a href='#' class='envialead lead<?php echo $lead->id;?>'><img src='img/email1.png' alt='Delete' title='Eviar Lead por Email' />&nbsp;&nbsp;Enviar Lead</a>
      </p>
      
      <h2 class="modalH"><?php echo "ID# ".$lead->id."<br>  ". $lead->firstName . ' ' . $lead->lastName; ?></h2>
      <hr class="thinLine">
      <table class="individualLead">
        <tr class="trClass0"><td class="leadLabel"><?php echo $siteSettings->Address; ?>:</td>
             <td class="leadData"><?php echo $lead->Address; ?></td></tr>
        <tr class="trClass0"><td class="leadLabel"><?php //echo $siteSettings->nend; ?>Nº:</td>
             <td class="leadData"><?php echo $lead->nend; ?></td></tr>
        
        <?php //cf17 inicio
        if ($lead->customField20 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField20; ?>:</td>
          <td class="leadData"><?php echo $lead->customField20; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
        <tr class="trClass1"><td class="leadLabel"><?php echo $siteSettings->City; ?>:</td>
            <td class="leadData"><?php echo $lead->City; ?></td></tr>
        <tr class="trClass0"><td class="leadLabel"><?php echo $siteSettings->State; ?>:</td>
            <td class="leadData"><?php echo $lead->State; ?></td></tr>
       
        
        <tr class="trClass1"><td class="leadLabel"><?php echo $siteSettings->Zip; ?>: </td>
            <td class="leadData"><?php echo $lead->Zip; ?></td></tr>
        <tr class="trClass0"><td class="leadLabel"><?php echo $siteSettings->Phone; ?>: </td>
            <td class="leadData"><?php echo $lead->Phone ?></td></tr>
        
         <tr class="trClass0"><td class="leadLabel"><?php echo $siteSettings->operadora; ?>: </td>
            <td class="leadData"><?php echo $lead->operadora ?></td></tr>

        <tr class="trClass1"><td class="leadLabel"><?php echo $siteSettings->secondaryPhone; ?>: </td>
            <td class="leadData"><?php echo $lead->secondaryPhone; ?></td></tr>
        <tr class="trClass0"><td class="leadLabel"><?php echo $siteSettings->Fax; ?>: </td>
            <td class="leadData"><?php echo $lead->Fax; ?></td></tr>
        <tr class="trClass1"><td class="leadLabel">Email: </td><td class="leadData"><?php echo $lead->Email; ?></td></tr>
        <?php 
        $i = 1;
        foreach ($otherEmails as $row => $email) {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel">Email Secundario: </td><td class="leadData"><?php echo $email->email; ?></td>
        </tr>
        <?php } 
        
       
        $dateAdded = strtotime($lead->dateAdded);
        $dateSearch = date('Y-m-d', $dateAdded);
        $dateAdded = date('m-d-Y', $dateAdded);
        $lastModifiedBy = isset($lastModified->userName) != '' ? $lastModified->userName : 'Usuário removido';
        if ($lead->customField != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
            <td class="leadLabel"><?php echo $siteSettings->customField1; ?>:</td>
            <td class="leadData"><?php echo $lead->customField; ?></td>
        </tr>
        <?php } 
        if ($lead->customField2 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField2; ?>:</td>
          <td class="leadData"><?php echo $lead->customField2; ?></td>
        </tr>
        <?php }
        if ($lead->customField3 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField3; ?>:</td>
          <td class="leadData"><?php echo $lead->customField3; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        ?>
        
        
        <?php //idade
        if ($lead->idade != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->idade; ?>Idade :</td>
          <td class="leadData"><?php echo $lead->idade; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        <?php //tipoplano inicio
        if ($lead->customField4 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField4; ?>:</td>
          <td class="leadData"><?php echo $lead->customField4; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
        
         <?php //cf5  inicio
        if ($lead->customField5 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField5; ?>:</td>
          <td class="leadData"><?php echo $lead->customField5; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
         <?php //cf6 inicio
        if ($lead->customField6 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField6; ?>:</td>
          <td class="leadData"><?php echo $lead->customField6; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
        
         <?php //cf7 inicio
        if ($lead->customField7 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField7; ?>:</td>
          <td class="leadData"><?php echo $lead->customField7; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
                
                
        
        //ref fim ?>
        
         <?php //cf8 inicio
        if ($lead->customField8 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField8; ?>:</td>
          <td class="leadData"><?php echo $lead->customField8; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf9 inicio
        if ($lead->customField9 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField9; ?>:</td>
          <td class="leadData"><?php echo $lead->customField9; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf10 inicio
        if ($lead->customField10 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField10; ?>:</td>
          <td class="leadData"><?php echo $lead->customField10; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf11 inicio
        if ($lead->customField11 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField11; ?>:</td>
          <td class="leadData"><?php echo $lead->customField11; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf12 inicio
        if ($lead->customField12 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField12; ?>:</td>
          <td class="leadData"><?php echo $lead->customField12; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
         <?php //cf13 inicio
        if ($lead->customField13 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField13; ?>:</td>
          <td class="leadData"><?php echo $lead->customField13; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf14 inicio
        if ($lead->customField14 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField14; ?>:</td>
          <td class="leadData"><?php echo $lead->customField14; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
         <?php //cf15 inicio
        if ($lead->customField15 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField15; ?>:</td>
          <td class="leadData"><?php echo $lead->customField15; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf16 inicio
        if ($lead->customField16 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField16; ?>:</td>
          <td class="leadData"><?php echo $lead->customField16; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf17 inicio
        if ($lead->customField17 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField17; ?>:</td>
          <td class="leadData"><?php echo $lead->customField17; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
        <?php //cf17 inicio
        if ($lead->customField117 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField17; ?>:</td>
          <td class="leadData"><?php echo $lead->customField17; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
        
        
        
        <?php //cf18 inicio
        if ($lead->customField18 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField18; ?>:</td>
          <td class="leadData"><?php echo $lead->customField18; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
        
         <?php //cf18 inicio
        if ($lead->customField20 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField20; ?>:</td>
          <td class="leadData"><?php echo $lead->customField20; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //ref inicio
        if ($lead->quantlinhas != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->quantlinhas; ?>Quant Linhas:</td>
          <td class="leadData"><?php echo $lead->quantlinhas; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
       
        
         <?php //cf11 inicio
         
          // campos extra 20-30 
        if ($lead->customField21 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField21; ?>:</td>
          <td class="leadData"><?php echo $lead->customField21; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf12 inicio
        if ($lead->customField22 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField22; ?>:</td>
          <td class="leadData"><?php echo $lead->customField22; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
         <?php //cf13 inicio
        if ($lead->customField23 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField23; ?>:</td>
          <td class="leadData"><?php echo $lead->customField23; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf14 inicio
        if ($lead->customField24 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField24; ?>:</td>
          <td class="leadData"><?php echo $lead->customField24; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
         <?php //cf15 inicio
        if ($lead->customField25 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField25; ?>:</td>
          <td class="leadData"><?php echo $lead->customField25; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf16 inicio
        if ($lead->customField26 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField26; ?>:</td>
          <td class="leadData"><?php echo $lead->customField26; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //cf17 inicio
        if ($lead->customField27 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField27; ?>:</td>
          <td class="leadData"><?php echo $lead->customField27; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
        <?php //cf17 inicio
        if ($lead->customField29 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField29; ?>:</td>
          <td class="leadData"><?php echo $lead->customField29; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
        
        
        
        <?php //cf18 inicio
        if ($lead->customField30 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField30; ?>:</td>
          <td class="leadData"><?php echo $lead->customField30; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
         //fim dos extra 20-30
        //ref fim ?>
        
        
        
         <?php //cf18 inicio
        if ($lead->customField19 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField19; ?>:</td>
          <td class="leadData"><?php echo $lead->customField19; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
         <?php //ref inicio
        if ($lead->quantlinhas != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->quantlinhas; ?>Quant Linhas:</td>
          <td class="leadData"><?php echo $lead->quantlinhas; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
       
        
        
        
        
        
        
          <?php //ref inicio
        if ($lead->planopjatual != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->planopjatual; ?>Plano Pj Atual:</td>
          <td class="leadData"><?php echo $lead->planopjatual; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
        
          <?php //cf8 inicio
        if ($lead->customField8 != '') {
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel"><?php echo $siteSettings->customField8; ?>:</td>
          <td class="leadData"><?php echo $lead->customField8; ?></td>
        </tr>
        <?php } 
        $i++;
        $alt = $i & 1
        
        
        
        //ref fim ?>
        
     <?php    $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel">Necessidades : </td><td class="leadData"><?php echo $lead->falarsobrenecessidade; ?></td></tr>
        <?php 
        $i++;
        $alt = $i & 1;
        ?>
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel">Origem(Source): </td><td class="leadData"><?php echo $lead->sourceName; ?></td></tr>
        
        
        
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel">Status: </td>
          <td class="leadData"><?php echo $lead->statusName; ?></td>
        </tr>
        
        <tr class="trClass<?php echo $alt;?>">
          <td class="leadLabel">Motivo: </td>
          <td class="leadData"><?php echo $lead->motivo; ?></td>
        </tr>
      </table>
      <div class="userData">
        Data de Entrada: 
        <a href="index.php?search=<?php echo $dateSearch;?>&amp;searchCol=dateAdded" title="Go to all Leads added this date.">
          <?php echo $dateAdded;?></a><br />
        Ultima Modificação por: <span class="userHighlight"><b><?php echo $lastModifiedBy; ?></b> 
         on <?php echo $lead->dateModified; ?></span></div>
    </div>
    <div class="leadNotes">
      <h3 class="modalH">Observações</h3>
      <?php if ($access != 0) { ?>
      <p><a href="#" class="addNote <?php echo $leadID; ?>"><img src="img/add.png" alt='Add Observação :' />&nbsp;&nbsp;Add Observação</a></p>
      <?php } ?>
      <div class="notesSec">
        <?php
        if (!$notes) {
        ?>
        <div class="noteContent noNotes"><span class="notice">Ainda não existem observações para o lead </span></div>
        <hr class="thinLine">
        <?php 
        } else {
            foreach ($notes as $row => $note) {
                $where = array (
                    'id' => $note->creator
                );
                $creator = $db->get_value("{$dbPre}users",'userName', $where);
                $creator = ($creator == '') ? 'Usuario removido' : $creator;
                $noteDate = strtotime($note->dateAdded);
                $noteDate = date('m-d-Y H:i:s', $noteDate);
        ?>
        <div class="noteContainer <?php echo $note->id; ?>">
          <div class="noteContent"><?php echo $note->Note; ?></div>
          <div class="userData">
            Escrito por :: <span class="userHighlight"><?php echo '<b>' . $creator . '</b> ' . $noteDate;?></span>
            <?php if ($access != 0) { ?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="editNote <?php echo $note->id;?>">Editar Obs:</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="removeNote <?php echo $note->id;?>">Remover Obs:</a>
            <?php } ?>
          </div>
          <hr class="thinLine">
        </div>
        <?php 
            }
        }
        ?>
      </div>


      </div>
    </div>
  </div>
</div>
<div class="push"></div>

<?php
require_once 'footer.php';
?>
