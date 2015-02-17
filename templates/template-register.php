<?php
/**
 * Template Name: Registar Conta
 *
 * Permite fazer o registo na plataforma.
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

        $approve = false;

        if ($_GET['activar']) {
            $user = get_users(array('meta_key' => 'has_to_be_activated', 'meta_value' => $_GET['activar']));

            if ($user[0]->user_login != '') {
                $approve = true;
                delete_user_meta( $user[0]->ID, 'has_to_be_activated' );
            } 
        }
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
                        
                    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                        <?php if ($approve) { ?>
                            <h3 class="activated-message">A sua conta foi activada!</h3>
                            <a href="<?php echo home_url() ?>/login">Login</a>
                        <?php } else { ?>
                            <!-- formulário de registo -->
                            <form id="register-form" action="register" method="post">          
                                <input type="text" id="username" name="username" placeholder="Utilizador" autocomplete="off" />
                                <input type="email" id="email" name="email" placeholder="E-Mail" autocomplete="off" />
                                <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" />
                                <input type="password" id="checkPassword" name="checkPassword" placeholder="Repetir Password" autocomplete="off" />
                                <input type="submit" value="Registar" name="submit" class="done-button" />
                                <p class="status"></p>
                                <a href="<?php echo home_url() ?>/login">Já se registou?</a>
                                <?php wp_nonce_field( 'ajax-register-nonce', 'security' ); ?>
                            </form>
                            <!-- /formulário de registo -->
                        <?php } ?>
                    </div>           

                </div>
            </div>

        </div>
		
	</section>
    <!-- /secção login -->

<?php get_footer(); ?>
