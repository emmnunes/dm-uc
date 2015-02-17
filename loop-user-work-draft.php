<?php
	$user_id = get_current_user_id();
	$args = array(
		'post_type' => 'trabalhos',
		'post_status' => 'draft',
		'meta_query' => array(
			array (
	            'key'       => 'autor',
	            'value'     => $user_id,
	            'compare'   => 'LIKE'
	        )
        )
	);
	$query = new WP_Query( $args ); 
?>
<?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>

	<?php get_template_part('inc/post-type-work-user'); ?>

<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_query(); ?>