<?php 
	acf_form_head();
	get_header();
?>

	<?php
		$avatar = get_field('avatar', 'user_' . $author->id);
		$facebook = get_field('facebook', 'user_' . $author->id);
		$twitter = get_field('twitter', 'user_' . $author->id);
		$linkedin = get_field('linkedin', 'user_' . $author->id);
		$pinterest = get_field('pinterest', 'user_' . $author->id);
		$dribbble = get_field('dribbble', 'user_' . $author->id);
		$behance = get_field('behance', 'user_' . $author->id);
		$vimeo = get_field('vimeo', 'user_' . $author->id);
		$description = get_field('Descrição', 'user_' . $author->id);
		$class = 'avatar';
		$class_form = '';
		$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		if ($author->ID == get_current_user_id()) {
			$class = 'avatar self-profile';
			$class_form = 'self-profile';
		}
	?>

	<!-- section -->
    <section class="container">
        
        <div class="row">

			<div id="user">
	        	<div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">

					<!-- author avatar -->
					<div class="<?php echo $class; ?>">
						<div class="fake-mask">
							<?php if (!empty($avatar)) { ?>
								<img src="<?php echo $avatar['sizes']['avatar']; ?>" />
							<?php } else { ?>
								<img src="<?php echo get_template_directory_uri(); ?>/img/avatar.png" alt="Logo" class="logo-img">;
							<?php } ?>
						</div>
					</div>
					<!-- /author avatar -->
					
					<div class="hidden-xs">
						<?php if (strlen($description) > 50) { ?>

							<div class="clearfix divider"></div>


			        		<!-- author description -->
							<div class="description">
								<?php echo $description; ?>
							</div>
							<!-- /author description -->

						<?php } ?>

			        	<div class="clearfix divider divider-works"></div>

						<div class="row">
							<?php 	

								if (false == strpos($url,'docente')) {
									include(locate_template('loop-user-profile-work.php')); 
			                	}

			                ?>
						</div>
					</div>

	        	</div>

	        	<div class="col-xs-12 col-sm-4 col-sm-offset-1">
					
					<!-- author name -->
					<h1 class="caption"><span class="first-name"><?php echo $author->first_name; ?></span><br><span class="last-name"><?php echo $author->last_name; ?></span><br>_</h1>
					<!-- /author name -->

					<!-- author details -->
	        		<div class="details">

	                	<?php
	                		$is_teacher = check_user_role(array('subscriber','contributor', 'teacher_author'), $author->user_login);
	                		$courses = get_field('cadeiras', 'user_' . $author->id);
	                		if ($is_teacher && false != strpos($url,'docente') && !empty($courses)) {
	                			echo '<div class="detail docencia">';
	                			echo '<h6>Docência</h6>';
	                			echo '<ul class="list-unstyled">';
	                			foreach ($courses as $course) {
	                				echo '<li><a href="' . home_url() . '/cadeiras/' . $course->post_name . '">' . $course->post_title . '</a></li>';
	                			}
	                			echo '</ul>';
	                			echo '</div>';
	                		}
	                	?>
				
	        			<?php if (!empty($author->user_url)) { ?>
		        			<!-- author url -->
		        			<div class="detail website">
		        				<h6>Website</h6>
								<?php echo "<a href='" . $author->user_url . "' target= '_blank'>" . $author->user_url . "</a>"; ?>
							</div>
							<!-- /author url -->
						<?php } ?>
						
						<?php if (!empty($author->user_email)) { ?>
							<!-- author e-mail -->
							<div class="detail email">
								<h6>E-mail</h6>
								<?php echo "<a href='mailto:" . $author->user_email . "?Subject=Contacto%20via%20site%20D+M'>" . $author->user_email . "</a>"; ?>
							</div>
							<!-- /author e-mail -->
						<?php } ?>
						
						<!-- author social -->
						<div class="detail social">
						<?php 
							if (!empty($facebook) || !empty($twitter) || !empty($linkedin) || !empty($pinterest) || !empty($dribbble) || !empty($behance) || !empty($vimeo))
								echo '<h6>Redes Sociais</h6>';
						?>
						<ul class="list-inline">
							<?php 
								if (!empty($facebook))
									echo '<li data-toggle="tooltip" data-placement="bottom" title="facebook"><a href="http://facebook.com/' . $facebook . '" target="_blank"><i class="fa fa-facebook"></i></a></li>';
								if (!empty($twitter))
									echo '<li data-toggle="tooltip" data-placement="bottom" title="twitter"><a href="http://twitter.com/' . $twitter . '" target="_blank"><i class="fa fa-twitter"></i></a></li>';
								if (!empty($linkedin))
									echo '<li data-toggle="tooltip" data-placement="bottom" title="linkedin"><a href="http://linkedin.com/' . $facebook . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
								if (!empty($dribbble))
									echo '<li data-toggle="tooltip" data-placement="bottom" title="dribbble"><a href="http://dribbble.com/' . $dribbble . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>';
								if (!empty($behance))
									echo '<li data-toggle="tooltip" data-placement="bottom" title="behance"><a href="http://behance.com/' . $behance . '" target="_blank"><i class="fa fa-behance"></i></a></li>';
								if (!empty($vimeo))
									echo '<li data-toggle="tooltip" data-placement="bottom" title="vimeo"><a href="http://vimeo.com/' . $vimeo . '" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>';
								if (!empty($pinterest))
									echo '<li data-toggle="tooltip" data-placement="bottom" title="pinterest"><a href="http://pinterest.com/' . $pinterest . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>';
							 ?>
						</ul>			
						</div>
						<!-- /author social -->

					</div>
					<!-- /author details -->

				</div>

	        </div>
			
			<?php if ($author->ID == get_current_user_id()): ?>

				<div id="user-edit">
		        	<form method="post" id="user-update-form" action="<?php the_permalink(); ?>" class="<?php echo $class_form;?>">

		                <div id="user-edit-avatar" class="col-sm-6 col-md-5 col-md-offset-1">
		                    <?php acf_form(array(
		                        'post_id' => 'user_' . $author->ID,
		                        'field_groups' => array(92),
		                        'instruction_placement' => 'field',
		                        'form' => false
		                    )); ?>
		                    <div id="user-edit-description">
		                    	<?php acf_form(array(
		                            'post_id' => 'user_' . $author->ID,
		                            'field_groups' => array(482),
		                            'form' => false
		                        )); ?>
		                    </div>
		                </div>

		                <div class="col-xs-12 col-sm-4 col-sm-offset-1">
		                    <input class="text-input" name="first-name" type="text" id="first-name" value="<?php the_author_meta( 'first_name', $author->ID ); ?>" placeholder="John" autocomplete="off" />
		                    <input class="text-input" name="last-name" type="text" id="last-name" value="<?php the_author_meta( 'last_name', $author->ID ); ?>" placeholder="Doe" autocomplete="off" />
		                    <span id="name-dash">_</span>
		                	<?php 
		                		$is_teacher = check_user_role(array('subscriber','contributor', 'teacher_author'), $author->user_login);
		                		if ($is_teacher) {
		                			echo '<label class="form-title">Docência</label>';
				                    acf_form(array(
				                        'post_id' => 'user_' . $author->ID,
				                        'field_groups' => array(409),
				                        'instruction_placement' => 'field',
				                        'form' => false
				                    ));	                			
		                		}
		                	?>
		                    <label class="form-title">Website</label>
		                    <input class="text-input" name="url" type="text" id="url" value="<?php the_author_meta( 'user_url', $author->ID ); ?>" placeholder="www.johndoe.com" />
		                    <label class="form-title">E-Mail</label>
		                    <input class="text-input" name="email" type="text" id="email" value="<?php the_author_meta( 'user_email', $author->ID ); ?>" placeholder="johndoe@email.com" />
		                    <label class="form-title">Redes Sociais</label>
		                    <div class="social">
		                        <?php acf_form(array(
		                            'post_id' => 'user_' . $author->ID,
		                            'field_groups' => array(102),
		                            'form' => false
		                        )); ?>
		                    </div>
		                </div>

		            </form>
		        </div>

		    <?php endif; ?>

		    <div class="visible-xs">
		    	<div class="col-xs-12 col-sm-6 col-md-5 col-md-offset-1">
					<?php if (strlen($description) > 50) { ?>

						<div class="clearfix divider"></div>


		        		<!-- author description -->
						<div class="user-description">
							<?php echo $description; ?>
						</div>
						<!-- /author description -->

					<?php } ?>

		        	<div class="clearfix divider divider-works"></div>

					<div class="row">
						<?php 	

							if (false == strpos($url,'docente')) {
								include(locate_template('loop-user-profile-work.php')); 
		                	}

		                ?>
					</div>
				</div>
		    </div>

		</div>
		
	</main>
	<!-- /section -->

<?php get_footer(); ?>
