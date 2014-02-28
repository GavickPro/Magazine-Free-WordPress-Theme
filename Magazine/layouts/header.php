<?php 
	
	/**
	 *
	 * Template header
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;

?>
<?php do_action('gavernwp_doctype'); ?>
<html <?php do_action('gavernwp_html_attributes'); ?>>
<head>
	<title><?php do_action('gavernwp_title'); ?></title>
	<?php do_action('gavernwp_metatags'); ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
	wp_enqueue_style('gavern-normalize', gavern_file_uri('css/normalize.css'), false);
	wp_enqueue_style('gavern-template', gavern_file_uri('css/template.css'), array('gavern-normalize'));
	wp_enqueue_style('gavern-wp', gavern_file_uri('css/wp.css'), array('gavern-template'));
	wp_enqueue_style('gavern-stuff', gavern_file_uri('css/stuff.css'), array('gavern-wp'));
	wp_enqueue_style('gavern-wpextensions', gavern_file_uri('css/wp.extensions.css'), array('gavern-stuff'));
	wp_enqueue_style('gavern-extensions', gavern_file_uri('css/extensions.css'), array('gavern-wpextensions'));
	?>
	<!--[if IE 9]>
	<link rel="stylesheet" href="<?php echo gavern_file_uri('css/ie9.css'); ?>" />
	<![endif]-->
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo gavern_file_uri('css/ie8.css'); ?>" />
	<![endif]-->
	
	<?php if(is_singular() && get_option('thread_comments' )) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php do_action('gavernwp_ie_scripts'); ?>
	
	<?php gk_head_shortcodes(); ?>
		  
	<?php 
	 gk_load('responsive_css'); 
	 
	 if(get_option($tpl->name . "_overridecss_state", 'Y') == 'Y') {
	   wp_enqueue_style('gavern-override', gavern_file_uri('css/override.css'), array('gavern-style'));
	 }
	?>
	
	<?php
	if(get_option($tpl->name . '_prefixfree_state', 'N') == 'Y') {
	  wp_enqueue_script('gavern-prefixfree', gavern_file_uri('js/prefixfree.js'));
	} 
	?>
	
	<?php gk_head_style_css(); ?>
	<?php gk_head_style_pages(); ?>	
	
	<?php gk_thickbox_load(); ?>
	<?php wp_head(); ?>
	
	<?php do_action('gavernwp_fonts'); ?>
	<?php gk_head_config(); ?>
	<?php wp_enqueue_script("jquery"); ?>
	
	<?php
	    wp_enqueue_script('gavern-scripts', gavern_file_uri('js/gk.scripts.js'), array('jquery'), false, true);
	    wp_enqueue_script('gavern-menu', gavern_file_uri('js/gk.menu.js'), array('jquery', 'gavern-scripts'), false, true);
	?>
	
	<?php do_action('gavernwp_head'); ?>
	
	<?php 
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($tpl->name . '_head_code', ''))
			)
		); 
	?>
</head>
<body <?php do_action('gavernwp_body_attributes'); ?>>
	<header id="gk-head">
		<div class="gk-page">
			<?php if(get_option($tpl->name . "_branding_logo_type", 'css') != 'none') : ?>
			<h1>
				<a href="<?php echo home_url(); ?>" class="<?php echo get_option($tpl->name . "_branding_logo_type", 'css'); ?>Logo"><?php gk_blog_logo(); ?></a>
			</h1>
			<?php endif; ?>
			
			<?php if(gk_is_active_sidebar('bannertop')) : ?>
			<div id="gk-banner-top">
				<?php gk_dynamic_sidebar('bannertop'); ?>
			</div>
			<?php endif; ?>
			
			<?php if((!is_user_logged_in() && get_option($tpl->name . '_reg_link', 'Y') == 'Y') || get_option($tpl->name . '_login_link', 'Y') == 'Y') : ?>
			<div id="gk-user-area">
				<?php if(get_option($tpl->name . '_login_link', 'Y') == 'Y') : ?>
				<a href="<?php echo get_option($tpl->name . '_login_url', 'wp-login.php?action=login'); ?>" <?php if(get_option($tpl->name . '_login_popup_state', 'Y') == 'Y') : ?>id="gk-login"<?php endif; ?>><?php (!is_user_logged_in()) ? _e('Login', GKTPLNAME) : _e('Logout', GKTPLNAME); ?><i class="gk-icon-arrow"></i></a>
				<?php endif; ?>
				
				<?php if(!is_user_logged_in() && get_option($tpl->name . '_reg_link', 'Y') == 'Y') : ?>
				<a href="<?php echo get_option($tpl->name . '_reg_url', '#'); ?>" id="gk-register"><?php _e('Register', GKTPLNAME); ?><i class="gk-icon-arrow"></i></a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</header>