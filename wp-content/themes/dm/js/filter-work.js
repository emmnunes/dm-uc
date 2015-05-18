(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        var md = new MobileDetect(window.navigator.userAgent);
        var page = 1;
        var posts;
        var loading = true;
        var $content = $("#works");
        var button = $("#load-more");

        if (md.phone() == null && md.mobile() == null && md.tablet() == null) {
            posts = 12;
        } else {
            posts = 6;
        }

        $("#filter_course, #filter_tags, #filter_edition, #filter_teacher").select2();

        function getCourse() {
            var course = document.getElementById("filter_course");
            course = course.options[course.selectedIndex].value;
            return course;
        }

        function getCourseName() {
            var courseName = document.getElementById("filter_course");
            courseName = courseName.options[courseName.selectedIndex].text;
            return courseName;
        }

        function getTag() {
            var tag = document.getElementById("filter_tags");
            tag = tag.options[tag.selectedIndex].value;
            return tag;
        }

        function getTagName() {
            var tagName = document.getElementById("filter_tags");
            tagName = tagName.options[tagName.selectedIndex].text;
            return tagName;
        }

        function getEdition() {
            var edition = document.getElementById("filter_edition");
            edition = edition.options[edition.selectedIndex].value;
            return edition;
        }

        function getTeacher() {
            var teacher = document.getElementById("filter_teacher");
            teacher = teacher.options[teacher.selectedIndex].value;
            return teacher;
        }

        function getTeacherName() {
            var teacherName = document.getElementById("filter_teacher");
            teacherName = teacherName.options[teacherName.selectedIndex].text;
            return teacherName;
        }

        $( "#filter_course, #filter_tags, #filter_edition, #filter_teacher" ).change(function() {
            page = 1;
            $('#works').html('');
            button.hide();
            getNumPages();
            getWorks();
        });

        function getNumPages() {
            $.ajax({
                type : "GET",
                url: ajax_object.ajaxurl,
                data: {
                    action: 'dm_get_num_works',
                    course: getCourse,
                    tag: getTag,
                    edition: getEdition,
                    teacher: getTeacher,
                    numPosts : posts
                },
                success: function(data){
                    button.attr('data-pages',data);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
            });
        }

        function getWorks() {
            $.ajax({
                type: 'GET',
                url: ajax_object.ajaxurl,
                data: {
                    action: 'dm_get_works',
                    course: getCourse,
                    tag: getTag,
                    edition: getEdition,
                    teacher: getTeacher,
                    numPosts : posts,
                    pageNumber: page
                },
                dataType   : "html",
                beforeSend: function ()
                {                   
                    if(page != 1){
                        button.find('.loading').show();
                        button.find('.load').hide();
                    } else {
                        $('#works').html('<div class="col-xs-12"><h4>A carregar trabalhos<span class="one">.</span><span class="two">.</span><span class="three">.</span></h4></div>');
                    }
                },
                success: function(data)
                {
                    if(page == 1){
                        $('#works').html('');
                    }
                    var text = 'Trabalhos<br>';
                    if (getCourse() != '' ) {
                        text += 'de ' + getCourseName() + '<br>';
                    }
                    if (getTag() != '' ) {
                        text += 'em ' + getTagName() + '<br>';
                    }
                    if (getEdition() != '' ) {
                        text += 'de ' + getEdition() + '<br>';
                    }
                    if (getTeacher() != '' ) {
                        text += 'orientados por ' + getTeacherName() + '<br>';
                    }
                    text += '_';
                    $('#content .caption').html(text);

                    var $data = $(data);
                    if($data.length){
                        $data.hide();
                        $content.append($data);
                        $data.fadeIn(500, function(){
                            loading = false;
                            button.find('.loading').hide();
                            button.find('.load').show();
                            if(page == 1 && $data.length > 1) {
                                button.css('display','block');
                            }
                            if (button.attr('data-pages') == page) {
                                button.fadeOut();
                            }        
                        });
                        $('.type-trabalhos .tag').tooltip();
                    } else {
                        loading = false;
                    }        
                },
                error: function()
                {
                    console.log('erro');
                }
            }); 
        }
        button.click(function() {
            if (loading == false) {
                loading = true;
                page++;
                getWorks();
            }
        });
        getNumPages();
        getWorks();

    });
    
})(jQuery, this);