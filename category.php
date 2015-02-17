<?php get_header(); ?>

    <main role="main" class="container">
        <!-- section -->
        <section class="row">

        	<div class="col-xs-12">

				<h1><?php _e( 'Categories for ', 'html5blank' ); single_cat_title(); ?></h1>

				<?php get_template_part('loop-item'); ?>

				<?php get_template_part('pagination'); ?>

			</div>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
