<?php
/**
 * Template Name: Login
 *
 * Permite fazer o login na plataforma.
 *
 */

get_header(); ?>

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

    <!-- secção login -->
    <section class="container-fluid" style="background-image: url('<?php echo $cover['sizes']['large']; ?>');">

        <div class="row overlay">

            <div class="h-align">
                <div class="v-align">

                    <!-- logo -->
                    <div class="col-xs-12 logo">
                        <a href="<?php echo home_url() ?>">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="D+M">
                        </a>
                    </div>
                    <!-- /logo -->

                    <!-- formulário de login -->
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <form id="login-form" action="login" method="post">          
                            <input type="text" id="username" name="username" placeholder="Utilizador" autocomplete="off" />
                            <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" />
                            <input type="submit" value="Login" name="submit" class="done-button" />
                            <p class="status"></p>
                            <a href="<?php echo home_url() ?>/registar">Registar uma nova conta</a><br>
                            <a href="<?php echo home_url() ?>/recuperar">Esqueceu-se da password?</a>
                            <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
                        </form>
                    </div>
                    <!-- /formulário de login -->

                </div>
            </div>

        </div>
		
	</section>
    <!-- /secção login -->

<?php get_footer(); ?>
