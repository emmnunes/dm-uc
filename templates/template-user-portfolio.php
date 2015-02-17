<?php
/**
 * Template Name: Portfolio Aluno
 *
 * Permite visualizar os próprios trabalhos do aluno com sessão iniciada.
 *
 */?>

<?php get_header(); ?>

    <!-- section -->
    <section class="container backend">

        <div class="row">

            <div class="col-xs-12">

                <h1 class="caption"><?php the_title(); ?></h1>
                <hr>

                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#aprovados" role="tab" data-toggle="tab">Aprovados</a></li>
                    <li><a href="#poraprovar" role="tab" data-toggle="tab">Por aprovar</a></li>
                </ul>

            </div>

            <div class="tab-content">

                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="item novo">
                        <a href="./novo">
                            <div class="h-align">
                                <div class="v-align">
                                    <i class='icon dm-adicionar'></i>
                                    <span> 
                                        Novo Trabalho
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div id="aprovados" class="tab-pane fade active in">
                    <?php get_template_part('loop-user-work'); ?>
                </div>
                <div id="poraprovar" class="tab-pane fade">
                    <?php get_template_part('loop-user-work-draft'); ?>
                </div>
            </div>
    
        </div>

    </section><!-- #content -->

    <!-- modal remove work -->
    <div id="modal-rw" class="md">
        <div class="md-content">
            <p>Tem a certeza que pretende apagar o trabalho?</p>
            <ul class="list-inline">
                <li><button class="remove-work">Sim</button></li>
                <li><button class="md-close">Não</button></li>
            </ul>
        </div>
    </div>
    <!-- /modal remove work -->
 
<?php get_footer(); ?>