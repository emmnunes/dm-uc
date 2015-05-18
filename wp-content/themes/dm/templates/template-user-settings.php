<?php
/**
 * Template Name: Definições
 *
 * Permite fazer algumas configurações.
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
                    <li class="active"><a href="#seguranca" role="tab" data-toggle="tab">Segurança</a></li>
                    <li><a href="#link" role="tab" data-toggle="tab">Link Perfil</a></li>
                </ul>

            </div>

            <div class="tab-content">

                <div id="seguranca" class="tab-pane fade active in">
                    <!-- formulário de mudança de password -->
                    <form id="change-password" action="resetpass" method="post">
                        <div class="col-xs-12 col-sm-6">    
                            <input type="password" id="password" name="password" placeholder="Nova Password" autocomplete="off" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="password" id="checkPassword" name="checkPassword" placeholder="Repetir Password" autocomplete="off" />
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 col-sm-6">
                            <input type="submit" value="Alterar" name="submit"/>
                            <p class="status"></p>
                            <?php wp_nonce_field( 'ajax-password-nonce', 'security' ); ?>
                        </div>
                    </form>
                    <!-- /formulário de mudança de password -->
                </div>

                <div id="link" class="tab-pane fade">
                    <!-- formulário de mudança de link -->
                    <form id="change-nicename" action="updatenicename" method="post">
                        <div class="col-xs-12">
                            <?php 
                                $user = wp_get_current_user();

                                $is_student = check_user_role(array('author'), $user->user_login);
                                $is_teacher = check_user_role(array('subscriber','contributor','teacher_author'), $user->user_login);

                                if ($is_student) {
                                    $link = "<span class='url'>" . home_url() . "</span>/aluno/";
                                } else if ($is_teacher) {
                                    $link = "<span class='url'>" . home_url() . "</span>/docente/";
                                }
                            ?>
                            <div class="prepend"><?php echo $link; ?></div>   
                            <div class="append"><input type="text" id="nicename" name="nicename" placeholder="johndoe" autocomplete="off"/></div>
                            <div class="current-link">Link actual: <?php echo '<span class="prepend">' . $link . '</span>';?><?php echo $user->user_nicename; ?></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12">
                            <input type="submit" value="Alterar" name="submit"/>
                            <p class="status"></p>
                            <?php wp_nonce_field( 'ajax-nicename-nonce', 'security' ); ?>
                        </div>
                    </form>
                    <!-- /formulário de mudança de link -->
                </div>
            </div>
    
        </div>

    </section><!-- #content -->
 
<?php get_footer(); ?>