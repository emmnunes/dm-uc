<?php
/**
 * Template Name: Docentes
 *
 * Lista todos os docentes existentes na plataforma.
 *
 */?>

<?php get_header(); ?>

    <!-- section -->
    <section class="container">

        <div class="row">

			<div class="col-xs-12 col-sm-6 col-sm-offset-6">
				<h1 class="caption"><?php the_title(); ?><br>_</h1>
			</div>

			<?php 
				$subscriber_query = new WP_User_Query( array( 'role' => 'subscriber', 'orderby' => 'display_name', 'order' => 'ASC' ) );
				$subscriber = $subscriber_query->get_results();
				$coordinator_query = new WP_User_Query( array( 'role' => 'contributor', 'orderby' => 'display_name', 'order' => 'ASC' ) );
				$coordinator = $coordinator_query->get_results();
				$teacher_author_query = new WP_User_Query( array( 'role' => 'teacher_author', 'orderby' => 'display_name', 'order' => 'ASC' ) );
				$teacher_author = $teacher_author_query->get_results();
				$users = array_merge( $subscriber, $coordinator, $teacher_author);

				function order_users($a, $b){  
				  if ($a->display_name == $b->display_name) {  
				    return 0; 
				  } 
				  return ($b->display_name > $a->display_name ) ? -1 : 1;
				} 
				usort($users, 'order_users');

				$numTeacher=1;
			?>

			<?php if ( ! empty( $users ) ):
				foreach ( $users as $user ) {
					$avatar = get_field('avatar', 'user_' . $user->id);
					if ( get_field('docente_visivel', 'user_' . $user->id) !== false ) {
					//if ( ! empty( $user->first_name ) && ! empty( $user->last_name ) && ! empty( $avatar ) ) {
						echo '<div class="col-xs-12 col-sm-4 col-md-3 user">';
						echo '<div class="avatar">';
						echo '<a href="' . home_url() . '/docente/' . $user->user_nicename . '">';
						if (!empty($avatar)) {
							echo '<img src="' . $avatar["url"] . '" />';
						} else {
							echo '<img src="' . get_template_directory_uri() . '/img/avatar.png" alt="Logo" class="logo-img">';
						}
						echo '</a>';
						echo '</div>';
						echo '<div class="details">';
						echo '<h2><a href="' . home_url() . '/docente/' . $user->user_nicename . '">' . $user->display_name . '</a></h2>';
						echo '</div>';
						echo '</div>';
						if ($numTeacher % 3 == 0 && $numTeacher % 4 == 0) {
							echo '<div class="clearfix visible-sm visible-md visible-lg"></div>';
						} else if ($numTeacher % 3 == 0) {
							echo '<div class="clearfix visible-sm"></div>';
						} else if ($numTeacher % 4 == 0) {
							echo '<div class="clearfix visible-md visible-lg"></div>';
						}
						$numTeacher++;
					}
				} ?>
			<?php else: ?>

				<!-- article -->
				<article>

					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

				</article>
				<!-- /article -->

			<?php endif; ?>

		</div>

	</section>
	<!-- /section -->

<?php get_footer(); ?>
