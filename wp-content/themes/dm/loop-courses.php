<?php
	
	$args = array(
		'post_type' => array( 'cadeiras'),
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC'
	);
	$query = new WP_Query();
	$query->query( $args );

	$numPost=1;

?>
<?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>
	
	<?php 
		get_template_part('inc/post-type-course');

		if ($numPost % 2 == 0 && $numPost % 3 == 0) {
			echo '<div class="clearfix visible-sm visible-md visible-lg"></div>';
		} else if ($numPost % 2 == 0) {
			echo '<div class="clearfix visible-sm"></div>';
		} else if ($numPost % 3 == 0) {
			echo '<div class="clearfix visible-md visible-lg"></div>';
		}

		$numPost++;
	?>

<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_query(); ?>