<?php
/**
 * Template Name: Sobre
 *
 * Página sobre da plataforma.
 *
 */

get_header(); ?>



	<?php
		/* Sobre */
		$title = get_field('titulo',get_the_ID()); 
		$description = get_field('descrição',get_the_ID()); 

		/* Licenciatura */
		$title_degree = get_field('titulo_licenciatura',get_the_ID());
		$description_degree = get_field('descrição_licenciatura',get_the_ID());

		/* Licenciatura */
		$title_masters = get_field('titulo_mestrado',get_the_ID());
		$description_masters = get_field('descrição_mestrado',get_the_ID());

		function getCapitalLetters($str)

		{

		  if(preg_match_all('#([A-Z]+)#',$str,$matches))

		    return implode('',$matches[1]);

		  else

		    return false;

		}

	?>

    <!-- section -->
    <section class="container">

    	<div class="row">

			<div class="col-xs-12 col-md-4">
				<h1 class="caption"><?php echo $title; ?><br>_</h1>
			</div>

			<div class="col-xs-12 col-md-7 col-md-offset-1">
				<?php echo $description; ?>		
			</div>

			<div class="clearfix divider"></div>

	    	<div class="col-xs-12 col-md-4">
				<h1 class="caption"><?php echo $title_degree; ?><br>_</h1>
			</div>

			<div class="col-xs-12 col-md-7 col-md-offset-1">
				<?php echo $description_degree; ?>


				<table class="table-bordered table-striped table-condensed">

					<tbody>

					<?php
	 
					if( have_rows('plano_de_estudos_licenciatura') ):
					 
					    while ( have_rows('plano_de_estudos_licenciatura') ) : the_row();

					        echo '<tr>';
								echo '<td class="title">' . get_sub_field('ano') . 'º Ano</td>';
								echo '<td class="title">' . get_sub_field('semestre') . 'º Semestre</td>';
								$courses = get_sub_field('cadeiras');
								echo '<td>';
								echo '<ul class="list-unstyled">';
									foreach ($courses as $course) {
										$area = getCapitalLetters(get_field('área_científica',$course->ID));
										$ects = get_field('creditos_ects',$course->ID);
										if ($area == 'S')
											$area = 'SE';
										elseif ($area == 'APM')
											$area = 'AVPM';
										echo '<li><a href=' . home_url() . '/cadeiras/' . $course->post_name . '>' . $course->post_title . '</a><br><span>Área: ' . $area . ' ECTS: ' . $ects . '</span></li>';
									}
								echo '</ul>';
								echo '</td>';
							echo '</tr>';
					 
					    endwhile;
					 
					endif;
					 
					?>	

					</tbody>
				</table>

			</div>

			<div class="clearfix divider"></div>

	    	<div class="col-xs-12 col-md-4">
				<h1 class="caption"><?php echo $title_masters; ?><br>_</h1>
			</div>

			<div class="col-xs-12 col-md-7 col-md-offset-1">
				<?php echo $description_masters; ?>

				<table class="table-bordered table-striped table-condensed">
					<tbody>

					<?php
	 
					if( have_rows('plano_de_estudos_mestrado') ):
					 
					    while ( have_rows('plano_de_estudos_mestrado') ) : the_row();

					        echo '<tr>';
								echo '<td class="title">' . get_sub_field('ano') . 'º Ano</td>';
								echo '<td class="title">' . get_sub_field('semestre') . 'º Semestre</td>';
								$courses = get_sub_field('cadeiras');
								echo '<td>';
								echo '<ul class="list-unstyled">';
									foreach ($courses as $course) {
										$area = getCapitalLetters(get_field('área_científica',$course->ID));
										$ects = get_field('creditos_ects',$course->ID);

										if ($area == 'S')
											$area = 'SE';
										elseif ($area == 'APM')
											$area = 'AVPM';

										if (get_sub_field('ano') == '2' && get_sub_field('semestre') == '1' && $course->post_title == 'Estágio/Dissertação')
											$ects = $ects/3.5;
										elseif (get_sub_field('ano') == '2' && get_sub_field('semestre') == '2' && $course->post_title == 'Estágio/Dissertação')
											$ects = $ects/1.4;

										echo '<li><a href=' . home_url() . '/cadeiras/' . $course->post_name . '>' . $course->post_title . '</a><br><span>Área: ' . $area . ' ECTS: ' . $ects . '</span></li>';
									}

									if ( get_sub_field('ano') == 1 && get_sub_field('semestre') == 1) {
										echo '<li><i>+10 ECTS de optativas <a href="#OPA0">OPA0</a> ou <a href="#OPA1">OPA1</a></i></li>';
									} elseif ( get_sub_field('ano') == 1 && get_sub_field('semestre') == 2) { 
										echo '<li><i>+4 ECTS de optativas <a href="#OPA2">OPA2</a></i></li>';
									} elseif ( get_sub_field('ano') == 2 && get_sub_field('semestre') == 1) { 
										echo '<li><i>+4 ECTS de optativas <a href="#OPA0">OPA0</a></i></li>';
									}

								echo '</ul>';
								echo '</td>';
							echo '</tr>';
					 
					    endwhile;
					 
					endif;
					 
					?>	

					</tbody>
				</table>

				<table id="optional" class="table-bordered table-striped table-condensed">

					<tbody>

					<?php
	 
					if( have_rows('optativas') ):
					 
					    while ( have_rows('optativas') ) : the_row();

					        echo '<tr id="' . get_sub_field('titulo') . '">';
								echo '<td class="title">' . get_sub_field('titulo') . '</td>';
								$courses = get_sub_field('cadeiras');
								echo '<td>';
								echo '<ul class="list-unstyled">';
									foreach ($courses as $course) {
										$area = getCapitalLetters(get_field('área_científica',$course->ID));
										$ects = get_field('creditos_ects',$course->ID);
										if ($area == 'S')
											$area = 'SE';
										elseif ($area == 'APM')
											$area = 'AVPM';
										echo '<li><a href=' . home_url() . '/cadeiras/' . $course->post_name . '>' . $course->post_title . '</a><br><span>Área: ' . $area . ' ECTS: ' . $ects . '</span></li>';
									}

									if ( get_sub_field('ano') == 1 && get_sub_field('semestre') == 1) {
										echo '<li><i>+10 ECTS de optativas OPA0 ou OPA1</i></li>';
									} elseif ( get_sub_field('ano') == 1 && get_sub_field('semestre') == 2) { 
										echo '<li><i>+4 ECTS de optativas OPA2</i></li>';
									} elseif ( get_sub_field('ano') == 2 && get_sub_field('semestre') == 1) { 
										echo '<li><i>+4 ECTS de optativas OPA0</i></li>';
									}

								echo '</ul>';
								echo '</td>';
							echo '</tr>';
					 
					    endwhile;
					 
					endif;
					 
					?>	

					</tbody>
				</table>


			</div>

		</div>

	</section>
	<!-- /section -->

<?php get_footer(); ?>
