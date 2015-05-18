<?php
	$args = array(
		'posts_per_page' => '12',
		'post_type' => array( 'post', 'trabalhos'),
		'post_status' => 'publish'
	);
	$query = new WP_Query( $args ); 
?>
<?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>
	
	<?php 
		if (get_post_type() == 'trabalhos') {
			get_template_part('inc/post-type-work');
		} elseif (get_post_type() == 'post') {
			get_template_part('inc/post-type-post');
		} 
	?>

<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_query(); ?>