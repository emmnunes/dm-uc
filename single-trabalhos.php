<?php
	global $current_user;
	get_currentuserinfo();
?>
<?php get_header(); ?>

	<?php 
		$cover = get_field('imagem_principal',get_the_ID()); 
		$description = get_field('descrição',get_the_ID());
		$authors = get_field('autor',get_the_ID());
		$teachers = get_field('docente',get_the_ID());
		$course = get_field('cadeira',get_the_ID());
		$edition = get_field('edição',get_the_ID());
		$tags = get_field('etiquetas',get_the_ID());
	?>

    <!-- section -->
    <section>

		<?php if (have_posts()): while (have_posts()) : the_post(); ?>

			<!-- article -->
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<!-- post cover -->

				<?php if( !empty($cover) ): ?>
				 	
				 	<div id="cover" class="cover" data-img="<?php echo $cover['url']; ?>" style="background-image: url('<?php echo $cover['url']; ?>')"></div>

				<?php endif; ?>
				<!-- /post cover -->

				<!-- overlay cover -->
				<div class="cover-overlay">

					<div class="container">

						<div class="row">

							<!-- work title -->
							<div class="title-container">
								<div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
									<h1 class="title"><?php the_title(); ?></h1>
									<span class="dash">_</span>
								</div>
							</div>
							<!-- /work title -->

						</div>

					</div>					

				</div>
				<!-- /overlay cover -->

				<div class="container">

					<div class="row">

						<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

							<!-- work description -->
							<?php if( !empty($description) ): ?>
							 	
							 	<div class="work-description">
							 		<?php echo $description; ?>
							 	</div>

							<?php endif; ?>
							<!-- /work description -->

							<!-- work extra fields -->
							<div class="work-extra-fields">
								<?php 
									if( have_rows('blocos') ):
									 
									    while ( have_rows('blocos') ) : the_row(); ?>

											<div class="field">
									 	
									        <?php
									        if( get_row_layout() == 'sub-titulo' )
									        {
									 
									        	echo "<h2>" . get_sub_field('sub-titulo') . "<br>_</h2>";
									        }
									        elseif( get_row_layout() == 'texto' )
									        {
									        	the_sub_field('texto');
									        }
									        elseif( get_row_layout() == 'citação' )
									        {
									        	echo "<blockquote>" . get_sub_field('citação') . "</blockquote>";
									        }
											elseif( get_row_layout() == 'imagem' )
											{
												// echo "<a rel='lightbox' href='" . get_sub_field('imagem') . "' />";
									        	echo "<img src='" . get_sub_field('imagem') . "' />";
									        	// echo "</a>";
									        }
									        elseif( get_row_layout() == 'Galeria' )
											{
									        	$images = get_sub_field('imagens');
									        	$layout = get_sub_field('disposição');

									        	if ($layout == '2 a 2') {
									        		$classes = "col-xs-12 col-sm-6";
									        	}
									        	elseif ($layout == '3 a 3') {
									        		$classes = "col-xs-12 col-sm-4";
									        	} elseif ($layout == '4 a 4') {
									        		$classes = "col-xs-12 col-sm-3";
									        	}
									        ?>
												
									        	<div class="row">
													<ul class="list-unstyled">
													    <?php foreach( $images as $image ): ?>
													        <li class="<?php echo $classes?>">
													        	<a rel="lightbox" href="<?php echo $image['url']; ?>">
													        		 <img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" />
													        	</a>
													            <p><?php echo $image['caption']; ?></p>
													        </li>
													    <?php endforeach; ?>
													</ul>
									        	</div>

									        <?php
									    	}
									        elseif( get_row_layout() == 'video' )
											{
												echo get_sub_field('video_ou_audio');
									        } ?>

									    	</div>
									 
									    <?php endwhile;
									 
									endif;
								?>
							</div>
							<!-- /work extra fields -->

							<!-- work details -->
							<div class="work-details">

								<div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2">
									<?php 
									if (sizeof($authors) == 1)
									{
										echo '<h3 class="title">Autor</h3>';
									} 
									else
									{
										echo '<h3 class="title">Autores</h3>';
									}
									?>
									<ul class="list-unstyled">
										<?php 
										foreach ($authors as $author)
										{
										    echo "<li><a href='" . home_url() . "/aluno/" . $author["user_nicename"] . "'>" . $author["user_firstname"] . " " . $author["user_lastname"] . "</a></li>";
										}
										?>
									</ul>
								</div>

								<div class="col-xs-12 col-sm-5 col-md-4">
									<h3 class="title">Cadeira</h3>
									<?php
										echo "<p><a href=" . get_permalink( $course ) . ">" . get_the_title( $course ) . "</a></p>";
									?>
								</div>

								<div class="clearfix"></div>

								<div class="col-xs-12 col-sm-5 col-sm-offset-1 col-md-4 col-md-offset-2">
									<?php 
									if (sizeof($teachers) == 1)
									{
										echo '<h3 class="title">Docente</h3>';
									} 
									else
									{
										echo '<h3 class="title">Docentes</h3>';
									}
									?>
									<ul class="list-unstyled">
										<?php 
										foreach ($teachers as $teacher)
										{
											if ( get_field('docente_visivel', 'user_' . $teacher["ID"] ) !== false ) {
												echo "<li><a href='" . home_url() . "/docente/" . $teacher["user_nicename"] . "'>" . $teacher["user_firstname"] . " " . $teacher["user_lastname"] . "</a></li>";
											} else {
										    	echo "<li>" . $teacher["user_firstname"] . " " . $teacher["user_lastname"] . "</li>";
										    }
										}
										?>
									</ul>
								</div>

								<div class="col-xs-12 col-sm-5 col-md-4">
									<h3 class="title">Edição</h3>
									<?php
										echo "<p>" . $edition . "</p>";
									?>
								</div>

								<div class="clearfix"></div>

								<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
									<ul id="categories" class="list-inline">
									<?php 
									foreach ($tags as $tag)
									{
										$tag = get_term_by('id',$tag,'tags');
									    echo "<li><i class='icon dm-" . tag_class( $tag->name ) . "' data-toggle='tooltip' data-placement='bottom' title='" . $tag->name . "'></i></li>";
									}
									?>
									</ul>
								</div>

								<div class="clearfix"></div>

							</div>
							<!-- /work details -->

							<hr>

							<ul id="work-extra-details" class="list-unstyled">
								<li><?php echo getPostLikeLink( get_the_ID() ); ?></li>
								<li class="visualizations"><?php echo echo_post_views(get_the_ID()); ?> visualizações</li>
							</ul>

							<hr>

						</div>

					</div>

				</div>

			</article>
			<!-- /article -->

			<div class="container">

				<div class="row">

					<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

						<div class="row">

							<div id="related-work">
														
								<?php
									$args = array(
										'post__not_in' => array(get_the_ID()),
										'post_type' => 'trabalhos',
										'post_status' => 'publish',
								        'orderby' => 'rand',
								        'posts_per_page' => '6'
									);
									$query = new WP_Query( $args ); 
								?>
								<?php if ($query->have_posts()): while ($query->have_posts()) : $query->the_post(); ?>
										
									<?php get_template_part('inc/post-type-work-related'); ?>

								<?php endwhile; ?>

								<?php endif; ?>

								<?php wp_reset_query(); ?>

							</div>

						</div>

					</div>

				</div>

			</div>

		<?php endwhile; ?>

		<?php else: ?>

			<!-- article -->
			<article>

				<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>

			</article>
			<!-- /article -->

		<?php endif; ?>


	</section>
	<!-- /section -->

<?php get_footer(); ?>
