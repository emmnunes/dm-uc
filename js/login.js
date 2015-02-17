(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        $('#login-form').on('submit', function(e){
            e.preventDefault();

            var username = jQuery('#username').val();
            var password = jQuery('#password').val();
            var security = jQuery('#security').val();

            $('#login-form p.status').show().text('A verificar a sua informação. Por favor, aguarde!');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: { 
                    'action': 'ajax_login',
                    'username': username, 
                    'password': password, 
                    'security': security
                },
                success: function(data){
                    $('#login-form p.status').text(data.message);
                    if (data.loggedin == true){
                        document.location.href = data.redirect;
                    }
                }
            });
        });

    });
    
})(jQuery, this);