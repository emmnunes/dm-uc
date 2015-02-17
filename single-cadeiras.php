<?php get_header(); ?>

	<?php 
		$area = get_field('área_científica',get_the_ID());
		$ects = get_field('creditos_ects',get_the_ID());

		$teachers = new WP_User_Query( array( 'meta_key' => 'cadeiras', 'meta_value' => get_the_ID(), 'meta_compare' => 'LIKE' ) );
	?>

    <!-- section -->
    <section class="container">

        <div class="row">

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="col-xs-12 col-sm-4 col-md-5">
						<!-- post title -->
						<h1 class="caption"><?php the_title(); ?></br>_</h1>
						<!-- /post title -->

						<div class="details">
							<?php if (sizeof($teachers->results) > 1) {
								echo '<h6>Docentes</h6>';
							} else {
								echo '<h6>Docente</h6>';
							} ?>
							
							<ul class="list-unstyled">
								<?php
									if (!empty($teachers->results)) {
										foreach($teachers->results as $teacher) {
											echo '<li><a href="' . home_url() . '/docente/' . $teacher->user_nicename . '">' . $teacher->display_name . '</a></li>';
										}
									} else {
										echo '<li>Por definir</li>';
									}
								?>
							</ul>

							<h6>Área Científica</h6>
							<p><?php echo $area; ?></p>

							<h6>ECTS</h6>
							<p><?php echo $ects; ?></p>
						</div>

					</div>

					<div class="col-xs-12 col-sm-7 col-sm-offset-1 col-md-6 col-md-offset-1">

						<div class="content">

							<div class="description">

								<?php the_content(); // Dynamic Content ?>

							</div>

						</div>

					</div>

					<div class="clearfix divider"></div>

					<?php
						$args = array(
							'post_type' => 'trabalhos',
							'post_status' => 'publish',
							'meta_query' => array(
								array (
						            'key'       => 'cadeira',
						            'value'     => get_the_ID(),
						            'compare'   => 'LIKE'
						        )
					        )
						);
						$query = new WP_Query( $args ); 
					?>
					<?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>

						<?php get_template_part('inc/post-type-work'); ?>

					<?php endwhile; ?>

					<?php endif; ?>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>

					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

				</article>
				<!-- /article -->

			<?php endif; ?>

		</div>

	</section>
	<!-- /section -->

<?php get_footer(); ?>
