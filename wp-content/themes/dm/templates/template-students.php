<?php
/**
 * Template Name: Alunos
 *
 * Lista todos os alunos existentes na plataforma.
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
				$author_query = new WP_User_Query( array( 'role' => 'author', 'orderby' => 'display_name', 'order' => 'ASC', 'posts_per_page' => -1 ) );
				$author = $author_query->get_results(); 
				$teacher_author_query = new WP_User_Query( array( 'role' => 'teacher_author', 'orderby' => 'display_name', 'order' => 'ASC', 'posts_per_page' => -1 ) );
				$teacher_author = $teacher_author_query->get_results();
				$users = array_merge( $author, $teacher_author);

				setlocale(LC_COLLATE, 'sk_SK.utf8');

				usort($users, 'order_users');

				function order_users($a, $b){
				  return strcoll ($a->display_name, $b->display_name);
				} 			

				$numStudent=1;
			?>

			<?php if ( ! empty( $users ) ):
				foreach ( $users as $user ) {
					$avatar = get_field('avatar', 'user_' . $user->id);
					if ( ! empty( $user->first_name ) && ! empty( $user->last_name ) && ! empty( $avatar ) ) {
						echo '<div class="col-xs-12 col-sm-4 col-md-3 user">';
						echo '<h2><a href="' . home_url() . '/aluno/' . $user->user_nicename . '">' . $user->display_name . '</a></h2>';
						echo '</div>';
						if ($numStudent % 3 == 0 && $numStudent % 4 == 0) {
							echo '<div class="clearfix visible-sm visible-md visible-lg"></div>';
						} else if ($numStudent % 3 == 0) {
							echo '<div class="clearfix visible-sm"></div>';
						} else if ($numStudent % 4 == 0) {
							echo '<div class="clearfix visible-md visible-lg"></div>';
						}
						$numStudent++;
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
