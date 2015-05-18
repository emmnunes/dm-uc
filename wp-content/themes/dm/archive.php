<?php get_header(); ?>

	<!-- section -->
	<section class="container">

		<div class="row">

			<div class="col-xs-12 col-sm-6 col-sm-offset-6">
				<h1 class="caption"><?php post_type_archive_title(); ?><br>_</h1>
			</div>

			<?php
				if ( is_post_type_archive('trabalhos') ) {

					echo '<div class="col-xs-12 col-sm-3">';

						/* Filter by Edition */
						$startYear = '2008';
						$currentYear = date("Y");
						$years = $currentYear - $startYear;

						echo '<select id="filter_edition" class="filter" name="filter_edition">';
						echo '<option value="">Ano Lectivo</option> ';

						for($i = 0; $i <= $years; $i++) {
							$value = ($startYear + $i) . "/" . ($startYear + ($i + 1));
							$option = '<option value="' . $value . '">';
							$option .= $value;
							$option .= '</option>';
							echo $option;
						}
						
						echo '</select>';

					echo '</div>';

					echo '<div class="col-xs-12 col-sm-3">';

						/* Filter by Course */
						$courses = get_posts(array('post_type' => 'cadeiras', 'posts_per_page'=> -1, 'post_status' => 'publish', 'order'=> 'ASC', 'orderby' => 'title' ));
						echo '<select id="filter_course" class="filter" name="filter_course">';
						echo '<option value="">Cadeira</option> ';

						foreach ( $courses as $course ) {
							$option = '<option value="' . $course->ID . '">';
							$option .= $course->post_title;
							$option .= '</option>';
							echo $option;
						}
						
						echo '</select>';

					echo '</div>';
					echo '<div class="col-xs-12 col-sm-3">';

						/* Filter by Category */
						$tags = get_terms('tags', 'hide_empty=0');
						echo '<select id="filter_tags" class="filter" name="filter_tags">';
						echo '<option value="">Categoria</option> ';

						foreach ( $tags as $tag ) {
							$option = '<option value="' . $tag->term_id . '">';
							$option .= $tag->name;
							$option .= '</option>';
							echo $option;
						}
						
						echo '</select>';

					echo '</div>';
					echo '<div class="col-xs-12 col-sm-3">';

						/* Filter by Teacher */	 
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

						echo '<select id="filter_teacher" name="filter_teacher data-placeholder="Docente">';
						echo '<option value="">Docente</option> ';

						foreach ( $users as $user ) {
							$option = '<option value="' . $user->id . '">';
							$option .= $user->display_name;
							$option .= '</option>';
							echo $option;
						}
						
						echo '</select>';

					echo '</div>'; ?>

					<div id="works"></div>

					<div class="clearfix"></div>
					<div class="col-xs-12">
						<button id="load-more" data-pages="">
							<span class="load">Carregar Mais</span>
							<span class="loading"><span class="one">.</span><span class="two">.</span><span class="three">.</span></span>
						</button>
					</div>
					
				<?php } else if ( is_post_type_archive('cadeiras') ) {
					get_template_part('loop-courses');
				} else {
					get_template_part('loop');
					get_template_part('pagination');
				}
			?>			

		</div>

	</section>
	<!-- /section -->

<?php get_footer(); ?>
