<?php
	$classes = array(
		'col-xs-12',
		'col-sm-6',
		'col-md-4'
	);

	if(!empty(get_field('miniatura',$work))) {
		$cover = get_field('miniatura',$work); 
	} else {
		$cover = get_field('imagem_principal',$work); 
	}
	$course = get_field('cadeira',$work);
	$tags = get_field('etiquetas',$work);
	$authors = get_field('autor',$work);
?>

<!-- article -->
<article id="post-<?php echo $work; ?>" class="<?php echo implode(' ',get_post_class($classes, $work)); ?>">

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
			<h2 class="title"><a href="<?php echo get_the_permalink($work); ?>" title="<?php echo get_the_title($work); ?>"><?php echo get_the_title($work); ?></a></h2>
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

	<!-- post edit-->
	<div class="extra">
		<ul class="list-unstyled">
			<li>
				<?php $nonce = wp_create_nonce('dm_approve_work_nonce') ?>
				<a class="md-trigger" data-modal="modal-aw" data-id="<?php echo $work ?>" data-nonce="<?php echo $nonce ?>"><i class="icon dm-aprovar dm-2x"></i></a>
			</li>
			<li>
				<?php $nonce_r = wp_create_nonce('dm_reject_work_nonce') ?>
				<a class="md-trigger" data-modal="modal-dw" data-id="<?php echo $work ?>" data-nonce="<?php echo $nonce_r ?>"><i class="icon dm-apagar dm-2x"></i></a>
			</li>
		</ul>
	</div>
	<!-- /post edit-->
	
</article>
<!-- /article -->