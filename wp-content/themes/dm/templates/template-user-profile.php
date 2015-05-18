 <?php
/* Get user info. */
global $current_user;
get_currentuserinfo();
acf_form_head();
?>

<?php get_header(); ?>

        <!-- section -->
        <section class="container backend">

            <div class="row">

<!--                 <div class="col-xs-12">

                    <h1 class="caption"><?php the_title(); ?></h1>
                    
                    <hr>

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#perfil" role="tab" data-toggle="tab">Perfil</a></li>
                        <li><a href="#seguranca" role="tab" data-toggle="tab">Segurança</a></li>
                        <li><a href="#link" role="tab" data-toggle="tab">Link Perfil</a></li>
                    </ul>

                </div> -->

                <div class="tab-content">

                    <div id="user-edit" class="tab-pane fade active in">
                        
                        <form method="post" id="user-update-form" action="<?php the_permalink(); ?>">

                            <div class="col-xs-12 col-sm-5 col-sm-offset-1">
                                <?php acf_form(array(
                                    'post_id' => 'user_' . $current_user->ID,
                                    'field_groups' => array(92),
                                    'instruction_placement' => 'field',
                                    'form' => false
                                )); ?>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-sm-offset-1">
                                <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $current_user->ID ); ?>" placeholder="John" autocomplete="off" />
                                <input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $current_user->ID ); ?>" placeholder="Doe" autocomplete="off" />
                                <span id="name-dash">_</span>
                            </div>

                            <div class="clearfix form-divider"></div>

                            <div class="col-xs-12 col-sm-5 col-sm-offset-1">
                                <textarea name="description" id="description" rows="3" cols="50" placeholder="Escreva uma pequena biografia"><?php the_author_meta( 'description', $current_user->ID ); ?></textarea>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-sm-offset-1">
                                <label class="form-title">Website</label>
                                <input class="text-input" name="url" type="text" id="url" value="<?php the_author_meta( 'user_url', $current_user->ID ); ?>" placeholder="www.johndoe.com" />
                                <label class="form-title">E-Mail</label>
                                <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $current_user->ID ); ?>" placeholder="johndoe@email.com" />
                                <label class="form-title">Redes Sociais</label>
                                <div class="social">
                                    <?php acf_form(array(
                                        'post_id' => 'user_' . $current_user->ID,
                                        'field_groups' => array(102),
                                        'form' => false
                                    )); ?>
                                </div>
                            </div>

                            <div class="clearfix form-divider"></div>

                            <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                                <?php echo $referer; ?>
                                <input name="updateuser" type="submit" id="update-user" class="submit button" value="<?php _e('Gravar'); ?>" />
                                <?php wp_nonce_field( 'update-user' ) ?>
                                <input name="action" type="hidden" id="action" value="update-user" />
                            </div>

                        </form>

                    </div>

                    <div id="seguranca" class="tab-pane fade">
                        <p class="form-password">
                            <label for="pass1"><?php _e('Nova Password:', 'profile'); ?> </label>
                            <input class="text-input" name="pass1" type="password" id="pass1" />
                        </p><!-- .form-password -->
                        <p class="form-password">
                            <label for="pass2"><?php _e('Repetir Password:', 'profile'); ?></label>
                            <input class="text-input" name="pass2" type="password" id="pass2" />
                        </p><!-- .form-password -->
                    </div>

                    <div id="link" class="tab-pane fade">

                    </div>
                </div>
        
            </div>

        </section><!-- #content -->

	</main>

<?php get_footer(); ?>
