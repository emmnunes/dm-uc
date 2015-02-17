<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        // home_url()
        var homeUrl = '<?php echo home_url(); ?>';
        var current_user = '<?php echo get_current_user_id(); ?>';
        </script>

        <script type="text/javascript" src="//use.typekit.net/acc0azf.js"></script>
		<script type="text/javascript">try{Typekit.load();}catch(e){}</script>

	</head>
	<body <?php body_class(); ?>>

		<?php 

		if ( is_author() ) {

			global $author, $author_role;

			if(isset($_GET['author_name'])) :
				$author = get_userdatabylogin($author_name);
			else :
				$author = get_userdata(intval($author));
			endif;

			$capabilities = $author->{$wpdb->prefix . 'capabilities'};

			if ( !isset( $wp_roles ) )
				$wp_roles = new WP_Roles();

			foreach ( $wp_roles->role_names as $role => $name ) :

				if ( array_key_exists( $role, $capabilities ) )
					$author_role = $role;

			endforeach;

            echo '<script>var current_author=' . $author->ID . ';</script>';

			$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

			if (false != strpos($url,'aluno') && ($author_role != 'author' && $author_role != 'teacher_author') || false != strpos($url,'docente') && ($author_role != 'subscriber' && $author_role != 'contributor' && $author_role != 'teacher_author')) {
				wp_redirect(home_url());
		        exit;
			}

		} 

		if ( is_page('login') || is_page('recuperar') || is_page('registar') ) {
		    if ( is_user_logged_in() ) {

		    	global $current_user;
      			get_currentuserinfo();

		    	$is_admin = check_user_role(array('administrator'));
	            $is_student = check_user_role(array('author'));
	            $is_teacher = check_user_role(array('subscriber','contributor','teacher_author'));

	            if ($is_student) {
	                $link = home_url() . '/aluno/' . $current_user->user_nicename;
	            } else if ($is_teacher) {
	                $link = home_url() . '/docente/' . $current_user->user_nicename;
	            } else if ($is_admin) {
	            	$link = home_url() . '/wp-admin';
	            } else {
	                $link = home_url() . '/conta/artigos';
	            }

		        wp_redirect($link);
		        exit;
		    }
		}

        /* Permissões para editar trabalho */
        if ( is_page('141') ) {
            if ($_GET['trabalho'] != '') {
                $authors = get_post_meta( $_GET['trabalho'], 'autor', 'true' );
                $teachers = get_post_meta( $_GET['trabalho'], 'docente', 'true' );
                $is_admin = check_user_role(array('administrator'));
                if (!$is_admin && !in_array(get_current_user_id(), $authors) && !in_array(get_current_user_id(), $teachers)) {
                    wp_redirect(home_url() . "/conta/portfolio");
                    exit;   
                }
            } else {
                wp_redirect(home_url() . "/conta/portfolio");
                exit;
            }
        }

        /* Permissões para visualizar o trabalho */
        if( is_single() && get_post_type() == 'trabalhos' && get_post_status() == 'draft' ) {
            $authors = get_post_meta( get_the_ID(), 'autor', 'true' );
            $teachers = get_post_meta( get_the_ID(), 'docente', 'true' );
            $is_admin = check_user_role(array('administrator'));
            if ( !$is_admin && !in_array(get_current_user_id(), $authors) && !in_array(get_current_user_id(), $teachers)) {
                wp_redirect(home_url() . "/conta/portfolio");
                exit;   
            }
        }

        /* Permissões para editar artigo */
        if ( is_page('377') ) {
            $is_teacher = check_user_role(array('subscriber', 'teacher_author'));
            $is_admin = check_user_role(array('administrator','contributor'));
            if ($_GET['artigo'] != '') {
                $post = get_post( $_GET['artigo'] );
                if ( get_current_user_id() != $post->post_author || $is_admin ) {
                    wp_redirect(home_url() . "/conta/artigos");
                    exit; 
                }
            } else {
                wp_redirect(home_url() . "/conta/artigos");
                exit;
            }
        }

        ?>

		<header id="header" class="trans" role="header">
			<?php if ( !is_page( 'login' ) && !is_page( 'recuperar' ) && !is_page( 'registar' ) && !is_404() ): ?>


				<div id="navToggle">
					<i class='icon dm-menu'></i>
					<i class='icon dm-fechar'></i>
				</div>

				<div id="logo">
					<a href="<?php echo home_url() ?>">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo" class="logo-img">
					</a>
				</div>

				<div id="searchToggle">
					<i class='icon dm-procurar'></i>
					<i class='icon dm-voltar-esquerda'></i>
				</div>

				<?php 
                    if ( is_author() ) {
                        if ($author->ID == get_current_user_id()) {
                            echo '<button id="editToggle">Editar</button>';
                            wp_nonce_field( 'update-user' );
                            echo '<button id="update-user"><span class="load">Guardar</span><span class="loading"><span class="one">.</span><span class="two">.</span><span class="three">.</span></span></button>';
                        }
                    } 
                ?>
				<?php if ( is_page( '123' ) ||  is_page( '141' ) ) : ?>
                    <button id="photo-edit"><span class="hidden-xs">Editar Foto de Capa</span><span class="visible-xs"><i class="fa fa-file-image-o fa-2x"></i></span></button>
                    <button id="photo-edit-exit">Editar Título</button>
                <?php endif; ?>

			<?php endif; ?>

		</header>

		<div id="wrapper">
		
			<!-- page navigation -->
			<div id="navigation-wrapper" class="trans pane left">
				<?php 
					html5blank_main_nav();
					if ( is_user_logged_in() ) { // add is_admin() to hide menu for admin
						echo '<hr>';
						html5blank_user_nav();
					} else {
						echo '<ul class="list-unstyled sub-navigation">';
						echo '<li><a href="' . home_url() . '/login">Login</a></li>';
						echo '<li><a href="' . home_url() . '/registar">Registar</a></li>';
						echo '</ul>';
					}
				?>
				<div id="logo-uc">
					<a href="http://www.uc.pt" target="_blank">
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo-uc.svg" alt="Logo" class="logo-img">
					</a>
				</div>
			</div>
			<!-- page navigation -->

			<!-- page wrapper -->
			<div id="content-wrapper" class="wrapper trans">

				<main id="content" role="main">     