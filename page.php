<?php get_header(); ?>

    <!-- section -->
    <section class="container">

    	<div class="row">

			<div class="col-xs-12 col-sm-6 col-sm-offset-6">
				<h1 class="caption"><?php the_title(); ?><br>_</h1>
			</div>

	    	<div class="col-xs-12">		

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<?php the_content(); ?>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>

					<h2><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h2>

				</article>
				<!-- /article -->

			<?php endif; ?>

			</div>

		</div>

	</section>
	<!-- /section -->

<?php get_footer(); ?>
