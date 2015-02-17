(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        $('#change-password').on('submit', function(e){
            event.preventDefault();

            var password = jQuery('#password').val(),
            checkPassword = jQuery('#checkPassword').val(),
            security = jQuery('#security').val();

            $('#change-password p.status').show().text('A processar a informação. Por favor, aguarde!');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: { 
                    'action': 'dm_profile_change_password',
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


        $('#change-nicename').on('submit', function(e){
            event.preventDefault();

            var nicename = jQuery('#nicename').val(),
            security = jQuery('#security').val();

            $('#change-nicename p.status').show().text('A processar a informação. Por favor, aguarde!');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajax_object.ajaxurl,
                data: { 
                    'action': 'dm_profile_change_nicename',
                    'nicename': nicename, 
                    'security': security
                },
                success: function(data){
                    console.log(data);
                    $('#change-nicename p.status').show().text(data.message);  
                    if (data.link) {
                        $("#menu-item-233 a").attr('href',data.link);
                    }          
                }
            });                

        });

    });
    
})(jQuery, this);