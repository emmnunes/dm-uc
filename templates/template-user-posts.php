<?php
/**
 * Template Name: Artigos Editor
 *
 * Permite visualizar os próprios artigos do editor com sessão iniciada.
 *
 */?>

<?php get_header(); ?>

    <!-- section -->
    <section class="container backend">

        <div class="row">

            <div class="col-xs-12">

                <h1 class="caption"><?php the_title(); ?></h1>
                
                 <hr>
                 
            </div>

            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="item novo">
                    <a href="./novo">
                        <div class="h-align">
                            <div class="v-align">
                                <i class='icon dm-adicionar dm-4x'></i>
                                <span> 
                                    Novo Artigo
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <?php get_template_part('loop-user-post'); ?>
    
        </div>

    </section><!-- #content -->

    <!-- modal remove work -->
    <div id="modal-rp" class="md">
        <div class="md-content">
            <p>Tem a certeza que pretende apagar o trabalho?</p>
            <ul class="list-inline">
                <li><button id="remove-post">Sim</button></li>
                <li><button class="md-close">Não</button></li>
            </ul>
        </div>
    </div>
    <!-- /modal remove work -->
 
<?php get_footer(); ?>