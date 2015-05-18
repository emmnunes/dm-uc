(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        $('#recover-form').on('submit', function(e){
            e.preventDefault();

            var username = jQuery('#username').val();
            var security = jQuery('#security').val();

            $('#recover-form p.status').show().text('A verificar a sua informação. Por favor, aguarde!');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: { 
                    'action': 'ajax_recover',
                    'username': username, 
                    'security': security
                },
                success: function(data){
                    $('#recover-form p.status').text(data.message);
                }
            });
        });

        $('#change-password').on('submit', function(e){
            e.preventDefault();

            var username = jQuery('#userToChange').val(),
            password = jQuery('#password').val(),
            checkPassword = jQuery('#checkPassword').val(),
            security = jQuery('#security').val();

            $('#change-password p.status').show().text('A processar a informação. Por favor, aguarde!');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: { 
                    'action': 'dm_change_password',
                    'username': username,
                    'password': password, 
                    'checkPassword': checkPassword,
                    'security': security
                },
                success: function(data){
                    console.log(data);
                    $('#change-password p.status').show().text(data.message);
                    if (data.redirect == true){
                        document.location.href = data.link;
                    }                
                }
            });
        });

    });
    
})(jQuery, this);