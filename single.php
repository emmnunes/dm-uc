<?php get_header(); ?>

	<?php 
		$cover = get_field('imagem_principal',get_the_ID()); 
		$description = get_field('conteudo',get_the_ID()); 
	?>

    <!-- section -->
    <section class="container">

        <div class="row">

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<div class="col-xs-12 col-md-4">
						<!-- post title -->
						<h1 class="caption"><?php the_title(); ?></br>_</h1>
						<!-- /post title -->

						<!-- post details -->

<!--  						<span class="date"><?php the_time('j F, Y'); ?></span> -->
 
 						<!-- post details -->

					</div>

					<div class="col-xs-12 col-md-7 col-md-offset-1">

						<div class="content">

							<!-- post thumbnail -->
							<?php if( !empty($cover) ): ?>
							 	
							 	<?php echo "<img src='" . $cover['sizes']['large'] . "'/>"; ?>

							<?php endif; ?>
							<!-- /post thumbnail -->

							<div class="description">

								<?php echo $description; // Dynamic Content ?>

							</div>

							<hr>

							<?php comments_template(); ?>

						</div>

					</div>

				</article>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>

					<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

				</article>
				<!-- /article -->

			<?php endif; ?>

		</div>

	</section>
	<!-- /section -->

	<div id="next-article">

		<?php
	        $args = array(
	        	'post__not_in' => array(get_the_ID()),
	            'post_type' => 'post',
	            'post_status' => 'publish',
	            'orderby' => 'rand',
	            'posts_per_page' => '1'
	        );
	        $query = new WP_Query( $args ); 
	    
	        if ($query->have_posts()): while ($query->have_posts()) : $query->the_post();
	        
	            $cover = get_field('imagem_principal',get_the_ID()); ?>

				<!-- article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
					
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

						<!-- post item-->
						<div class="item">

							<!-- post thumbnail -->
							<div class="background" data-isrc="<?php echo $cover['sizes']['xxl']; ?>" style="background-image: url('<?php echo $cover['sizes']['xxl']; ?>');"></div>
							<!-- /post thumbnail -->
							
							<div class="info">

								<!-- post details -->
								<span class="details"><?php echo get_the_time('y F Y'); ?></span>
								<!-- /post details -->

								<!-- post title -->
								<h2 class="title"><?php the_title(); ?></h2>
								<!-- /post title -->

							</div>

						</div>
						<!-- /post item-->
					</a>

				</article>
				<!-- /article -->

	    <?php  
	        endwhile; endif; 
	    ?>

	</div>

	<!-- modal remove comment -->
    <div id="modal-rc" class="md">
        <div class="md-content">
            <p>Tem a certeza que pretende apagar o comentário?</p>
            <ul class="list-inline">
                <li><button class="remove-comment">Sim</button></li>
                <li><button class="md-close">Não</button></li>
            </ul>
        </div>
    </div>
    <!-- /modal remove work -->

<?php get_footer(); ?>
