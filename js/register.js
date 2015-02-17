(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        $('#register-form').on('submit', function(e){
            e.preventDefault();

            var username = jQuery('#username').val(),
            email = jQuery('#email').val(),
            password = jQuery('#password').val(),
            checkPassword = jQuery('#checkPassword').val(),
            security = jQuery('#security').val();

            $('#register-form p.status').show().text('A processar o registo. Por favor, aguarde!');

            $.ajax({
                type: 'POST',
                url: ajax_object.ajaxurl,
                data: { 
                    'action': 'dm_register',
                    'username': username, 
                    'email': email,
                    'password': password,
                    'checkPassword': checkPassword,
                    'security': security
                },
                success: function(data){
                    $('#register-form p.status').text(data);
                }
            });
        });

    });
    
})(jQuery, this);