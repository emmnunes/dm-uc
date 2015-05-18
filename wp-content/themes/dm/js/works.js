(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        var md = new MobileDetect(window.navigator.userAgent);

        if (md.phone() == null && md.mobile() == null) {
            $('a[rel="lightbox"]').fluidbox(); 

            $("#content-wrapper").scroll(function() {                
                attachImage();
            });
            $(window).resize(function() {
                attachImage();
            });     
        } else {
            $('a[rel="lightbox"]').on('click', function(){
                event.preventDefault();
            }); 
        } 

        function attachImage() {
            var scrolledY = $("#content-wrapper").scrollTop();  
            var tmpImg = new Image();
            tmpImg.src=$('#cover').attr('data-img');
            var height = tmpImg.height;
            var width = tmpImg.width;
            var tmpWidth = width;
            if (height > $('#cover').height()) {
                height = ((($(window).width()-15))*height) / width;
                height = height/2-($('#cover').height()/2);
            } else {
                height = 0;
            }

            $('#cover').css('background-position', 'center ' + ((-height + scrolledY)) + 'px');
        }
    });

    jQuery('body').on('click','.jm-post-like',function(event){
        event.preventDefault();
        heart = jQuery(this);
        post_id = heart.data("post_id");
        heart.html("<i id='icon-like' class='dm-depreciar dm-2x'>&nbsp;</i><span class='count'><span class='one'>.</span><span class='two'>.</span><span class='three'>.</span></span>");
        jQuery.ajax({
            type: "post",
            url: ajax_object.ajaxurl,
            data: "action=jm-post-like&nonce="+ajax_object.nonce+"&jm_post_like=&post_id="+post_id,
            success: function(count){
                console.log(count);
                if( count.indexOf( "already" ) !== -1 )
                {
                    var lecount = count.replace("already","");
                    heart.prop('title', 'Apreciar');
                    heart.removeClass("liked");
                    heart.html("<i id='icon-unlike' class='dm-apreciar dm-2x'></i>&nbsp;<span class='count'>"+lecount+"</span>");
                }
                else
                {
                    heart.prop('title', 'Apreciado');
                    heart.addClass("liked");
                    heart.html("<i id='icon-like' class='dm-depreciar dm-2x'></i>&nbsp;<span class='count'>"+count+"</span>");
                }
            }
        });
    });
    
})(jQuery, this);