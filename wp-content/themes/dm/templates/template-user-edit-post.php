<?php
/**
 * Template Name: Editar Artigo
 *
 * Editar artigo a partir do frontend.
 *
 */?>

<?php acf_form_head(); ?>
<?php get_header(); ?>
 
    <!-- section -->
    <section class="backend container">

        <div class="cover-overlay"></div>

        <div class="row">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php acf_form(array(
                    'post_id'       => $_GET['artigo'],
                    'return'    => home_url().'/conta/artigos',
                    'submit_value'      => 'Actualizar Artigo'
                )); ?>

            <?php endwhile; ?>

        </div>

    </section><!-- #content -->
 
<?php get_footer(); ?>