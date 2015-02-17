<?php
	$classes = array(
		'col-xs-12',
		'col-sm-6',
		'col-md-4'
	);
?>

<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<!-- post title -->
	<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<!-- /post title -->
	
</article>
<!-- /article -->