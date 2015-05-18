<?php
/**
 * Template Name: Novo Artigo
 *
 * Permite adicionar um trabalho novo para aprovação através do frontend.
 *
 */?>

<?php acf_form_head(); ?>
<?php get_header(); ?>
 
    <!-- section -->
    <section class="backend container">

        <div class="row">

            <?php while ( have_posts() ) : the_post(); ?>

                <?php acf_form(array(
                    'post_id'       => 'new_post',
                    'new_post'      => array(
                        'post_type'     => 'post',
                        'post_status'       => 'publish'
                    ),
                    'return'    => home_url() . '/conta/artigos',
                    'submit_value'      => 'Adicionar Artigo',
                    'instruction_placement' => 'field'
                )); ?>

            <?php endwhile; ?>

            <div class="cover-overlay"></div>

        </div>

    </section><!-- #content -->
 
<?php get_footer(); ?>