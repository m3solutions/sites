// config.js corresponds to config.php file (configuration or settings page)

    // Lead Sources
    $(document).on('click', '.saveSource', function() {  // Update Source
        var id = $(this).closest('tr').attr('class').split(' ')[1];
        var name = $(this).closest('tr').find('.name').val();
        var desc = $(this).closest('tr').find('.description').val();
        var type = 'saveSource';
        if (name == '') {
            alert('Name cannot be empty.');
            return false;
        }
        var dataString = 'type=' + type + '&id=' + id + '&name=' + name + '&desc=' + desc + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $('.entryItem.' + id).effect("highlight", {}, 3000);
                } else {
                    alert('There was a problem with communication, please try again.');
                }
                
                
                
            }
        });
        return false;
    });

    $(document).on('click', '.saveNewSource', function() {  // add new Source
        var name = $(this).closest('table').find('.newLeadSource').val();
        var desc = $(this).closest('table').find('.newLeadDesc').val();
        var type = 'saveNewSource';
        if (name == '') {
            alert('Digite um nome .');
            return false;
        }
        var dataString = 'type=' + type + '&name=' + name + '&desc=' + desc + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    var vals = response.vals;
                    var entry = '<tr class="entryItem ' + response.insertID + '">'
                              + '<td>Nome: </td>'
                              + '<td class="itemName">'
                              + '<input type="text" class="name lnField" size="50" value="' + vals.sourceName + '" /></td>'
                              + '<td>Description:</td>'
                              + '<td class="notes"><input type="text" class="description lnDesc" value="' 
                              + vals.description + '" /></td>'
                              + '<td><button class="smallButtons blueButton saveSource">Salvar</button>&nbsp;&nbsp;'
                              + '<button class="smallButtons redButton removeSource">Apagar</button></td></tr>';
                    $('.configure').prepend(entry);
                    $('.entryItem.' + response.insertID).effect("highlight", {}, 3000);
                    $('.addNewSource .newLeadSource').val('');
                    $('.addNewSource .newLeadDesc').val('');
                    // saved
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.removeSource', function() {  // Delete Source prompt
        var id = $(this).closest('tr').attr('class').split(' ')[1];
        var name = $(this).closest('tr').find('.name').val();
        var content = '<h3 class="modalH">Apagar Origem</h3>' 
                 + '<p class="delSource ' + id + '">Tem certeza que quer apagar a origem  <b>' + name + '</b>?<br />'
                 + ' Nota:Os Leads serão movidos para o grupo  "None"</p>'
                 + '<p class="buttonRow"><button class="buttons blueButton closeModal">Cancelar</button>&nbsp;'
                 + '<button class="buttons redButton confirmRemoveSource">Apagar</button></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast');
                });
            });
        }, minHeight:150});
    });

    $(document).on('click', '.confirmRemoveSource', function() {  // Delete the Source
        var id = $('.delSource').attr('class').split(' ')[1];
        var type = 'deleteSource';
        var dataString = 'type=' + type + '&id=' + id + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $('.configure').find('.entryItem.' + id).remove();
                    $.modal.close();
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });
    // End Lead Sources

    // Lead Types
    $(document).on('click', '.saveType', function() {  // Update Type
        var id = $(this).closest('tr').attr('class').split(' ')[1];
        var name = $(this).closest('tr').find('.name').val();
        var desc = $(this).closest('tr').find('.description').val();
        var type = 'saveType';
        if (name == '') {
            alert('Name cannot be empty.');
            return false;
        }
        var dataString = 'type=' + type + '&id=' + id + '&name=' + name + '&desc=' + desc + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $('.entryItem.' + id).effect("highlight", {}, 3000);
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.saveNewType', function() {  // add new Type
        var name = $(this).closest('table').find('.newLeadType').val();
        var desc = $(this).closest('table').find('.newLeadDesc').val();
        var type = 'saveNewType';
        if (name == '') {
            alert('Name cannot be empty.');
            return false;
        }
        var dataString = 'type=' + type + '&name=' + name + '&desc=' + desc + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    var vals = response.vals;
                    var entry = '<tr class="entryItem ' + response.insertID + '">'
                              + '<td>Name: </td>'
                              + '<td class="itemName">'
                              + '<input type="text" class="name lnField" size="50" value="' + vals.typeName + '" /></td>'
                              + '<td>Description:</td>'
                              + '<td class="notes"><input type="text" class="description lnDesc" value="' 
                              + vals.description + '" /></td>'
                              + '<td><button class="smallButtons blueButton saveType">Salva</button>&nbsp;&nbsp;'
                              + '<button class="smallButtons redButton removeType">Apagar</button></td></tr>';
                    $('.configureT').prepend(entry);
                    $('.entryItem.' + response.insertID).effect("highlight", {}, 3000);
                    $('.addNewType .newLeadType').val('');
                    $('.addNewType .newLeadDesc').val('');
                    // saved
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.removeType', function() {  // Delete Type prompt
        var id = $(this).closest('tr').attr('class').split(' ')[1];
        var name = $(this).closest('tr').find('.name').val();
        var content = '<h3 class="modalH">Apagar Produto</h3>' 
                 + '<p class="delType ' + id + '">Tem certeza que quer apagar o produto ? <b>' + name + '</b>?<br />'
                 + ' AVISO:Todos Leads deste produto passaram para o grupo  "None" </p>'
                 + '<p class="buttonRow"><button class="buttons blueButton closeModal">Cancelar</button>&nbsp;'
                 + '<button class="buttons redButton confirmRemoveType">Apagar</button></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast'); 
                });
            });
        }, minHeight:150});
    });

    $(document).on('click', '.confirmRemoveType', function() {  // Delete the Type
        var id = $('.delType').attr('class').split(' ')[1];
        var type = 'deleteType';
        var dataString = 'type=' + type + '&id=' + id + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $('.configureT').find('.entryItem.' + id).remove();
                    $.modal.close();
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });
    // End lead Type

    // lead status
    $(document).on('click', '.saveStatus', function() {  // Update Status
        var id = $(this).closest('tr').attr('class').split(' ')[1];
        var name = $(this).closest('tr').find('.name').val();
        var desc = $(this).closest('tr').find('.description').val();
        var type = 'saveStatus';
        if (name == '') {
            alert('Name cannot be empty.');
            return false;
        }
        var dataString = 'type=' + type + '&id=' + id + '&name=' + name + '&desc=' + desc + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $('.entryItem.' + id).effect("highlight", {}, 3000);
                    // saved
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.saveNewStatus', function() {  // add new status
        var name = $(this).closest('table').find('.newLeadStatus').val();
        var desc = $(this).closest('table').find('.newLeadDesc').val();
        var type = 'saveNewStatus';
        if (name == '') {
            alert('Name cannot be empty.');
            return false;
        }
        var dataString = 'type=' + type + '&name=' + name + '&desc=' + desc + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    var vals = response.vals;
                    var entry = '<tr class="entryItem ' + response.insertID + '">'
                              + '<td>Name: </td>'
                              + '<td class="itemName">'
                              + '<input type="text" class="name lnField" size="50" value="' + vals.statusName + '" /></td>'
                              + '<td>Description:</td>'
                              + '<td class="notes"><input type="text" class="description lnDesc" value="' 
                              + vals.description + '" /></td>'
                              + '<td><button class="smallButtons blueButton saveStatus">Save</button>&nbsp;&nbsp;'
                              + '<button class="smallButtons redButton removeStatus">Delete</button></td></tr>';
                    $('.configureS').prepend(entry);
                    $('.entryItem.' + response.insertID).effect("highlight", {}, 3000);
                    $('.addNewStatus .newLeadStatus').val('');
                    $('.addNewStatus .newLeadDesc').val('');
                    // saved
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.removeStatus', function() {  // Delete Status prompt
        var id = $(this).closest('tr').attr('class').split(' ')[1];
        var name = $(this).closest('tr').find('.name').val();
        var content = '<h3 class="modalH">Delete Status</h3>' 
                 + '<p class="delStatus ' + id + '">Tem certeza que quer apagar o Status <b>' + name + '</b>?<br />'
                 + ' Nota:Os Leads serão movidos para o grupo  "None" </p>'
                 + '<p class="buttonRow"><button class="buttons blueButton closeModal">Cancelar</button>&nbsp;'
                 + '<button class="buttons redButton confirmRemoveStatus">Apagar</button></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast');
                });
            });
        }, minHeight:150});
    });

    $(document).on('click', '.confirmRemoveStatus', function() {  // Delete the Status
        var id = $('.delStatus').attr('class').split(' ')[1];
        var type = 'deleteStatus';
        var dataString = 'type=' + type + '&id=' + id + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $('.configureS').find('.entryItem.' + id).remove();
                    $.modal.close();
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    // End lead status
    
    
    
      // lead motivo salva na edição 
    $(document).on('click', '.savemotivo', function() {  // Update Status
        var id = $(this).closest('tr').attr('class').split(' ')[1];
        var name = $(this).closest('tr').find('.name').val();
        var desc = $(this).closest('tr').find('.description').val();
        var type = 'savemotivo';
        if (name == '') {
            alert('Status não pode ser vazio .');
            return false;
        }
        var dataString = 'type=' + type + '&id=' + id + '&name=' + name + '&desc=' + desc + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $('.entryItem.' + id).effect("highlight", {}, 3000);
                    // saved
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

//lead motivo salva novo motivo 
    $(document).on('click', '.saveNewmotivo', function() {  // add new status
        var name = $(this).closest('table').find('.newLeadStatus').val();
        var desc = $(this).closest('table').find('.newLeadDesc').val();
        var type = 'saveNewmotivo';
        if (name == '') {
            alert('Name cannot be empty.');
            return false;
        }
        var dataString = 'type=' + type + '&name=' + name + '&desc=' + desc + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    var vals = response.vals;
                    var entry = '<tr class="entryItem ' + response.insertID + '">'
                              + '<td>Name: </td>'
                              + '<td class="itemName">'
                              + '<input type="text" class="name lnField" size="50" value="' + vals.statusName + '" /></td>'
                              + '<td>Description:</td>'
                              + '<td class="notes"><input type="text" class="description lnDesc" value="' 
                              + vals.description + '" /></td>'
                              + '<td><button class="smallButtons blueButton saveStatus">Save</button>&nbsp;&nbsp;'
                              + '<button class="smallButtons redButton removeStatus">Delete</button></td></tr>';
                    $('.configureS').prepend(entry);
                    $('.entryItem.' + response.insertID).effect("highlight", {}, 3000);
                    $('.addNewStatus .newLeadStatus').val('');
                    $('.addNewStatus .newLeadDesc').val('');
                    // saved
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.removeStatus', function() {  // Delete Status prompt
        var id = $(this).closest('tr').attr('class').split(' ')[1];
        var name = $(this).closest('tr').find('.name').val();
        var content = '<h3 class="modalH">Delete Status</h3>' 
                 + '<p class="delStatus ' + id + '">Tem certeza que quer apagar o Status <b>' + name + '</b>?<br />'
                 + ' Nota:Os Leads serão movidos para o grupo  "None" </p>'
                 + '<p class="buttonRow"><button class="buttons blueButton closeModal">Cancelar</button>&nbsp;'
                 + '<button class="buttons redButton confirmRemoveStatus">Apagar</button></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast');
                });
            });
        }, minHeight:150});
    });

    $(document).on('click', '.confirmRemoveStatus', function() {  // Delete the Status
        var id = $('.delStatus').attr('class').split(' ')[1];
        var type = 'deleteStatus';
        var dataString = 'type=' + type + '&id=' + id + '&token=' + token;
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $('.configureS').find('.entryItem.' + id).remove();
                    $.modal.close();
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    // End lead motivo
    
    
    

    // Start Manage Users

    $(document).on('click', '.addNewUser', function() {  // Add a new user
        var content = '<h3 class="modalH">Add Novo Cliente </h3><fieldset><legend>Cadastrar Cliente >>> Dados de Acesso </legend>'
                    + '<table class="newUser">'
                    + '<tr class="userRole"><td>Permissão</td>'
                    + '<td>Admin: <input type="radio" class="Admin" value="1" name="role">&nbsp;&nbsp;&nbsp;&nbsp;'
                    + 'Cliente: <input type="radio" class="User" value="2" name="role">&nbsp;&nbsp;&nbsp;&nbsp;'
                +'Somente Qualificação: <input type="radio" class="Quali" value="4" name="role"> &nbsp;&nbsp;'   
                + 'Somente Leitura: <input type="radio" class="ReadOnly" value="0" name="role"></td>'
                    + '</tr>'
                    + '<tr><td>Nome de usuario:</td><td><input type="text" class="userName" /></td></tr>'
                    + '<tr><td>Nome:</td><td><input type="text" class="firstName" /></td></tr>'
                    + '<tr><td>Contato:</td><td><input type="text" class="lastName" /></td></tr>'
                    + '<tr><td>Senha:</td><td><input type="password" class="password" /></td></tr>'
                    + '<tr><td>Confirme a senha : </td><td><input type="password" class="confirm" /></td></tr>'
                    + '<tr><td>Email Principal: </td><td><input type="text" class="userEmail" /></td></tr>'
                    + '</table></fieldSet>'
               +'<fieldset><legend>Dados Cadastrais </legend>'
               + '<table class="newUser">'
               + '<tr><td>CNPJ/CPF:</td><td><input type="text" class="cnpj" /></td></tr>'
               + '<tr><td>Empresa:</td><td><input type="text" class="empresa" /></td></tr>'
               + '<tr><td>Endereço:</td><td><input type="text" class="endereco" /></td></tr>'
             + '<tr><td>Cidade:</td><td><input type="text" class="cidade" /></td></tr>'
           + '<tr><td>Estado:</td><td><input type="text" class="estado" /></td></tr>'
               + '</table>'     
               + '</fieldSet>'          
       
                     +'<fieldset><legend>Necessidades  </legend>'
                     + '<table class="newUser">'
                     + '<tr><td>Produtos:</td><td><input type="text" class="produtos" /></td></tr>'
                     + '<tr><td>Regiões:</td><td><input type="text" class="regioes" /></td></tr>'
                     + '<tr><td>Quantidades :</td><td><input type="text" class="quantidades" /></td></tr>'
                     + '</table>'     
                     + '</fieldSet>'
              
              
                    + '<p class="buttonRow"><button class="buttons blueButton closeModal">Cancelar</button>&nbsp;'
                    + '<button class="buttons greenButton saveUser">Salvar</button></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast');
                });
            });
        }, minHeight:640});
        $(":input").each(function (i) { $(this).attr('tabindex', i + 1); });
        return false;
    });

    $(document).on('click', '.saveUser', function() { // Save new user
        var isAdmin   = $('input[name=role]:checked').val();
        var userName  = $('.userName').val();
        var firstName = $('.firstName').val();
        var lastName  = $('.lastName').val();
        var password  = $('.password').val();
        var confirmP  = $('.confirm').val();
        var userEmail = $('.userEmail').val();
        var cnpj      = $('.cnpj').val();
        var empresa = $('.empresa').val();
        var endereco = $('.endereco').val();
        var cidade = $('.cidade').val();
        var estado = $('.estado').val();
        var produtos = $('.produtos').val();
        var regioes = $('.regioes').val();
        var quantidades = $('.quantidades').val();
        
        var ownLeads = 0;
        if (isAdmin == 2) {  // User, we need to get 'ownLeads' value
            ownLeads = $('.ownLeads:checked').val() == 'on' ? '1': '0';
        }
        if (!isAdmin) {
            alert('Por favor selecione o tipo de permissão do usuário .');
            return false;
        }
        if (userName == '') {
            alert('Por favor digite um nome de usuário.');
            return false;
        }
        if (firstName == '') {
            alert('Por favor digite um nome .');
            return false;
        }
        if (lastName == '') {
            alert('Por favor digite um contato.');
            return false;
        }
        if (password == '') {
            alert('Por favor digite uma senha .');
            return false;
        } 
        if (confirmP == '') {
            alert('Por favor confirme sua senha .');
            return false;
        }
        if (password != confirmP) {
            alert('As senhas digitadas nao são iguais .verifique !');
            return false;
        }
        if (password.length < 6) {
            alert('Senhas tem que possuir no minimo 6 caracteres.');
            return false;
        }
        if (userEmail == '') {
            alert('Por favor digite um email válido  .');
            return false;
        }

        password = Sha1.hash(password);  // hash our password
        var type = 'saveUser';
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: {type:type,isAdmin:isAdmin,userName:userName,password:password,firstName:firstName,lastName:lastName,
                    userEmail:userEmail,ownLeads:ownLeads,token:token ,cnpj:cnpj , empresa:empresa,endereco:endereco,cidade:cidade,estado:estado,produtos:produtos,regioes:regioes,quantidades:quantidades},  
            success: function(response) {
                if (response.result == '1') {
                    $.modal.close();
                    if (isAdmin == '1') {
                        var roleText = 'Admin';
                    } else if (isAdmin == '2') {
                        var roleText = 'User';
                    } else if (isAdmin == '0') {
                        var roleText = 'Read Only';
                    }

                    var data = '<tr><td></td>'
                             + '<td>' + firstName + ' ' + lastName + '</td>'
                             + '<td>' + userName + '</td>'
                             + '<td>' + userEmail + '</td>'
                             + '<td>' + response.viewDate + '</td>'
                             + '<td>' + roleText + '</td>'
                             + '<td><button class="smallButtons blackButton changeAccount ' + response.insertID + '">'
                             + 'Update</button>&nbsp;&nbsp;'
                             + '<button class="smallButtons redButton removeUser ' + response.insertID + '">'
                             + 'Delete</button></td>';
                    $('.currentUsers').append(data);
                    if (ownLeads == 1) {
                        $('.changeAccount.' + response.insertID).closest('tr').find("td:nth-child(6)").addClass('ownLeads');
                    } else {
                        $('.changeAccount.' + response.insertID).closest('tr').find("td:nth-child(6)").removeClass('ownLeads');
                    }
                    $('.removeUser.' + response.insertID).closest('tr').effect("highlight", {}, 3000);

                } else if (response.result == '2') {
                    alert(response.msg);
                    return false;
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.removeUser', function() {     // Delete a user
        var id = $(this).attr('class').split(' ')[3];
        var user = $(this).closest('tr').find("td:nth-child(2)").text();
        var content = '<h3 class="modalH">Apagar Cliente ?</h3>'
                    + '<p class="deleteUser ' + id + '">'
                    + 'Tem certeza que quer apagar o cliente <b>' + user + '</b>? Isto não podera ser desfeito !!!</p>'
                    + '<p class="buttonRow"><button class="buttons blueButton closeModal">Cancelar</button>&nbsp;'
                    + '<button class="buttons redButton confRemoveUser">Apagar</button></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast');
                });
            });
        }, minHeight:150});
    });

    $(document).on('click', '.confRemoveUser', function() { // Confirm deletion of user
        var type = 'deleteUser';
        var id = $('.deleteUser').attr('class').split(' ')[1];
        var dataString = 'type='+ type + '&id=' + id + '&token=' + token; 
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: dataString,  
            success: function(response) {
                if (response.result == '1') {
                    $.modal.close();
                    $('.currentUsers').find('.removeUser.' + id).closest('tr').remove();
                
                } else if (response.result == '2') {
                    alert(response.msg);

                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    $(document).on('click', '.changeAccount', function() { // Modify account
        var id = $(this).attr('class').split(' ')[3];
        var email = $(this).closest('tr').find("td:nth-child(4)").text();
        var role = $(this).closest('tr').find("td:nth-child(6)").text();
        var ownLeads = $(this).closest('tr').find("td:nth-child(6)").hasClass('ownLeads');
        var userName = $(this).closest('tr').find("td:nth-child(3)").text();
        var content = '<h3 class="modalH">Alterar Dados do Cliente </h3>'
                    + '<p class="modifyUser ' + id + '">'
                    + '<fieldset><legend>Modificar conta do cliente  ' + userName + '</legend>'
                    + '<table class="modUserTable">'
                    + '<tr class="userRole"><td>Regra</td>'
                    + '<td>Admin: <input type="radio" class="Admin" value="1" name="role">&nbsp;&nbsp;&nbsp;&nbsp;' 
                    + 'Cliente: <input type="radio" class="User" value="2" name="role">&nbsp;&nbsp;&nbsp;&nbsp;'
                    + 'Somente Leitura: <input type="radio" class="ReadOnly" value="0" name="role"></td>'
                    + '</tr>'
                    + '<td>Email : </td><td><input type="text" class="userEmail" value="' + email + '" /></td></tr>'
                    + '<td>Mudar Senha ?</td>'
                    + '<td><input type="checkbox" class="changePass" /></td></tr>'
                    + '</table></fieldSet>'
                        
                    + '<p class="buttonRow"><button class="buttons blueButton closeModal">Cancelar</button>&nbsp;'
                    + '<button class="buttons yellowButton confModUser">Modificar</button></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast');
                });
            });
        }, minHeight:300});
        if (role == 'Admin') {
            $('.Admin').prop('checked', true);
        } else if (role == 'User') {
            $('.User').prop('checked', true);
            if (ownLeads == true) {
                var checked = 'checked="checked"';
            } else {
                var checked = '';
            }
            roleChange(2, checked);
        } else if (role == 'Read Only') {
            $('.ReadOnly').prop('checked', true);
        }
    });

    $(document).on('change', "input[name='role']", function() {  // Show Edit all or Edit own option
        var role = $(this).val();
        roleChange(role);
    });

    function roleChange(role, checked) {
        if (!checked) {
            checked = '';
        }
        if (role == '2') {      // This is a user so we show option
            var data = '<tr class="leadView">'
                     + '<td>Manages own leads only?</td><td><input type="checkbox" ' + checked + ' class="ownLeads">&nbsp;&nbsp;'
                     + '<img src="img/information.png" title="If selected, user can only view and manage their own leads that they'
                     + ' create.  Admins and Users without this checked can manage all leads." /></td></tr>';
            $('.userRole').after(data)
        } else {
            $('.leadView').remove();
        }
    };

    $(document).on('click', '.changePass', function() {  // Allow password modification
        if ($(this).is(':checked')) {
            var data = '<tr><td>New Password: </td><td><input class="newPass" type="password" /></td></tr>'
                     + '<tr><td>Confirm Password: </td><td><input class="passConfirm" type="password" /></td></tr>';
            $('.modUserTable').append(data);
        } else {
            $('.modUserTable').find('.newPass').closest('tr').remove();
            $('.modUserTable').find('.passConfirm').closest('tr').remove();
        }
    });

    $(document).on('click', '.confModUser', function() {    // continue modify account
        var id = $('.modifyUser').attr('class').split(' ')[1];
        var email = $('.userEmail').val();
        var isAdmin = $('input[name=role]:checked').val();
        var ownLeads = 0;
        if (isAdmin == 2) {  // User, we need to get 'ownLeads' value
            ownLeads = $('.ownLeads:checked').val() == 'on' ? '1': '0';
        }
        if ($('.changePass').is(':checked')) {
            var updatePass = 'true';
            var password = $('.newPass').val();
            var passConfirm = $('.passConfirm').val();
        } else {
            var updatePass = 'false';
            var password = '';
            var passConfirm = '';
        }

        if (password != passConfirm) {
            alert('Passwords do not match.');
            return false;
        }
        password = Sha1.hash(password);  // hash our password
        var type = 'modifyUser';
        $.ajax({  
            type: "POST",  
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",  
            data: {type:type,id:id,email:email,updatePass:updatePass,password:password,isAdmin:isAdmin,ownLeads:ownLeads,
                    token:token},
            success: function(response) {
                if (response.result == '1') {
                    // update page
                    if (isAdmin == '1') {
                        var roleText = 'Admin';
                    } else if (isAdmin == '2') {
                        var roleText = 'User';
                    } else if (isAdmin == '0') {
                        var roleText = 'Read Only';
                    }
                    $.modal.close();
                    $('.changeAccount.' + id).closest('tr').find("td:nth-child(4)").text(email);
                    $('.changeAccount.' + id).closest('tr').find("td:nth-child(6)").text(roleText);
                    if (ownLeads == 1) {
                        $('.changeAccount.' + id).closest('tr').find("td:nth-child(6)").addClass('ownLeads');
                    } else {
                        $('.changeAccount.' + id).closest('tr').find("td:nth-child(6)").removeClass('ownLeads');
                    }
                    $('.changeAccount.' + id).closest('tr').effect("highlight", {}, 3000);
                
                } else if (response.result == '2') {
                    alert(response.msg);

                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });

    // End Manage Users

$(function() {
        $( "#tabs1" ).tabs();
    });


    // Start Import Export

    $(function() {
        $( "#tabs" ).tabs();
    });

    $(document).ajaxStart(function() { 
        $("#loading").show();
        $('#buttonUpload').attr('disabled', 'disabled');
    });

    $(document).ajaxComplete(function() {
        $("#loading").hide();
        $('#buttonUpload').removeAttr('disabled');
    });

    function ajaxFileUpload() {                // Ajax upload csv file...step 1
        var method='uploadFile';

        $.ajaxFileUpload
        (
            {
                url:'ajax/import.php',
                secureuri:false,
                fileElementId:'fileToUpload',
                dataType: 'json',
                data:{token: token, method: method},
                success: function (data, status)
                {
                    if(typeof(data.error) != 'undefined') {
                        if(data.error == '1') {
                            alert(data.msg);
                            return false;
                        } else if(data.error != '') {
                            alert(data.error);
                        } else {               // success
                            var output = '<p><b>Passo 2.</b> Organize seus dados :</p>'
                                     + '<p>Organize os seus dados - (coluna da direita)-> <strong>Sistema</strong> = (colunas da esquerda)-><strong> Planilha</strong>.  '
                                     + ' Você pode arrastar e soltar para organizar e remover as colunas desnecessárias para a importação.'
                                     + ' Você deve usar os campos em branco para evitar lacunas dos dados.</p>'
                                     + '<table class="matchData">'    
                                     + '<tr><td>Nome</td></tr>'
                                     + '<tr><td>Sobrenome</td</tr>'
                                     + '<tr><td>' + siteSettings.Address + '</td></tr>'
                                     + '<tr><td>' + siteSettings.Phone + '</td></tr>'
                                     + '<tr><td>' + siteSettings.secondaryPhone + '</td></tr>'
                                     + '<tr><td>' + siteSettings.Fax + '</td></tr>'
                                     + '<tr><td>Email Principal </td></tr>'
                                     + '<tr><td>Email 2</td></tr>'
                                     + '<tr><td>Email 3</td></tr>'
                                     + '<tr><td>Email 4</td></tr>'
                                     + '<tr><td>' + siteSettings.City + '</td></tr>'
                                     + '<tr><td>' + siteSettings.State + '</td></tr>'
                                     + '<tr><td>' + siteSettings.Country + '</td></tr>'
                                     + '<tr><td>' + siteSettings.Zip + '</td></tr>'
                                     + '<tr><td>' + siteSettings.idade + '</td></tr>'
                                     + '<tr><td>' + siteSettings.customField1 + '</td></tr>'
                                     + '<tr><td>' + siteSettings.customField2 + '</td></tr>'
                                     + '<tr><td>' + siteSettings.customField3 + '</td></tr>'
                             
                                     + '<tr><td>Notes</td></tr>'
                                     + '</table>'
                                     + '<table id="sortData" class="sortData"><tbody>';
                            $.each(data.topRow, function(n, val) {
                                output += '<tr><td class="sortEntry"><img src="img/updown.png" />'
                                        + '<span class="sortName">' + val + '</span></td>'
                                        + '<td><a href="#" class="removeCol ">'
                                        + '<img src="img/delete.png" title="Remover da Importação">'
                                        + '</a></td></tr>';
                            });                            
                            output += '</tbody></table><div class="addBlankCol">'
                                    + '<p><a href="#" class="addBlank">Add Campo em Branco </a></p><br /><br />'
                                    + '<p><button class="buttons redButton cancelImport">Cancelar</button>'
                                    + '&nbsp;&nbsp;<button class="buttons blueButton continueImport">Continuar >></button>'
                                    + '</div>'
                                    + '<div class="afterData"></div>';


                            $('.importSteps').html(output);                              
                            $("#sortData tbody").sortable({
                                helper: fixHelper
                            }).disableSelection();

                        }
                    }
                },
                error: function (data, status, e)
                {
                    alert(e);
                }
            }
        )
        return false;
    }

    $(document).on('click', '.continueImport', function() { // Continue, final step
        var method = 'continueImport';
        var columnOrderArray = {};
        var inc = 0;
        $('.sortData').find('tr').each(function() {
            inc++;
            var column = $(this).find('.sortName').text();
            columnOrderArray[inc] = {
                name: column
            }
        });
        var columnOrder = JSON.stringify(columnOrderArray);
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "ajax/import.php",
            data: {method: method, columnOrder: columnOrder, token: token},
            success: function(response) {
                if (response.error == '0') {
                    var output = '<p><b>Passo 3.</b> Configurações Adicionais:</b></p>'
                               + 'Escolha como desaja importar os dados </p>'
                               + '<p>Escolha a <strong>Origem</strong> , o <strong>Produto</strong> e o <strong>Status</strong> dos Leads:</p><br />'
                               + '<table>'
                               + '<tr><td>Origen:</td>'
                               + '<td><select class="selectSource"><option value="">--Selecione--</option>';
                    $.each(response.leadSource, function(n, val) {
                        output += '<option value="' + val.sourceID + '">' + val.sourceName + '</option>';
                    });
                    output += '</select></td></tr>'
                            + '<tr><td>Produto:</td>'
                            + '<td><select class="selectType"><option value="">--Selecione--</option>';
                    $.each(response.leadType, function(n, val) {
                        output += '<option value="' + val.typeID + '">' + val.typeName + '</option>';
                    });
                    output += '</select></td></tr>'
                            + '<tr><td>Status:</td>'
                            + '<td><select class="selectStatus"><option value="">--Selecione--</option>';
                    $.each(response.leadStatus, function(n, val) {
                        output += '<option value="' + val.id + '">' + val.statusName + '</option>';
                    });
                    output += '</select></td></tr></table>'
                            + '<p> <button class="buttons redButton cancelImport">Cancelar</button>&nbsp;&nbsp;'
                            + '<button class="buttons blueButton finishImport">Finalizar e Importar </button></p>';
                    $('.importSteps').html(output);
                    
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
    });

    $(document).on('click', '.finishImport', function() { // Finish Import
        var selectType = $('.selectType').val();
        var selectSource = $('.selectSource').val();
        var selectStatus = $('.selectStatus').val();
        if (selectSource == '') {
            alert('Por favor selecione a Origem dos Leads.');
            return false;
        }
        if (selectType == '') {
            alert('Por favor selecione os Produtos dos Leads.');
            return false;
        }
        if (selectStatus == '') {
            alert('Por favor selecione o Status dos Leads.');
            return false;
        }
        var method = 'finishImport';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "ajax/import.php",
            data: {method: method, source: selectSource, 
                type: selectType, status: selectStatus, token: token},
            success: function(response) {
                if (response.error == '0') {
                var output = '<p>Importação realizada com sucesso , Importados ' + response.insertCount + ' Leads'
                         + '  Por favor verifique seus  <a href="index.php">leads</a>.</p>';
                $('.importSteps').html(output);
            } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
    });

    $(document).on('click', '.cancelImport', function() {  // Cancel the import
        var method = 'cancelImport';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "ajax/import.php",
            data: {method: method, token: token},
            success: function(response) {
                if (response.error == '0') {
                   location.reload(); 

                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });


    $(document).on('click', '.addBlank', function() { // Insert blank entry for empty column
        var data = '<tr><td class="blankData"><img src="img/updown.png" /><u><span class="sortName">Branco</span></u></td>'
                 + '<td><a href="#" class="removeCol ">'
                 + '<img src="img/delete.png" title="Remove From Import">';
        $(data).prependTo('.sortData').effect("highlight", {}, 1000);
        return false;
    });

    $(document).on('click', '.removeCol', function() { // Remove column from import
        $(this).closest('tr').fadeOut(150, function() { 
            $(this).remove();
        });
        return false;
    });

    var fixHelper = function(e, ui) {                  // Sortable helper to keep the width on cells
        ui.children().each(function() {
            $(this).width($(this).width());
        });
        return ui;
    };

    // End Import Export

    // Site Settings
    $(document).on('click', '.savePageResults', function() {   // Save the new pagination results setting
        var rpp = $('.pageResults').val();
        if (isNaN(rpp)) {
            alert('Please insert a numerical value.');
        } else if (rpp < 1 || rpp > 5000) {
            alert('Please insert a value between 1 and 5000.');
        } else {
            var type = 'updateRPP';
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "ajax/ajaxFunctions.php",
                data: {type: type, rpp: rpp, token: token},
                success: function(response) {
                    if (response.result == '1') {
                        $('.pageResultsP').effect("highlight", {}, 3000);
                    } else {
                        alert('There was a problem with communication, please try again.');
                    }
                }
            });
        }
    });

    $(document).on('click', '.saveField', function() {   // Save the Field Name
        var td = $(this).closest('td');
        var fieldVal= td.find('.lnField').val();
        var fieldName = td.find('.lnField').attr('class').split(' ')[0];
        if (fieldVal == '') {
            alert ('Field Name is empty, please provide a name.');
            return false;
        }
        var type = 'updateField';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",
            data: {type: type, fieldVal: fieldVal, fieldName: fieldName, token: token},
            success: function(response) {
                if (response.result == '1') {
                    td.effect("highlight", {}, 3000);
                    window.location = "config.php?page=siteSettings";
                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
    });

    $(function() {                      // Make Sortable Results for Columns to show
        $( "#sortableCols, #sortableCols2" ).sortable({
            connectWith: ".connectedSortable"
        }).disableSelection();
    });

    $(document).on('click', '.saveOrder', function() { // Save the order of columns to display
        var sortOrder = {};
        var i = 0;
        var name = false;
        $('#sortableCols li').each(function () {         // Precursor check, name must exist
            if ($(this).text() == 'Name') {
                name = true;
            }
        });
        if (name == false) {
            alert('You must at least keep "Name" in "Columns Used".');
            return false;
        }

        $('#sortableCols li').each(function () {         // Keepers
            i++;
            var id = $(this).attr('class').replace(/\D+/g,'');
            sortOrder[i] = {
                id: id,
                order: i,
                used: 1
            };
        });

        $('#sortableCols2 li').each(function () {        // Non Keepers
            i++;
            var id = $(this).attr('class').replace(/\D+/g,'');
            sortOrder[i] = {
                id: id,
                order: i,
                used: 0
            };
        });
        var type = 'saveOrder';
        var sortOrderString = JSON.stringify(sortOrder);
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",
            data: {type: type, order: sortOrderString, token: token},
            success: function(response) {
                if (response.result == '1') {
                    $('#sortableCols').effect("highlight", {}, 3000);
                
                } else if (response.result == '2') {
                    alert(response.msg);

                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });


    // End Site Settings
    // Remove leads from database
    $(document).on('click', '.emptyDB', function() { // Remove all leads (and corresponding data) from database
        var content = '<h3 class="modalH">Apagar Leads do Sistema </h3>' 
                 + '<p><b>Aviso Final!!!</b>...Tem certeza que quer realmente apagar todos os leads do sistema ???<br />'
                 + '<p class="buttonRow"><button class="buttons blueButton closeModal">Cancelar</button>&nbsp;'
                 + '<button class="buttons redButton confirmEmptyDB">Apagar Todos os Leads</button></p>';
        $(content).modal({onOpen: function (dialog) {
            dialog.overlay.fadeIn('fast', function () {
                dialog.container.fadeIn('fast', function () {
                    dialog.data.fadeIn('fast');
                });
            });
        }, minHeight:150});
    });

    $(document).on('click', '.confirmEmptyDB', function() {    // Continue all leads removal
        var type = 'emptyDB';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",
            data: {type: type, token: token},
            success: function(response) {
                if (response.result == '1') {
                    $.modal.close();
                    var content = '<br /><h3 class="secTitle">Apagar todos os leads do sistema </h3>'
                                + '<hr class="thinLine"><br /><br />'
                                + 'Todos os leads foram apagados do sistema ,'
                                + ' Insira novos <a href="index.php">Leads!</a>';
                    $('.emptyDBDisplay .configLeft').html(content);
                } else if (response.result == '2') {
                    alert(response.msg);

                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    });
        

    // End Remove leads from database


    $(document).on('click', '.manageSource', function() {   // Show Source Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.sourceDisplay').removeClass('hidden');
        return false;
    });

    $(document).on('click', '.manageType', function() {   // Show Type Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.typeDisplay').removeClass('hidden');
        return false;
    });

    $(document).on('click', '.manageStatus', function() {   // Show Status Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.statusDisplay').removeClass('hidden');
        return false;
    });

    $(document).on('click', '.manageUsers', function() {   // Show Users Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.usersDisplay').removeClass('hidden');
        return false;
    });

    $(document).on('click', '.manageExp', function() {   // Show Export Import Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.exportDisplay').removeClass('hidden');
        return false;
    });

    $(document).on('click', '.manageSite', function() {   // Show Site Settings Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.siteDisplay').removeClass('hidden');
        return false;
    });

    $(document).on('click', '.emptyDatabase', function() {   // Show Empty Database Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.emptyDBDisplay').removeClass('hidden');
        return false;
    });

    $(document).on('click', '.showLogging', function() {   // Show Logging
        var page = 1;
        getLogs(page);
        return false;
    });

    $(document).on('click', '.logPage', function() { // Get the Page
        var search = $('.searchLog').val();
        page = $(this).text();
        getLogs(page, search);
        return false;
    });

//paginas extra na config 


//pag relatorios 
$(document).on('click', '.showrelat', function() {   // Show Users Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.showrelat').removeClass('hidden');
        return false;
    });


//pag config extras
$(document).on('click', '.outras', function() {   // Show Users Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.outras').removeClass('hidden');
        return false;
    });



//pag motivos 
$(document).on('click', '.managemotivos', function() {   // Show Users Div
        $('.sections').removeClass('selected');
        $(this).addClass('selected');
        $('.section').addClass('hidden');
        $('.managemotivos').removeClass('hidden');
        return false;
    });


    $(document).on('click', '.nextLog', function() { // Get the next page
        var search = $('.searchLog').val();
        page =  parseInt($('.current').text()) + 1;
        getLogs(page, search);
        return false;
    });

    $(document).on('click', '.prevLog', function() { // Get the previous page
        var search = $('.searchLog').val();
        page = parseInt($('.current').text()) - 1;
        getLogs(page, search);
        return false;
    });

    function getLogs(page, search) {                              // Get the log page and pagination
        $('.sections').removeClass('selected');
        $('.statusSelect').find('.showLogging').addClass('selected');
        $('.section').addClass('hidden');
        $('.loggingDisplay').removeClass('hidden');
        var type = 'showLog';
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "ajax/ajaxFunctions.php",
            data: {type: type, page: page, search: search, token: token},
            success: function(response) {
                if (response.result == '1') {
                    if (response.search == true) {
                        var search = response.searchTerm;
                    } else {
                        var search = '';
                    }
                    content = '<div class="pagingHolder">' + response.pagDiv + '</div>'
                            + '<div class="searchLogDiv"><input type="text" class="searchLog" value = "' + search + '"/>'
                            + '<button class="smallButtons blackButton goSearchLog">Pesquisar</button></div>'
                            + '<div class="clearBoth">&nbsp;</div>'
                            + '<table class="logs">'
                            + '<tr><th>Usuario</th><th>Ação</th><th>Detalhes</th><th>Hora</th><th>Endereço Ip</th></tr>';
                    var i = 0;
                    var alt = 0;
                    $.each(response.log, function(n, val) {
                        i++;
                        alt = i & 1;
                        content += '<tr class="trClass' + alt + '"><td>' + val.userFirst + ' ' + val.userLast + '</td>'
                                 + '<td>' + val.event + '</td><td>' + val.detail + '</td>'
                                 + '<td>' + val.eventTime + '</td><td>' + val.ipAddr + '</td></tr>';
                    });            
                    content += '</table>';
                    $('.activityLog').html(content);
                } else if (response.result == '2') {
                    alert(response.msg);

                } else {
                    alert('There was a problem with communication, please try again.');
                }
            }
        });
        return false;
    };

    $(document).on('click', '.goSearchLog', function() {          // Search Logs
        var search = $('.searchLog').val();
        if (search == '') {
            alert('Please Enter a search term');
            return false;
        } else {
            getLogs(1, search);
        }
    });

    $(document).on('click', '.closeModal', function() {
        $.modal.close();
    });

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
