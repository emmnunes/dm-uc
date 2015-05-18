<?php
/**
 * Template Name: Notícias
 *
 * Mostra todas as notícias publicadas.
 *
 */
?>

<?php get_header(); ?>

	<!-- section -->
	<section class="container">

		<div class="row">

			<div class="col-xs-12 col-sm-6 col-sm-offset-6">
				<h1 class="caption"><?php the_title(); ?><br>_</h1>
			</div>

			<?php get_template_part('loop-posts');?>

			<?php get_template_part('pagination'); ?>

		</div>

	</section>
	<!-- /section -->

<?php get_footer(); ?>
