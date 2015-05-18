(function ($, root, undefined) {
    
    $(function () {
        
        'use strict';

        var ModalEffects = (function() {

            function init() {

                var overlay = document.querySelector( '.md-overlay' );

                [].slice.call( document.querySelectorAll( '.md-trigger' ) ).forEach( function( el, i ) {

                    var modal = document.querySelector( '#' + el.getAttribute( 'data-modal' ) ),
                        close = modal.querySelector( '.md-close' );

                    function removeModal() {
                        classie.remove( modal, 'md-show' );
                    }

                    function removeModalHandler() {
                        removeModal(); 
                    }

                    el.addEventListener( 'click', function( ev ) {
                        classie.add( modal, 'md-show' );
                        overlay.removeEventListener( 'click', removeModalHandler );
                        overlay.addEventListener( 'click', removeModalHandler );
                        
                        if (modal == document.getElementById("modal-rw")){
                            $(modal).find('.remove-work').attr('data-id',$(this).attr('data-id'));
                            $(modal).find('.remove-work').attr('data-nonce',$(this).attr('data-nonce'));
                        }

                        if (modal == document.getElementById("modal-aw")){
                            $(modal).find('.approve-work').attr('data-id',$(this).attr('data-id'));
                            $(modal).find('.approve-work').attr('data-nonce',$(this).attr('data-nonce'));
                        }

                        if (modal == document.getElementById("modal-dw")){
                            $(modal).find('.reject-work').attr('data-id',$(this).attr('data-id'));
                            $(modal).find('.reject-work').attr('data-nonce',$(this).attr('data-nonce'));
                        }

                        if (modal == document.getElementById("modal-rp")){
                            $(modal).find('#remove-post').attr('data-id',$(this).attr('data-id'));
                            $(modal).find('#remove-post').attr('data-nonce',$(this).attr('data-nonce'));
                        }

                        if (modal == document.getElementById("modal-rc")){
                            $(modal).find('.remove-comment').attr('data-id',$(this).attr('data-id'));
                            $(modal).find('.remove-comment').attr('data-nonce',$(this).attr('data-nonce'));
                        }
                    });

                    close.addEventListener( 'click', function( ev ) {
                        ev.stopPropagation();
                        removeModalHandler();
                    });

                } );

            }

            init();

        })(); 

    });
    
})(jQuery, this);