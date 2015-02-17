<?php
/**
 * Template Name: Editar Trabalho
 *
 * Editar trabalho a partir do frontend.
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
                    'post_id'       => $_GET['trabalho'],
                    'return'    => home_url().'/conta/portfolio',
                    'submit_value'      => 'Actualizar Trabalho',
                    'instruction_placement' => 'field'
                )); ?>

            <?php endwhile; ?>

        </div>

    </section><!-- #content -->
 
<?php get_footer(); ?>