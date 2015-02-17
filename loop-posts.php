<?php
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish'
	);
	$query = new WP_Query( $args ); 
?>
<?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>
	
	<?php get_template_part('inc/post-type-post'); ?>

<?php endwhile; ?>

<?php endif; ?>

<?php wp_reset_query(); ?>
