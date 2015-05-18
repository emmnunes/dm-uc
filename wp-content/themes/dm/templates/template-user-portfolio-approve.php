<?php
/**
 * Template Name: Aprovar Trabalhos
 *
 * Permite ao docente visualizar trabalhos das suas cadeiras e aprovar/reprovar os mesmos.
 *
 */?>

<?php get_header(); ?>


    <?php
        $works = array();
        $current_user = wp_get_current_user();
        $username = $current_user->user_login;
        $user_id = get_current_user_id();

        $is_coordinator = check_user_role(array('contributor'), $username);

        $args = array(
            'post_type' => 'trabalhos',
            'post_status' => 'draft'
        );
        $query = new WP_Query( $args ); 
    ?>
    <?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>

        <?php $teachers = get_field('docente',get_the_ID()); ?>

        <?php 

        if (!empty($teachers) && ! $is_coordinator){

            foreach ($teachers as $teacher)
            {
                if( $teacher["ID"] == $user_id ) {
                    $works[] = get_the_ID();
                }
            }

        } else {
            $works[] = get_the_ID();
        }

        ?>

    <?php endwhile; ?>

    <?php endif; ?>
     
    <?php wp_reset_query(); ?>

    <?php 

        $courses = array(); 

        foreach ($works as $work)
        {
            $course = get_field('cadeira', $work);
            $course = get_the_title( $course );
            if (array_key_exists($course, $courses)) {
                $courses[$course][] = $work;
            } else {
                $courses[$course] = array($work);
            }
        }

    ?>

    <?php

        $courses_list = '';
        $i = 0;

        foreach ($courses as $course => $value)
        {
            $course_hash = strtolower(preg_replace('/\s*/', '', $course));
            if ($i == 0) {
                $courses_list .= '<li class="active"><a href="#' . $course_hash . '" role="tab" data-toggle="tab">' . $course . '</a></li>';
            } else {
                $courses_list .= '<li><a href="#' . $course_hash . '" role="tab" data-toggle="tab">' . $course . '</a></li>';
            }

            $i++;
        }

    ?>

    <!-- section -->
    <section class="container backend">

        <div class="row">

            <div class="col-xs-12">

                <h1 class="caption"><?php the_title(); ?></h1>
                <hr>

                <ul class="nav nav-tabs" role="tablist">
                    <?php echo $courses_list; ?>
                </ul>

            </div>

            <div class="tab-content">

                <?php

                    $i = 0;
                    if(sizeof($courses) > 0) {
                        foreach ($courses as $course => $value)
                        {
                            $course_hash = strtolower(preg_replace('/\s*/', '', $course));
                            if ($i == 0) {
                                echo '<div id="' . $course_hash . '" class="tab-pane fade active in">';
                            } else {
                                echo '<div id="' . $course_hash . '" class="tab-pane fade">';
                            }

                            foreach ($value as $work) {
                                include(locate_template('inc/post-type-work-id.php'));
                            }

                            echo '</div>';
                            $i++;
                        }
                    } else {
                        echo '<div class="col-xs-12"><h4>Não existem trabalhos para aprovar de momento!</h4></div>';
                    }
                    
                ?>

            </div>
    
        </div>

    </section><!-- #content -->

    <!-- modal approve work -->
    <div id="modal-aw" class="md">
        <div class="md-content">
            <p>Tem a certeza que pretende aprovar o trabalho?</p>
            <ul class="list-inline">
                <li><button class="approve-work">Sim</button></li>
                <li><button class="md-close">Não</button></li>
            </ul>
        </div>
    </div>
    <!-- /modal approve work -->

    <!-- modal reject work -->
    <div id="modal-dw" class="md">
        <div class="md-content">
            <p>Tem a certeza que pretende rejeitar o trabalho?</p>
            <ul class="list-inline">
                <li><button class="reject-work">Sim</button></li>
                <li><button class="md-close">Não</button></li>
            </ul>
        </div>
    </div>
    <!-- /modal reject work -->
 
<?php get_footer(); ?>