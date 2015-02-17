<?php
	$classes = array(
		'col-xs-12',
		'col-sm-6',
		'col-md-4'
	);

	$cover = get_field('imagem_principal',get_the_ID()); 
?>

<!-- article -->
<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<!-- post item-->
	<div class="item post">

		<!-- post thumbnail -->
<!-- 		<div class="background" data-isrc="<?php echo $cover['url']; ?>" style="background-image: url('<?php echo $cover['url']; ?>');"></div> -->
		<!-- /post thumbnail -->
		
		<div class="info">

			<!-- post details -->
			<span class="details"><?php echo get_the_time('y F Y'); ?></span>
			<!-- /post details -->

			<!-- post title -->
			<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<!-- /post title -->

		</div>

	</div>
	<!-- /post item-->

	<!-- post edit-->
	<div class="extra">
		<ul class="list-unstyled">
			<li>
				<a href="./editar?artigo=<?php the_ID(); ?>"><i class="icon dm-editar" data-toggle="tooltip" data-placement="right" title="Editar"></i></a>
			</li>
			<li>
				<?php $nonce = wp_create_nonce('dm_remove_post_nonce') ?>
				<a class="md-trigger" data-modal="modal-rp" data-id="<?php the_ID() ?>" data-nonce="<?php echo $nonce ?>"><i class="icon dm-apagar" data-toggle="tooltip" data-placement="right" title="Apagar"></i></a>
			</li>
		</ul>
	</div>
	<!-- /post edit-->
	
</article>
<!-- /article -->