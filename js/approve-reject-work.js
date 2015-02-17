(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        $(".approve-work").click(function() {
            event.preventDefault();
            var id = $(this).attr("data-id");
            var nonce = $(this).attr("data-nonce");
            var post = $('.post-' + id);
            $.ajax({
                type: 'post',
                url: ajax_object.ajaxurl,
                data: {
                    action: 'dm_approve_work',
                    nonce: nonce,
                    id: id
                },
                success: function( result ) {

                    if( result == 'success' ) {
                        classie.remove( document.getElementById("modal-aw"), 'md-show' );
                        post.fadeOut( function(){
                            post.remove();
                        });   
                    }
                }
            })
            return false;
        });

        $(".reject-work").click(function() {
            event.preventDefault();
            var id = $(this).data('id');
            var nonce = $(this).data('nonce');
            var post = $('.post-' + id);
            $.ajax({
                type: 'post',
                url: ajax_object.ajaxurl,
                data: {
                    action: 'dm_reject_work',
                    nonce: nonce,
                    id: id
                },
                success: function( result ) {
                    if( result == 'success' ) {
                        classie.remove( document.getElementById("modal-dw"), 'md-show' );
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