(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        $(".remove-comment").click(function() {
            event.preventDefault();
            var id = $(this).attr("data-id");
            var nonce = $(this).attr("data-nonce");
            var comment = $('#div-comment-' + id);
            console.log(comment);
            $.ajax({
                type: 'post',
                url: ajax_object.ajaxurl,
                data: {
                    action: 'dm_remove_comment',
                    nonce: nonce,
                    id: id
                },
                success: function( result ) {
                    console.log(result);
                    if( result == 'success' ) {
                        classie.remove( document.getElementById("modal-rc"), 'md-show' );
                        comment.fadeOut( function(){
                            comment.remove();
                        });   
                    }
                }
            })
            return false;
        });

    });
    
})(jQuery, this);