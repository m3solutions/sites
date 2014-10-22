// leads.js - javascript and jQuery for index.php (leads page)
//

$(document).on('click', '.addEmail', function() {         // Add another email to form up to 3
    var inc = 1;
    $('.secondaryEmail').each(function() {
        inc++;
    });
    var content = '<tr><td class="leadField">Secondary Email:</td><td><input type="text" class="secondaryEmail" /></td></tr>';
    $('.contactInfo').append(content);
    $('.addEmail').prop('checked', false);
    if (inc >= 3) {
        $('.addEmail').closest('tr').hide();
        return false;
    }
});

$(document).on('click', '.addEditContact', function() {           // Add or Edit a Contact
    var Address = '';
    var City = '';
    var Country = '';
    var Email = '';
    var Fax = '';
    var Phone = '';
    var secondaryPhone = '';
    var State = '';
    var Zip = '';
    var firstName = '';
    var lastName = '';
    var id = '';
    var idade = '';
    var sourceName = '';
    var statusName = '';
    var typeName = '';
    var existing = '';
    var customField = '';
    var customField2 = '';
    var customField3 = '';
    var otherEmails = {};
    var Owner = '';
    var operadora ='';
    if ($(this).hasClass('exists')) {  // Existing
    
        var type = 'editLead';
        var leadID = $(this).attr('class').split(' ')[2].replace(/\D+/g,'');
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            encoding: 'uft-8',
            data: {type:type, leadID:leadID, token:token},  
            
           
            success: function(response) {
                if (response.result == '1') {
                    var lead = response.lead;

                    existing = 'existing';
                    Address        = lead.Address;
                    City           = lead.City;
                    Country        = lead.Country;
                    Email          = lead.Email;
                    Fax            = lead.Fax;
                    Phone          = lead.Phone;
                    secondaryPhone = lead.secondaryPhone;
                    State          = lead.State;
                    Zip            = lead.Zip;
                    firstName      = lead.firstName;
                    lastName       = lead.lastName;
                    id             = lead.id;
                    sourceName     = lead.sourceName;
                    statusName     = lead.statusName;
                    typeName       = lead.typeName;
                    customField    = lead.customField;
                    customField2   = lead.customField2;
                    customField3   = lead.customField3;
                    idade          = lead.idade;
                    otherEmails    = response.otherEmails;
                    Owner          = lead.assignedTo;
                    operadora = lead.operadora; 
                    createForm(existing, Address, City, Country, Email, Fax, Phone, secondaryPhone, State, Zip, firstName,
                               lastName, id, sourceName, statusName, typeName, otherEmails, 
                               customField, customField2, customField3, Owner,operadora);
                } else {
                    alert('There was a communication problem, please try again.');
                }
            }
        });
    } else {                        // New Lead
        createForm(existing, Address, City, Country, Email, Fax, Phone, secondaryPhone, State, Zip, firstName,
                   lastName, id, sourceName, statusName, typeName, otherEmails, 
                   customField, customField2, customField3, Owner,idade,operadora);
    }
});

function createForm(existing, Address, City, Country, Email, Fax, Phone, secondaryPhone, State, Zip, firstName,  // Build the form
                    lastName, id, sourceName, statusName, typeName, otherEmails, 
                    customField, customField2, customField3, Owner,idade,operadora) {
    if (existing == 'existing') {
        var modalTitle = 'Editar Lead ';
    } else {
        var modalTitle = 'Add Novo Lead ';
    }
    var otherEmailsCount = otherEmails.length;
    if (otherEmailsCount >= 3) {
        var hideAdd = 'hidden';
    } else {
        var hideAdd = '';
    }
    var content = '<h3 class="modalH">' + modalTitle + '</h3>'
                + '<fieldset><legend>Informações de Contato</legend>'
                + '<table class="contactInfo">'
                + '<tr><td class="leadField">Nome :</td>'
                + '<td><input type="text" class="firstName" value="' + firstName + '" /></td>'
                + '<td class="secCol">' + siteSettings.Phone 
                + ':</td><td><input type="text" class="phone" value="' + Phone + '" /></td>'
                + '<tr><td class="leadField">Sobrenome :</td>'
                + '<td><input type="text" class="lastName" value="' + lastName + '" /></td>'
              
            + '<td class="secCol">' + siteSettings.secondaryPhone + ':</td>'
                + '<td><input type="text" class="secondaryPhone" value="' + secondaryPhone + '" /></td></tr>'
                + '<tr><td class="leadField">Email Principal: </td>'
                + '<td><input type="text" class="email" value="' + Email + '" /></td>'
                + '<td>' + siteSettings.Fax + ':</td><td><input type="text" class="fax" value="' + Fax + '" /></td>'
        
         + '<tr><td class="leadField">Idade :</td>'
            + '<td><input type="text" class="idade" value="' + siteSettings.idade + '" /></td>'   
       
            
             + '<td class="leadField">Operadora : </td>' 
           //  <td class="selectDrop"><select class="operadora">';

         +'<td class="selectDrop"><select class="operadora" >'
+'<option value="null" selected="selected">Selecione operadora </option><option value="Tim">Tim</option> <option value="Vivo">Vivo</option><option value="Claro">Claro</option><option value="Oi">Oi</option><option value="Nextel">Nextel</option></select></td>'



          //     +'<option value="1">tim</option>';
       //        +'</select></td>'
       
    
            + '<tr class="' + hideAdd + '"><td></td><td></td><td></td><td>Add Email?: '
            
            
            
            + '<input type="checkbox" class="addEmail"/></td></tr>'
                + '</table></fieldset><br />'
                + '<fieldset><legend>Endereço</legend>'
                + '<table class="leadAddress">'
                + '<tr><td class="leadField">' + siteSettings.Address + ':</td><td><input type="text" class="address" value="' 
                + Address + '" /></td>'
                + '<td>' + siteSettings.State + ':</td><td><input type="text" class="state" value="' 
                + State + '" /></td></tr>'
                + '<tr><td class="leadField">' + siteSettings.City + ':</td><td><input type="text" class="city" value="' 
                + City + '" /></td>'
                + '<td>' + siteSettings.Country + ':</td><td><input type="text" class="country"'
                + 'value="' + Country + '" /></td></tr>'
                + '<tr><td class="leadField">' + siteSettings.Zip + ':</td><td><input type="text" class="zipCode" value="' 
                + Zip + '" /></td>'
                + '<td></td>'
                + '<td></td></tr>'
                + '</table></fieldset><br />'
                + '<fieldset><legend>Outras Informações</legend>'
                + '<table class="leadCategory">'
                + '<tr><td class="leadField">Origem: </td><td class="selectDrop"><select class="leadSource">';

                $.each(leadSources, function(key, val) {
                        content += '<option value="' + val.sourceID + '">' + val.sourceName + '</option>';
                });
                content += '</select></td>'
                        + '<td class="leadField">' + siteSettings.customField1 + ':</td>'
                        + '<td><input type="text" class="customField" value="' + customField + '" /></td></tr>'
                        + '<tr><td class="leadField">Tipo: </td><td class="selectDrop"><select class="leadType">';

                $.each(leadTypes, function(key, val) {
                        content += '<option value="' + val.typeID + '">' + val.typeName + '</option>';
                });
                content += '</select></td>'
                        + '<td class="leadField">' + siteSettings.customField2 + ':</td>'
                        + '<td><input type="text" class="customField2" value="' + customField2 + '" /></td></tr>'
                        + '<tr><td class="leadField">Status: </td><td class="selectDrop"><select class="leadStatus">';

                $.each(leadStatuss, function(key, val) {
                        content += '<option value="' + val.id + '">' + val.statusName + '</option>';
                }); 
                
                content += '</select></td>'
                        + '<td class="leadField">' + siteSettings.customField3 + ':</td>'
                        + '<td><input type="text" class="customField3" value="' + customField3 + '" /></td></tr>'
                        + '<tr><td class="leadField">' + siteSettings.assignedTo + ':</td>'
                        + '<td class="selectDrop"><select class="leadOwner">';

                $.each(Owners, function(key, val) {
                        content += '<option value="' + val.id + '">' + val.first + ' ' + val.last + '</option>';
                });
                
                content += '</select></td></tr>'
                + '</table>'
                + '</fieldset>'
                + '<p class="buttonRow">'
                + '<button class="buttons greenButton saveLead ' + existing + ' ' + id + '">Salvar</button>&nbsp;&nbsp;'
                + '<button class="closeModal buttons blueButton">Cancelar</button></p>';

    $(content).modal({onOpen: function (dialog) {
        dialog.overlay.fadeIn('fast', function () {
            dialog.container.fadeIn('fast', function () {
                dialog.data.fadeIn('fast');
            });
        });
    }, minHeight:640});

    // Set pre selected variables for existing leads
    if (existing == 'existing') {
        $('.leadSource option').filter(function() {   // Set lead source
            return $(this).text() == sourceName;
        }).attr('selected', true);

        $('.leadType option').filter(function() {     // Set lead type
            return $(this).text() == typeName;
        }).attr('selected', true);
        
        $('.leadStatus option').filter(function() {   // Set lead status
            return $(this).text() == statusName;
        }).attr('selected', true);

        $('.leadOwner option').filter(function() {    // Set Owner
            return $(this).val() == Owner;
        }).attr('selected', true);
        
         $('.operadora option').filter(function() {   // Set operadora
            return $(this).text() == operadora;
        }).attr('selected', true);

        $.each(otherEmails, function(key, val) {
        //otherEmails.each(function (i, val) {          // Add other emails
        var content = '<tr><td class="leadField"> Email Secundario:</td>'
                    + '<td><input type="text" class="secondaryEmail" value="' + val.email + '" /></td></tr>';
        $('.contactInfo').append(content);
        });
    }

    $(":input").each(function (i) { $(this).attr('tabindex', i + 1); });
    return false;
};

$(document).on('keydown', ':input', function(e) {   // tabbing correction on dynamic forms (remember to re-index them)
    var keyCode = e.keyCode || e.which;     
    if (keyCode == 9) {  
        var curTab = $(this).attr('tabindex');
        if (e.shiftKey) {
            curTab--;
        } else {
            curTab++;
        }
        $(":input[tabindex='"+curTab+"']").focus();
        return false;
    }
});
//funcao js da pre selecao 


function pegaclientes(leadID) {
 
 var id = '';
 
   // var leadID = $(this).attr('class').split(' ')[1].replace(/\D+/g,'');
 return   $.ajax({
   
        url: 'cliajax.php',
        type: "POST",  
        dataType: 'json',
      
        data: { leadID:leadID, id:id},  
     
     
     success: function(data1) { 
     
      dado = $(data1);
        
        
       
   //  console.log(dado);
    
     //     alert(dado);
}
        
     

                  
                  
                  //       $.each(jQuery.parseJSON(result_array) 
  
                 //   var lead = response.lead;
        // var options = "";
        //    $.each(leadOwner, function(key, value){
        //       options += '<option value="' + key + '">' + value + '</option>';
      //      });
       //     $("#leadOwner").html(options);            
        
           
                });
} 



// funcão de envio de email 

$(document).on('click', '.envialead', function() { // envia o lead por email 
   // passar aqui os parametros pra consulta e pegar retorno 
       
     
    var leadID = $(this).attr('class').split(' ')[1].replace(/\D+/g,'');
    pegaclientes(leadID);
    var listagem =  pegaclientes(leadID);
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
      + '<option value=""> selecione...</option>';
      listagem.success(function (data1) {

var id = data1; 
   //  alert(id);   
          $.each(id , function(key, value) {
        //      $.each(value, function(attr, value1) {
                     
                  console.log(  value.nome );
                           // console.log(key + '=' + value);
 //content +=     $('.leadOwner').append($('<option>').text(value).attr('value' ,value.nome ));
               //  content += '<option value="' + value.nome + '">' + value.nome + '</option>';
        
        var   nome = value.nome;
var opt = '<option value="' + value.id + '"> '+value.nome +'</option>';
  $('.leadOwner').append(opt);
          
          });
      //      
      //       
      //         dado = $(data1);
      
            
 // content += '<option value="' + key + '">' + value + '</option>';    
                    
  //  });    
              
         });   
         content +=    '</select></tr></tbody></table>' 
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




//fim da função 


// funcão de status do lead  

$(document).on('click', '.statusleadlead', function() { // atualiza o status do lead  
    var leadID = $(this).attr('class').split(' ')[1].replace(/\D+/g,'');
    var leadName = $(this).closest('tr').find('.viewLead').text();
   var email =$('#mail').val(); 
   var status = $('leadStatus').val();
    var motivo = $('leadmotivo').val();
   // variavel do status e motivo 
    var content = '<h3 class="modalH">Atualizar Status do Lead   ???</h3>'
                + '<p class="leadDelete ' + leadID + '">Deseja Alterar o status do lead <b>' + leadName + '   ?</b></p>'
               
        +'<table class="atualizalead"><tbody><tr> '
        + '<td class="leadField">Status:'
        + '</td><td class="selectDrop"><select class="leadStatus" >';
        
       
           $.each(leadStatuss, function(key, val) {
                        content += '<option value="' + val.id + '">' + val.statusName + '</option>';
                });
                content += '</select></td></tr></tr>'
                
                
                + '</table>'
                +'<table class="atualizalead"><tbody><tr> '
        + '<td class="leadField">Motivo:'
                 + '</td><td class="selectDrop"><select class="leadmotivo" >';
        
       
         $.each(leadmotivo, function(key, val) {
                        content += '<option value="' + val.motivo + '">' + val.motivo + '</option>';
                });
             content += '</select></td></tr></tr>'
                
                
                + '</table>'
  
  
                
      
   
         //  +'Digite o E-mail para onde o Lead sera enviado: '+'<br>'

			//	+'<input type="text" class="leadField" value="" >'
                        
                + '<p class="buttonRow"><button class="buttons redButton atualizaLeadConf">Atualizar </button>&nbsp;&nbsp;'
                + '<button class="closeModal buttons blueButton">Cancelar</button></p>';
      //  $.each(Owners, function(key, val) {
                  //  content += '<option value="' + val.id + '">' + val.first + ' ' + val.last + '</option>';

            
                
         
    $(content).modal({onOpen: function (dialog) {
        dialog.overlay.fadeIn('fast', function () {
            dialog.container.fadeIn('fast', function () {
                dialog.data.fadeIn('fast');
            });
        });
        
      
    }, minHeight:190});
    return false;
}); // });




//fim da função 




$(document).on('click', '.deleteLead', function() { // Delete the lead
    var leadID = $(this).attr('class').split(' ')[1].replace(/\D+/g,'');
    var leadName = $(this).closest('tr').find('.viewLead').text();
    var content = '<h3 class="modalH">Apagar Lead ???</h3>'
                + '<p class="leadDelete ' + leadID + '">Tem certeza que quer excluir o Lead ?   <b>' + leadName + '?</b></p>'
                + '<p class="buttonRow"><button class="buttons redButton deleteLeadConf">Apagar </button>&nbsp;&nbsp;'
                + '<button class="closeModal buttons blueButton">Cancel</button></p>';
    $(content).modal({onOpen: function (dialog) {
        dialog.overlay.fadeIn('fast', function () {
            dialog.container.fadeIn('fast', function () {
                dialog.data.fadeIn('fast');
            });
        });
    }, minHeight:150});
    return false;
});

$(document).on('click', '.deleteLeadConf', function() {  // Continue removing Lead
    var leadID = $('.leadDelete').attr('class').split(' ')[1];
    var type = 'deleteLead';
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "ajax/ajaxFunctions.php",  
        data: {type:type, leadID:leadID, token:token},  
        success: function(response) {
           if (response.result == '1') {
                $('.deleteLead.lead' + leadID).closest('tr').remove();
                $.modal.close();
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});


// funcao de atualicao do lead 

$(document).on('click', '.atualizaLeadConf', function() {  // Continue removing Lead
   var leadID = $('.leadDelete').attr('class').split(' ')[1];
    var email =$('#mail').val(); 
    // var leadID = $('.enviaLead').attr('class');//.split('=')[1];
    var status =$('.leadStatus').val()
    var motivo =$('.leadmotivo').val();
    var type = 'statusLead';
    
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "statuslead.php",  
        
       
        
    //  data:  {type:type, firstName:firstName, lastName:lastName, phone:phone, secondaryPhone:secondaryPhone,
     //          fax:fax, email:email, secondaryEmails:secondaryEmails, address:address, zipCode:zipCode,
     //          city:city, state:state, country:country, leadSource:leadSource, leadType:leadType, leadStatus:leadStatus,
       //        customField:customField, customField2:customField2, customField3:customField3, token:token,
          //     existing:existing, id:id, leadOwner:leadOwner},
        
         data: {type:type, token:token , leadID:leadID , email:email,status:status, motivo:motivo},  
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




//fim da funcao




//envialeadconf

$(document).on('click', '.envialeadLeadConf', function() {  // Continue removing Lead
   var leadID = $('.leadDelete').attr('class').split(' ')[1];
    var email =$('#mail').val(); 
    // var leadID = $('.enviaLead').attr('class');//.split('=')[1];
    var type = 'enviaLead';
     var owner =$('.leadOwner').val();
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "enviamail.php",  
        
       
        
    //  data:  {type:type, firstName:firstName, lastName:lastName, phone:phone, secondaryPhone:secondaryPhone,
     //          fax:fax, email:email, secondaryEmails:secondaryEmails, address:address, zipCode:zipCode,
     //          city:city, state:state, country:country, leadSource:leadSource, leadType:leadType, leadStatus:leadStatus,
       //        customField:customField, customField2:customField2, customField3:customField3, token:token,
          //     existing:existing, id:id, leadOwner:leadOwner},
        
         data: {type:type, token:token , leadID:leadID , email:email,owner:owner },  
        success: function(response) {
           if (response.result == '1') {
                $('.enviaLead.lead' + leadID);
                
                $.modal.close();
                alert('Email Enviado com Sucesso!!!');
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  
});


//fim
    

$(document).on('click', '.saveLead', function() {  // save the lead
    var existing = '';
    var id = '';
    if ($(this).hasClass('existing')) {
        existing = 'existing';
        id = $(this).attr('class').split(' ')[4];
    } 
    var firstName = $('.firstName').val();
    var lastName = $('.lastName').val();
    var phone = $('.phone').val();
    var secondaryPhone = $('.secondaryPhone').val();
    var fax = $('.fax').val();
    var email = $('.email').val();
    var secondaryEmails = {};
    var inc = 0;
    $('.secondaryEmail').each(function() {
        inc++;
        secondaryEmails[inc] = {
            email: $(this).val()
        }
    });
    var secondaryEmails = JSON.stringify(secondaryEmails);
    var address = $('.address').val();
    var zipCode = $('.zipCode').val();
    var city = $('.city').val();
    var state = $('.state').val();
    var country = $('.country').val();
    var leadSource = $('.leadSource').val();
    var leadType = $('.leadType').val();
    var leadStatus = $('.leadStatus').val();
    var customField = $('.customField').val();
    var customField2 = $('.customField2').val();
    var customField3 = $('.customField3').val();
    var leadOwner    = $('.leadOwner').val();
    var motivo = $('.motivo').val(); 
    var operadora = $ ('.operadora'). val();

    var type = 'saveLead';
    $.ajax({  
        type: "POST",  
        dataType: 'json',
        url: "ajax/ajaxFunctions.php",  
         
        data: {type:type, firstName:firstName, lastName:lastName, phone:phone, secondaryPhone:secondaryPhone,
               fax:fax, email:email, secondaryEmails:secondaryEmails, address:address, zipCode:zipCode,
               city:city, state:state, country:country, leadSource:leadSource, leadType:leadType, leadStatus:leadStatus,
               customField:customField, customField2:customField2, customField3:customField3, token:token,
               existing:existing, id:id, leadOwner:leadOwner, motivo:motivo, operadora:operadora},
        success: function(response) {
           if (response.result == '1') {
                var insert = response.insertID
                var data = '<tr class="justAdded">';
                $.each(response.sortOrder, function(key, val) { 
                    if (val.setName == 'Name') {
                         data += '<td><a href="#" class="addEditContact exists lead' + insert + '">'
                         + '<img src="img/table_edit.png" title="Edit" /></a>&nbsp;&nbsp;'
                         + '<a href="#" class="deleteLead lead' + insert + '"><img src="img/delete.png" title="Delete" />'
                         + '</a>&nbsp;&nbsp;'
                         + '<a href="lead.php?lead=' + insert + '" class="viewLead" title="Go view this Contact">'
                         + firstName + ' ' + lastName + '</a></td>';
                    } else if (val.setName == 'Address' ) {
                        data += '<td>' + address + '</td>';
                    } else if (val.setName == 'Phone' ) {
                        data += '<td>' + phone + '</td>';
                    } else if (val.setName == 'Primary Email' ) {
                        data += '<td>' + email + '</td>';
                    } else if (val.setName == 'Source' ) {
                        data += '<td>' + response.sourceName + '</td>';
                    } else if (val.setName == 'Type' ) {
                        data += '<td>' + response.typeName + '</td>';
                    } else if (val.setName == 'secondaryPhone' ) {
                        data += '<td>' + secondaryPhone + '</td>';
                    } else if (val.setName == 'Fax' ) {
                        data += '<td>' + fax + '</td>';
                    } else if (val.setName == 'City' ) {
                        data += '<td>' + city + '</td>';
                    } else if (val.setName == 'State' ) {
                        data += '<td>' + state + '</td>';
                    } else if (val.setName == 'Country' ) {
                        data += '<td>' + country + '</td>';
                    } else if (val.setName == 'Zip' ) {
                        data += '<td>' + zipCode + '</td>';
                    } else if (val.setName == 'Date Added' ) {
                        data += '<td>' + response.vals.dateAdded + '</td>';
                    } else if (val.setName == 'customField' ) {
                        data += '<td>' + response.vals.customField + '</td>';
                    } else if (val.setName == 'customField2' ) {
                        data += '<td>' + response.vals.customField2 + '</td>';
                    } else if (val.setName == 'customField3' ) {
                        data += '<td>' + response.vals.customField3 + '</td>';
                    } else if (val.setName == 'Owner' ) {
                        data += '<td>' + response.ownerName + '</td>';
                    }
                });
                    data += '</tr>';

                if (existing =='existing') {
                    $('.deleteLead.lead' + insert).closest('tr').replaceWith(data);
                } else {
                    $('.allLeads').append(data);
                }
                $.modal.close();
                $('.deleteLead.lead' + insert).closest('tr').animate({
                    backgroundColor: "#99FF99",
                    color: "#000",
                    width: 240
                }, 1000 );
                return false;
            } else {
                alert(response.msg);
            }
        }
    });  


});

$(document).on('click', '.goSearch', function() {
    goSearch();
});


$(document).on('keydown', '.searchText', function(e) {    // Submit search on enter key
    if (e.keyCode == 13) {
        goSearch();
    }
});

function goSearch() {
    var searchCol = $('.searchColumn').val();
    // var statusSelect is defined globally

    if (searchCol == 'leadSource') {
        var searchVal = $('.leadSources').val();

    } else if (searchCol == 'leadType') {
        var searchVal = $('.leadTypes').val();

    } else if (searchCol == 'assignedTo') {
        var searchVal = $('.Owners').val();

    } else {
        var searchVal = $('.searchText').val();
    }
    var url = 'index.php?search=' + searchVal + '&searchCol=' + searchCol + '&status=' + statusSelect;
    window.location = url;
};

$(document).on('click', '.closeModal', function() {
    $.modal.close();
});

$(document).ready(function () {                         // highlight changes

    $.fn.animateHighlight = function (highlightColor, duration) {
        var highlightBg = highlightColor || "#ffff99";
        var animateMs = duration || "slow"; // edit is here
        var originalBg = this.css("background-color");

        if (!originalBg || originalBg == highlightBg)
            originalBg = "#FFFFFF"; // default to white

        jQuery(this)
            .css("backgroundColor", highlightBg)
            .animate({ backgroundColor: originalBg }, animateMs, null, function () {
                jQuery(this).css("backgroundColor", originalBg); 
            });
    };
});

$(document).on('change', '.searchColumn', function () {   // Change to dropdown in search for Source and Type
    var col = $(this).val();
    if (col == 'leadSource') {
        $('.leadSources').removeClass('hidden');
        $('.leadTypes').addClass('hidden');
        $('.searchText').addClass('hidden');
        $('.Owners').addClass('hidden');

    } else if (col == 'leadType') {
        $('.leadTypes').removeClass('hidden');
        $('.leadSources').addClass('hidden');
        $('.searchText').addClass('hidden');
        $('.Owners').addClass('hidden');

    } else if (col == 'assignedTo') {
        $('.Owners').removeClass('hidden');
        $('.leadTypes').addClass('hidden');
        $('.leadSources').addClass('hidden');
        $('.searchText').addClass('hidden');

    } else {
        $('.searchText').removeClass('hidden');
        $('.leadTypes').addClass('hidden');
        $('.leadSources').addClass('hidden');
        $('.Owners').addClass('hidden');
    }
});

$(document).on('click', '.advSearch', function () {  // Open advanced search box
    if ($(this).is(':checked')) {
        var content = '<h3 class="modalH">Busca Avançada&nbsp;&nbsp;&nbsp;'
                    + '<img src="img/information.png" title=" Exibe todos os resultados de uma só vez." /></h3>'
                    + '<form id="advForm" method="post" action="index.php?advSearch=true">'
                    + '<fieldset><legend>Buscar em Múltiplos Campos</legend>'
                    + '<table class="searchFields">'
            + '<tr><td class="leadField">ID :</td><td><input name="leadidStr" /></td>'
                    + '<tr><td class="leadField">Nome :</td><td><input name="firstNameStr" /></td>'
                    + '<td class="leadField">Adicionado em :</td><td><input name="dateAddedStr"></td></tr>'
                    + '<tr><td class="leadField">Sobrenome:</td><td><input name="lastNameStr" /></td>'
                    + '<td>Lead Source:</td><td class="selectDrop"><select name="leadSource">'
                    + '<option value="">--Selecione--</option>';
        $.each(leadSources, function(key, val) {
            content += '<option value="' + val.sourceID + '">' + val.sourceName + '</option>';
        });

        content     += '</select></td></tr>'
                    + '<tr class="Address"><td>Endereço:</td><td><input name="addressStr" /></td>'
                    + '<td>Produto</td><td class="selectDrop"><select name="leadType">'
                    + '<option value="">--Selecione--</option>';
        $.each(leadTypes, function(key, val) {
            content += '<option value="' + val.typeID + '">' + val.typeName + '</option>';
        });
        content     += '</select></td></tr>'
                    + '<tr class="City"><td>Cidade:</td><td><input name="cityStr" /></td>'
                    + '<td>Proprietário</td><td class="selectDrop"><select name="leadOwner">'
                    + '<option value="">--Selecione--</option>';

        $.each(Owners, function(key, val) {
            content += '<option value="' + val.id + '">' + val.first + ' ' + val.last + '</option>';
        });

        content     += '</select></td></tr>'
                    + '<tr class="State"><td>Estado(UF):</td><td><input name="stateStr" /></td></tr>'
                    + '<tr class="Country"><td>Pais:</td><td><input name="countryStr" /></td></tr>'
                    + '<tr class="Zip"><td>' + siteSettings.Zip + ':</td><td><input name="zipStr" /></td></tr>'
                    + '<tr class="Phone"><td>' + siteSettings.Phone + ':</td><td><input name="phoneStr" /></td></tr>'
                    + '<tr class="secondaryPhone"><td>' + siteSettings.secondaryPhone 
                    + ':</td><td><input name="secondPhoneStr" /></td></tr>'
                    + '<tr class="Fax"><td>' + siteSettings.Fax + ':</td><td><input name="faxStr" /></td></tr>'
                    + '<tr><td>Email:</td><td><input name="emailStr" /></td></tr>'
                    + '<tr class="customField"><td>' + siteSettings.customField1 
                    + ':</td><td><input name="customStr" /></td></tr>'
                    + '<tr class="customField2"><td>' + siteSettings.customField2 
                    + ':</td><td><input name="custom2Str" /></td></tr>'
                    + '<tr class="customField3"><td>' + siteSettings.customField3 
                    + ':</td><td><input name="custom3Str" /></td></tr>'
                    + '</table>'
                    + '</fieldSet>'
                    + '<p class="buttonRow">'
                    + '<button type="submit" class="buttons greenButton Submit">Buscar</button>&nbsp;&nbsp;'
                    + '<button class="closeModal buttons blueButton">Cancelar</button>'
                    + '</form></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast');
                });
            });
        }, minHeight:640});
        $(":input").each(function (i) { $(this).attr('tabindex', i + 1); });
    } else {
        // reset on uncheck
        window.location = 'index.php';
    }
    
});
