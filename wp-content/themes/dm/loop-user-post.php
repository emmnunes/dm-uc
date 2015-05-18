<?php
	$current_user = wp_get_current_user();
	$username = $current_user->user_login;
	$user_id = get_current_user_id();

	$is_coordinator = check_user_role(array('contributor'), $username);
	if ($is_coordinator) {
		$user_id = '';
	}
	
	$args = array(
		'author' => $user_id,
		'post_type' => 'post',
		'post_status' => 'publish'
	);
	$query = new WP_Query( $args ); 
?>
<?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>

	<?php get_template_part('inc/post-type-post-user'); ?>

<?php endwhile; ?>

<?php endif; ?>
