(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        if ( current_user == current_author ) {
            $('.menu-item-233').addClass('current-menu-item current-page-item');
        }    

        var user = document.getElementById("user"),
        userEdit = document.getElementById("user-edit"),
        loading = false;
        $("#update-user").click(function(e){
            event.preventDefault();
            if (loading != true) {
                loading = true;
                $(this).find('.loading').show();
                $(this).find('.load').hide();
                $('body').find('.ns-bar').remove();
                dm_update_user();
            }
        });

        $("#editToggle").click(function(e){
            $(this).hide();
            $("#update-user").css('display','block');

            classie.toggle( user, 'u-hide' );
            classie.toggle( userEdit, 'u-show' );
        });

        function dm_update_user()
        {

            var userFirstName = jQuery('#first-name').val(),
            userLastName = jQuery('#last-name').val(),
            userEmail = jQuery('#email').val(),
            userUrl = jQuery('#url').val(),
            userPass1 = jQuery('#pass1').val(),
            userPass2 = jQuery('#pass2').val(),
            userDescription,
            userFacebook = jQuery('#acf-field_53cb01b22aa4e').val(),
            userTwitter = jQuery('#acf-field_53cb01f92aa4f').val(),
            userLinkedin = jQuery('#acf-field_54e2237f38128').val(),
            userPinterest = jQuery('#acf-field_53cb02012aa50').val(),
            userDribbble = jQuery('#acf-field_53cb020a2aa51').val(),
            userBehance = jQuery('#acf-field_53cb021a2aa52').val(),
            userVimeo = jQuery('#acf-field_53cb02442aa54').val(),
            userAvatar = jQuery('#user-update-form').find("[name='acf[field_53c747e0a9ba7]']").val(),
            userAvatarUrl = jQuery('#user-update-form').find("img").attr("src"),
            userCourses = jQuery ('#acf-field_53e65cfd1864b').val();

            $("iframe").each(function() { 
                var id = $(this).attr('id');
                if (id.indexOf("acf-field") > -1) {
                    console.log(document.getElementById($(this).attr('id')).contentWindow.document.body.innerHTML);
                    userDescription = document.getElementById($(this).attr('id')).contentWindow.document.body.innerHTML;
                }   
            });

            jQuery.ajax({
                type: "POST",
                url: ajax_object.ajaxurl,
                data: {
                    action:'dm_update_profile', 
                    firstname:userFirstName,
                    lastname:userLastName,
                    email:userEmail,
                    url:userUrl,
                    pass1:userPass1,
                    pass2:userPass2,
                    description:userDescription,
                    avatar: userAvatar,
                    facebook: userFacebook,
                    twitter: userTwitter,
                    linkedin: userLinkedin,
                    pinterest: userPinterest,
                    dribbble: userDribbble,
                    behance: userBehance,
                    vimeo: userVimeo,
                    courses: userCourses
                },
                success:function(data){
                    if (data != '' && data[0] == '['){
                        data = JSON.parse(data);    
                        var content = '';
                        for (i = 0; i < data.length; ++i) {
                            content += data[i] + '<br>';
                        }
                        var notification = new NotificationFx({
                            wrapper : document.body,
                            message : content,
                            layout : 'bar',
                            effect : 'exploader',
                            ttl : 9000000,
                            type : 'error'
                        });
                        notification.show();
                    } else {
                        // var notification = new NotificationFx({
                        //     wrapper : document.body,
                        //     message : data,
                        //     layout : 'bar',
                        //     effect : 'exploader',
                        //     ttl : 20000,
                        //     type : 'notice'
                        // });

                        $("#update-user").hide();
                        $("#editToggle").show();
                        classie.toggle( user, 'u-hide' );
                        classie.toggle( userEdit, 'u-show' );

                        /* Update Frontend */
                        $("#user .avatar img").attr('src', userAvatarUrl);
                        $("#user .first-name").html(userFirstName);
                        $("#user .last-name").html(userLastName);
                        $("#user .description").html(userDescription);
                        $(".menu-item-233 a").html(userFirstName + ' ' + userLastName);

                        var docencia = '';
                        docencia += '<h6>Docência</h6>';
                        docencia += '<ul class="list-unstyled">';
                        $(".select2-search-choice").each(function() {
                            var course = $(this).find('div').html(),
                            course_hash = removeDiacritics(course).replace(/ /g, "-").toLowerCase();
                            docencia += '<li><a href="' + homeUrl + '/cadeiras/' +  course_hash + '">' + course + '</a></li>';
                        });
                        docencia += '</ul>'; 
                        $("#user .detail.docencia").html(docencia);

                        $("#user .detail.website").html('<h6>Website</h6><a href="' + userUrl + '" target="_blank">' + userUrl + '</a>');
                        $("#user .detail.email").html('<h6>E-mail</h6><a href="mailto:' + userEmail + '?Subject=Contacto%20via%20site%20D+M">' + userEmail + '</a>')
                    
                        var social = '';
                        if (userFacebook != '' || userTwitter != '' || userPinterest != '' || userDribbble != '' || userBehance != '' || userVimeo != '') {
                            social += '<h6>Redes Sociais</h6>';
                            social += '<ul class="list-inline">';
                        }

                        if (userFacebook != '')
                            social += '<li><a href="http://facebook.com/' + userFacebook + '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
                        if (userTwitter != '')
                            social += '<li><a href="http://twitter.com/' + userTwitter + '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
                        if (userPinterest != '')
                            social += '<li><a href="http://pinterest.com/' + userPinterest + '" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
                        if (userDribbble != '')
                            social += '<li><a href="http://dribbble.com/' + userDribbble + '" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
                        if (userBehance != '')
                            social += '<li><a href="http://behance.com/' + userBehance + '" target="_blank"><i class="fa fa-behance"></i></a></li>';
                        if (userVimeo != '')
                            social += '<li><a href="http://vimeo.com/' + userVimeo + '" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';

                        if (userFacebook != '' || userTwitter != '' || userPinterest != '' || userDribbble != '' || userBehance != '' || userVimeo != '') {
                            social += '</ul>';
                        }
                        $("#user .detail.social").html(social);

                        loading = false;
                        $("#update-user").find('.loading').hide();
                        $("#update-user").find('.load').show(); 
                    }
                    //notification.show();
                }
            });
            
        }

    });
    
})(jQuery, this);