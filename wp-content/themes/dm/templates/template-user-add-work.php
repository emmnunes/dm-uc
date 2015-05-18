<?php
/**
 * Template Name: Novo Trabalho
 *
 * Permite adicionar um trabalho novo para aprovação através do frontend.
 *
 */?>

<?php acf_form_head(); ?>
<?php get_header(); ?>
 
    <!-- section -->
    <section class="backend container">

        <div class="row">
            <?php 
                // $last = wp_get_recent_posts(array('numberposts' => 1,'post_type' => array('post','trabalhos')));
                // $last_id = $last['0']['ID'];
                // echo $last_id;
            ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php acf_form(array(
                    'post_id'       => 'new_post',
                    'new_post'      => array(
                        'post_type'     => 'trabalhos',
                        'post_status'       => 'draft'
                    ),
                    'return'    => home_url().'/conta/portfolio',
                    'submit_value'      => 'Adicionar Trabalho',
                    'instruction_placement' => 'field'
                )); ?>

            <?php endwhile; ?>

            <div class="cover-overlay"></div>

        </div>

    </section><!-- #content -->
 
<?php get_footer(); ?>