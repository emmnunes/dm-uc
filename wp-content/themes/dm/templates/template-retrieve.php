<?php
/**
 * Template Name: Recuperar Password
 *
 * Permite recuperar password para um determinado utilizador.
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

        $recover = false;
        if ($_GET['chave'] && $_GET['login']) {
            $user_login = $_GET['login'];
            $user = get_user_by ('login', $user_login);
            $key = $user->user_activation_key;
            if ($key == $_GET['chave']) {
                $recover = true;
            }
        }
    ?>

    <!-- secção recuperar password -->
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
                        <?php if ($recover): ?>
                            <!-- formulário de mudança de password -->
                            <form id="change-password" action="resetpass" method="post">          
                                <input type="password" id="password" name="password" placeholder="Nova Password" autocomplete="off" />
                                <input type="password" id="checkPassword" name="checkPassword" placeholder="Repetir Password" autocomplete="off" />
                                <input type="submit" value="Recuperar Password" name="submit" class="done-button" />
                                <p class="status"></p>
                                <?php wp_nonce_field( 'ajax-password-nonce', 'security' ); ?>
                                <input type="hidden" id="userToChange" name="userToChange" value="<?php echo $user_login; ?>">
                            </form>
                            <!-- /formulário de mudança de password -->
                        <?php else: ?>
                            <!-- formulário de recuperação de password -->
                            <form id="recover-form" action="resetpass" method="post">          
                                <input type="text" id="username" name="username" placeholder="Utilizador ou E-mail" autocomplete="off" />
                                <input type="submit" value="Recuperar Password" name="submit" class="done-button" />
                                <p class="status"></p>
                                <a href="<?php echo home_url() ?>/login">Efectuar login?</a>
                                <?php wp_nonce_field( 'ajax-recover-nonce', 'security' ); ?>
                            </form>
                            <!-- /formulário de recuperação de password -->
                        <?php endif; ?>
                    </div>

                </div>
            </div>

        </div>
		
	</section>
    <!-- /secção recuperar password -->

<?php get_footer(); ?>
