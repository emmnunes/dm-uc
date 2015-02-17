(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        var md = new MobileDetect(window.navigator.userAgent);
        var page = 1;
        var posts;
        var loading = false;
        var $content = $("#items");
        var button = $("#load-more");
        button.css('display','block');

        if (md.phone() == null && md.mobile() == null && md.tablet() == null) {
            posts = 12;
        } else {
            posts = 6;
        }

        $.ajax({
            type       : "GET",
            url: ajax_object.ajaxurl,
            data: {
                action: 'dm_get_num_all_posts',
                numPosts : posts
            },
            success    : function(data){
                button.attr('data-pages',data);
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });

        var load_posts = function(){
            $.ajax({
                type       : "GET",
                url: ajax_object.ajaxurl,
                data: {
                    action: 'dm_get_all_posts',
                    numPosts : posts,
                    pageNumber: page
                },
                dataType   : "html",
                beforeSend : function(){
                    if(page != 1){
                        button.find('.loading').show();
                        button.find('.load').hide();
                    }
                },
                success    : function(data){
                    var $data = $(data);
                    if($data.length){
                        $data.hide();
                        $content.append($data);
                        $data.fadeIn(500, function(){
                            loading = false;
                            button.find('.loading').hide();
                            button.find('.load').show();
                            if (button.attr('data-pages') == page) {
                                button.fadeOut();
                            }  
                        });
                        $('.type-trabalhos .tag').tooltip();
                    }
                },
                error     : function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
            });
        }
        button.click(function() {
            if (loading == false) {
                loading = true;
                page++;
                load_posts();
            }
        });
    });
    
})(jQuery, this);