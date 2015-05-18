<?php
	$args = array(
		'post_type' => 'trabalhos',
		'post_status' => 'publish',
		'meta_query' => array(
			array (
	            'key'       => 'autor',
	            'value'     => $author->ID,
	            'compare'   => 'LIKE'
	        )
        )
	);
	$query = new WP_Query( $args ); 
?>
<?php if ($query->have_posts()): 
	
	while ($query->have_posts()) : $query->the_post(); ?>
		
		<?php get_template_part('inc/post-type-work-profile'); ?>

	<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_query(); ?>
