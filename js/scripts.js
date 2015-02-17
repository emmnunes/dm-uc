(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';

		svgeezy.init(false, 'png');

		/* Avatar text - user update page */
		$(".field_key-field_53c747e0a9ba7 .hide-if-value").html('<a data-name="add" class="acf-button" href="#"><i class="icon dm-imagem"></i></br>Carregar Avatar</a>');

		/* Text inside fields - add work page */
		$(".field_key-field_53cb216897aa1 input").attr("placeholder", "Copiar e colar link do Youtube ou Vimeo");
		$(".canvas-error").html('<p><strong>Erro</strong>. Por favor verifique se o link é válido.</p>');
		$(".field_key-field_53cb150657678 .hide-if-value").html('<a data-name="add" class="acf-button" href="#"><i class="icon dm-imagem"></i></br></br>Carregar Foto de Capa</a>');
		$(".field_key-field_53cb1191144f7 .hide-if-value, .field_key-field_53e04c9b38a5b .hide-if-value").html('<a data-name="add" class="acf-button" href="#"><i class="icon dm-imagem dm-4x"></i></br></br>Carregar Imagem</a>');
		$(".acf-input .canvas").append('<i class="icon dm-adiciona-video hide-if-value"></i>');
		$(".acf-gallery-toolbar .add-attachment").html('<i class="icon dm-adicionar"></i>  Carregar Imagens');
		$(".acf-fc-layout-handle").html('<i class="icon dm-ordenar" data-toggle="tooltip" data-placement="right" title="Arraste para organizar"></i>');
		$('.acf-fc-layout-handle i').tooltip();
		$(".acf-fc-layout-controlls").html('<i class="icon dm-apagar acf-fc-remove" data-toggle="tooltip" data-placement="right" title="Apagar"></i>');
		$('.acf-fc-layout-controlls i').tooltip();
		$("a[data-name='edit']").html('<i class="icon dm-alterar dm-2x"></i>');
		$("a[data-name='remove']").html('<i class="icon dm-alterar dm-2x"></i>');
		$('.extra i').tooltip();
		$('#categories i').tooltip();
		$('.tag i').tooltip();
		$('.social ul li').tooltip();
		//$(".acf-fc-layout-controlls").html('<i class="fa fa-plus acf-icon acf-fc-add" data-before="1" title="Adicionar layout"></i><br><i class="fa fa-trash-o acf-fc-remove"></i>');
			

		// $("#content-wrapper").scroll(function() {
		// 	var edge = $("#content-wrapper").scrollTop();

		// 	if ($('.cover-overlay').height()/2 <= edge) {
		// 		$('#photo-edit').addClass("dock");
		// 	} else {
		// 		$('#photo-edit').removeClass("dock");
		// 	}
		// });

		/* Reposition Image */
		// $(".field_key-field_53cb150657678 img").draggable({

		//     stop: function(ev, ui) {
		//         var hel = ui.helper, pos = ui.position;
		//         //horizontal
		//         var h = -(hel.outerHeight() - $(hel).parent().outerHeight());
		//         if (pos.top >= 0) {
		//             hel.animate({ top: 0 });
		//         } else if (pos.top <= h) {
		//             hel.animate({ top: h });
		//         }
		//         // vertical
		//         var v = -(hel.outerWidth() - $(hel).parent().outerWidth());
		//         if (pos.left >= 0) {
		//             hel.animate({ left: 0 });
		//         } else if (pos.left <= v) {
		//             hel.animate({ left: v });
		//         }
		//     }

		// });

		/* Proper title resize and dash - add work page */
		$("#acf-field_53cc0bf253174, #acf-field_53e42b7ef768c").autosize();
		$("#acf-field_53cc0bf253174, #acf-field_53e42b7ef768c").after( "<span class='dash'>_</span>" );

		/* Photo edit button - add work page */
		$("#photo-edit").on('click', function(){
			$(this).hide();
			$("#photo-edit-exit").css('display','block');
			$(".field_key-field_53cb150657678").css('z-index',1)
		});

		$("#photo-edit-exit").on('click', function(){
			$(this).hide();
			$("#photo-edit").css('display','block');
			$(".field_key-field_53cb150657678").css('z-index',-2)
		});

		/* Navigation & Search */
		var menuToggle = document.getElementById( 'navToggle' ),
		searchToggle = document.getElementById( 'searchToggle' ),
		overlayToggle = document.getElementById( 'overlayToggle' ),
		wrapper = document.getElementById( 'wrapper' ),
		header = document.getElementById( 'header' ),
		body = document.body;

		if (menuToggle){
			menuToggle.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( wrapper, 'push-left' );
				classie.toggle( header, 'push-left' );
				classie.toggle( overlayToggle, 'md-show' );
			};
		}

		if (overlayToggle) {
			overlayToggle.onclick = function() {
				if ($(menuToggle).hasClass('active')) {
					classie.toggle( menuToggle, 'active' );
					classie.toggle( wrapper, 'push-left' );
					classie.toggle( header, 'push-left' );
					classie.toggle( overlayToggle, 'md-show' );					
				}
				if ($(searchToggle).hasClass('active')) {
					$(header).css('-webkit-transform', 'translate3d(0,0,0)');
					$(header).css('-moz-transform', 'translate3d(0,0,0)');
					$(header).css('-ms-transform', 'translate3d(0,0,0)');
					$(header).css('-o-transform', 'translate3d(0,0,0)');
					$(header).css('transform', 'translate3d(0,0,0)');
					classie.toggle( body, 'no-scroll' );
					classie.toggle( searchToggle, 'active' );
					classie.toggle( wrapper, 'push-right' );
					classie.toggle( overlayToggle, 'md-show' );				
				}
			};			
		}

		if (searchToggle){
			searchToggle.onclick = function() {
				if ( $(this).hasClass('active') ){
					$(header).css('-webkit-transform', 'translate3d(0,0,0)');
					$(header).css('-moz-transform', 'translate3d(0,0,0)');
					$(header).css('-ms-transform', 'translate3d(0,0,0)');
					$(header).css('-o-transform', 'translate3d(0,0,0)');
					$(header).css('transform', 'translate3d(0,0,0)');
				} else {
					$(header).css('-webkit-transform', 'translate3d(' + size + ',0,0)');
					$(header).css('-moz-transform', 'translate3d(' + size + ',0,0)');
					$(header).css('-ms-transform', 'translate3d(' + size + ',0,0)');
					$(header).css('-o-transform', 'translate3d(' + size + ',0,0)');
					$(header).css('transform', 'translate3d(' + size + ',0,0)');
					$(header).on('transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd', function() {
						$("#procura").focus();
					});
				}
				classie.toggle( body, 'no-scroll' );
				classie.toggle( this, 'active' );
				classie.toggle( wrapper, 'push-right' );
				classie.toggle( overlayToggle, 'md-show' );	

			}
		}

		/* Wrappers and header proper size on resize and load */
		var size;
		jQuery(window).resize(function () {
			if (!$("body").hasClass('login') && !$("body").hasClass('recuperar') && !$("body").hasClass('registar')) {
				wrapperSize (jQuery(window).width(), jQuery(window).height());
			}
			if (Modernizr.touch) { 
				size = '-' + (jQuery(window).width()-55) + 'px';
			} else {
				size = '-' + (jQuery(window).width()-70) + 'px';
			}
			if ( $(searchToggle).hasClass('active') ){
				$(header).css('-webkit-transform', 'translate3d(' + size + ',0,0)');
				$(header).css('-moz-transform', 'translate3d(' + size + ',0,0)');
				$(header).css('-ms-transform', 'translate3d(' + size + ',0,0)');
				$(header).css('-o-transform', 'translate3d(' + size + ',0,0)');
				$(header).css('transform', 'translate3d(' + size + ',0,0)');
			}
		}).resize();

		function wrapperSize (width, height) {
			$("#content-wrapper").height(height);
			$("#search-wrapper").width(width-55);
		};

		function headerSize (width) {
			$("#header").width(width);
		};

		/* Search */

		var timer = 0;
		var loading = false;
		var done = 0;
		jQuery("#procura").keyup(function(e){
	        e.preventDefault();
	        var searchVal=$("#procura").val(); 
	        if (timer) {
	            clearTimeout(timer);
	        }
	        timer = setTimeout(function(){
	        	if (loading == false) {
	        		loading = true;
	        		done = 0;
		            dm_search_work(searchVal);
		            dm_search_post(searchVal);
		            dm_search_user(searchVal);
		            jQuery('#noticias').html('');
			        jQuery('#num-noticias').html('<span class="one">.</span><span class="two">.</span><span class="three">.</span>');
		        	jQuery('#trabalhos').html('');
		        	jQuery('#num-trabalhos').html('<span class="one">.</span><span class="two">.</span><span class="three">.</span>');
		        	jQuery('#pessoas').html('');
		        	jQuery('#num-pessoas').html('<span class="one">.</span><span class="two">.</span><span class="three">.</span>');
		        }
	        }, 1000);
	    });

		jQuery("#search-form").submit(function(e){
	        e.preventDefault();
	        loading = true;
	        done = 0;
	        var searchVal=$("#procura").val(); 
            jQuery('#noticias').html('');
	        jQuery('#num-noticias').html('<span class="one">.</span><span class="two">.</span><span class="three">.</span>');
        	jQuery('#trabalhos').html('');
        	jQuery('#num-trabalhos').html('<span class="one">.</span><span class="two">.</span><span class="three">.</span>');
        	jQuery('#pessoas').html('');
        	jQuery('#num-pessoas').html('<span class="one">.</span><span class="two">.</span><span class="three">.</span>');
	        //$("#search-wrapper .tab-pane").append('<h4 class="loading">Aguarde enquanto procuramos<span class="one">.</span><span class="two">.</span><span class="three">.</span></h4>');
	        dm_search_work(searchVal);
            dm_search_post(searchVal);
            dm_search_user(searchVal);
	    });

	    function dm_search_post(searchVal)
		{
		    jQuery.ajax({
		        type: "POST",
		        url: ajax_object.ajaxurl,
		        data: {
		            action:'dm_search_post', 
		            search_string:searchVal
		        },
                dataType   : "html",
		        success:function(data){
		        	jQuery('#noticias').html('');
		        	jQuery('#num-noticias').html('0');
		        	var $data = $(data);
		        	var numPosts = $data.find('.item').length;
		        	if ($data.length){
		        		jQuery('#num-noticias').html(numPosts);
                        $data.hide();
                        jQuery('#noticias').append($data);
                            $data.fadeIn(500, function(){
                        });
		        	}
		            done++;
		            if (done >= 3) {
		            	loading =false;
		            }
		        }
		    });
		}

		function dm_search_work(searchVal)
		{
		    jQuery.ajax({
		        type: "POST",
		        url: ajax_object.ajaxurl,
		        data: {
		            action:'dm_search_work', 
		            search_string:searchVal
		        },
		        success:function(data){
		            jQuery('#trabalhos').html('');
		            jQuery('#num-trabalhos').html('0');
		        	var $data = $(data);
		        	var numWorks = $data.find('.item').length;
		        	if ($data.length){
		        		jQuery('#num-trabalhos').html(numWorks);
                        $data.hide();
                        jQuery('#trabalhos').append($data);
                            $data.fadeIn(500, function(){
                        });
                        $('.type-trabalhos .tag').tooltip();
		            }
		            done++;
		            if (done >= 3) {
		            	loading =false;
		            }
		        }
		    });
		}

		function dm_search_user(searchVal)
		{
		    jQuery.ajax({
		        type: "POST",
		        url: ajax_object.ajaxurl,
		        data: {
		            action:'dm_search_user', 
		            search_string:searchVal
		        },
		        success:function(data){
		            jQuery('#pessoas').html('');
		            jQuery('#num-pessoas').html('0');
		            if (data != ''){
		                data = JSON.parse(data);
		                jQuery('#num-pessoas').html(data.length);
		                for (var i = 0; i < data.length; ++i) {
		                    var content = '<div class="col-xs-12 col-sm-4 col-md-3 user">';
		                    content += '<h2><a href="' + data[i].url + '">' + data[i].display_name + '</a></h2>';
		                    content += '<span>' + data[i].role + '</span>';
		                    content += '</div>';
		                    jQuery('#pessoas').append(content);
		                }
		            }
		            done++;
		            if (done >= 3) {
		            	loading =false;
		            }
		        }
		    });
		}

		function decode_utf8(s) {
		  return decodeURIComponent(escape(s));
		}	
		
	});
	
})(jQuery, this);
