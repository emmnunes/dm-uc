<?php
	$classes = array(
		'col-xs-12'
	);

	if(!empty(get_field('miniatura',get_the_ID()))) {
		$cover = get_field('miniatura',get_the_ID()); 
	} else {
		$cover = get_field('imagem_principal',get_the_ID()); 
	}
	$course = get_field('cadeira',get_the_ID());
	$tags = get_field('etiquetas',get_the_ID());
	$authors = get_field('autor',get_the_ID());
?>

<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<!-- post item-->
	<div class="item">

		<!-- post thumbnail -->
		<div class="background" data-isrc="<?php echo $cover['url']; ?>" style="background-image: url('<?php echo $cover['sizes']['large']; ?>');"></div>
		<!-- /post thumbnail -->
		
		<div class="info">

			<!-- post details -->
			<span class="details"><?php echo '<a href="' . get_the_permalink( $course ) . '">' . get_the_title( $course ) . '</a>'; ?></span>
			<!-- /post details -->

			<!-- post title -->
			<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<!-- /post title -->

			<!-- post authors -->
			<span class="authors">
				<?php if (!empty($authors)){ ?>
					<ul class="list-unstyled">
						<?php 
						foreach ($authors as $author)
						{
						    echo "<li><a href='" . home_url() . "/aluno/" . $author["user_nicename"] . "'>" . $author["user_firstname"] . " " . $author["user_lastname"] . "</a></li>";
						}
						?>
					</ul>
				<?php } ?>
			</span>
			<!-- /post authors -->
			
		</div>

	</div>
	<!-- /post item-->
	
	<!-- post tag -->
	<?php $tag = get_term_by('id',$tags[0],'tags'); ?>
	<div class="tag" data-toggle="tooltip" data-placement="right" title="<?php echo $tag->name ?>">
		<?php 
			echo "<i class='icon dm-" . tag_class( $tag->name ) . "'></i>";
		?>		
	</div>
	<!-- /post tag -->
	
</article>
<!-- /article -->