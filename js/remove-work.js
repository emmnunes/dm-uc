(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        $(".remove-work").click(function() {
            event.preventDefault();
            var id = $(this).attr("data-id");
            var nonce = $(this).attr("data-nonce");
            var post = $('.post-' + id);
            $.ajax({
                type: 'post',
                url: ajax_object.ajaxurl,
                data: {
                    action: 'dm_remove_work',
                    nonce: nonce,
                    id: id
                },
                success: function( result ) {

                    if( result == 'success' ) {
                        classie.remove( document.getElementById("modal-rw"), 'md-show' );
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