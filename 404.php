<?php get_header(); ?>

    <?php
        $args = array(
            'post_type' => 'trabalhos',
            'post_status' => 'publish',
            'orderby' => 'rand',
            'posts_per_page' => '1'
        );
        $query = new WP_Query( $args ); 
    
        if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
        
            $cover = get_field('imagem_principal',get_the_ID()); 
        
        endwhile; endif; 
    ?>

    <!-- secção 404 -->
    <section class="container-fluid" style="background-image: url('<?php echo $cover['sizes']['large']; ?>');">

        <div class="row overlay">

            <div class="h-align">
                <div class="v-align">
                    
                    <div class="col-xs-12">

                    	<!-- logo -->
                    	<div class="logo">
                        	<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="D+M">
                        </div>
                        <!-- /logo -->

                        <h2>Página não encontrada!</h2>

                        <br>

                        <a href="<?php echo home_url() ?>">Voltar para o d+m?</a>
                    </div>             

                </div>
            </div>

        </div>
		
	</section>
    <!-- /secção 404 -->

<?php get_footer(); ?>
