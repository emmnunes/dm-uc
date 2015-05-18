<?php get_header(); ?>
	<section class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-6 col-md-offset-6">
				<h1 class="caption" style="font-size: 30px !important;">Os cursos de Design e Multimédia da Universidade de Coimbra oferecem formação sólida em design de serviços e produtos digitais.<br>_</h1>
			</div>
			<div class="clearfix"></div>
			<div id="items" role="main">
				<?php get_template_part('loop'); ?>
			</div>
			<div class="clearfix"></div>
			<div class="col-xs-12">
				<button id="load-more" data-pages="">
					<span class="load">Carregar Mais</span>
					<span class="loading"><span class="one">.</span><span class="two">.</span><span class="three">.</span></span>
				</button>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
