<?php 
	
	/**
	 *
	 * Template elements before the page content
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
	// check if the sidebar is set to be a left column
	$args_val = $args == null || ($args != null && $args['sidebar'] == true);
	
	$gk_mainbody_class = '';
	
	if(get_option($tpl->name . '_sidebar_position', 'right') == 'left' && gk_is_active_sidebar('sidebar') && $args_val) {
		$gk_mainbody_class .= ' gk-sidebar-left';
	}
	
	if(get_option($tpl->name . '_inset_position', 'right') == 'left' && (gk_is_active_sidebar('inset') || gk_show_menu('mainmenu'))) {
		$gk_mainbody_class .= ' gk-inset-left';
	}
	
	if($gk_mainbody_class != '') {
		$gk_mainbody_class = ' class="'.$gk_mainbody_class.'" ';
	}
?>

<div class="gk-page-wrap gk-page">
	<div id="gk-mainbody-columns"<?php echo $gk_mainbody_class; ?>>			
		<section>
			<div id="gk-content-wrap">
				<?php if(gk_is_active_sidebar('top1')) : ?>
				<div id="gk-top1">
					<div class="widget-area">
						<?php gk_dynamic_sidebar('top1'); ?>
					</div>
					<!--[if IE 8]>
					<div class="ie8clear"></div>
					<![endif]-->
				</div>
				<?php endif; ?>
				
				<?php if(gk_is_active_sidebar('top2')) : ?>
				<div id="gk-top2">
					<div class="widget-area">
						<?php gk_dynamic_sidebar('top2'); ?>
					</div>
					<!--[if IE 8]>
					<div class="ie8clear"></div>
					<![endif]-->
				</div>
				<?php endif; ?>
				
				<!-- Mainbody, breadcrumbs -->
				<?php if(gk_show_breadcrumbs()) : ?>
				<div id="gk-breadcrumb-area">
					<?php gk_breadcrumbs_output(); ?>
					<!--[if IE 8]>
					<div class="ie8clear"></div>
					<![endif]-->
				</div>
				<?php endif; ?>
				
				<?php if(gk_is_active_sidebar('mainbody_top')) : ?>
				<div id="gk-mainbody-top">
					<?php gk_dynamic_sidebar('mainbody_top'); ?>
				</div>
				<?php endif; ?>
			