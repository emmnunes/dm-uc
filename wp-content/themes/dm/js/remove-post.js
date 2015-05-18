(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        $("#remove-post").click(function() {
            event.preventDefault();
            var id = $(this).attr("data-id");
            var nonce = $(this).attr("data-nonce");
            var post = $('.post-' + id);
            console.log('entrou');
            $.ajax({
                type: 'post',
                url: ajax_object.ajaxurl,
                data: {
                    action: 'dm_remove_post',
                    nonce: nonce,
                    id: id
                },
                success: function( result ) {
                    if( result == 'success' ) {
                        classie.remove( document.getElementById("modal-rp"), 'md-show' );
                        console.log(post);
                        post.fadeOut( function(){
                            post.remove();
                        });   
                    }
                }
            })
            return false;
        });

    });
    
})(jQuery, this);