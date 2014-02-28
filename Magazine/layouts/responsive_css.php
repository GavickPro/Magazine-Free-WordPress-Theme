<?php 
	
	/**
	 *
	 * Template part loading the responsive CSS code
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;
	global $fullwidth;
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
?>

<style type="text/css">
	.gk-page { max-width: <?php echo get_option($tpl->name . '_template_width', 1300); ?>px; }
	<?php if(
		get_option($tpl->name . '_inset_position', 'right') != 'none' && 
		(gk_is_active_sidebar('inset') || gk_show_menu('mainmenu'))
	) : ?>
	#gk-mainbody-columns > aside { width: <?php echo get_option($tpl->name . '_inset_width', '30'); ?>%;}
	#gk-mainbody-columns > section { width: <?php echo 100 - get_option($tpl->name . '_inset_width', '30'); ?>%; }
	<?php else : ?>
	#gk-mainbody-columns > section { width: 100%; }
	<?php endif; ?>
	
	<?php if(
		get_option($tpl->name . '_sidebar_position', 'right') != 'none' && 
		gk_is_active_sidebar('sidebar') && 
		($fullwidth != true)
	) : ?>
	#gk-sidebar { width: <?php echo get_option($tpl->name . '_sidebar_width', '30'); ?>%;}
	#gk-content-wrap { width: <?php echo 100 - get_option($tpl->name . '_sidebar_width', '30'); ?>%; }
	<?php else : ?>
	#gk-content-wrap { width: 100%; }
	<?php endif; ?>
</style>

<?php
// check the dependencies for the desktop.small.css file
if(get_option($tpl->name . "_shortcodes3_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-template'), false, '(max-width: '. get_option($tpl->name . '_theme_width', '1230') . 'px)');
} elseif(get_option($tpl->name . "_shortcodes2_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-elements'), false, '(max-width: '. get_option($tpl->name . '_theme_width', '1230') . 'px)');
} elseif(get_option($tpl->name . "_shortcodes1_state", 'Y') == 'Y') {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-shortcodes-typography'), false, '(max-width: '. get_option($tpl->name . '_theme_width', '1230') . 'px)');
} else {
     wp_enqueue_style('gavern-desktop-small', gavern_file_uri('css/desktop.small.css'), array('gavern-extensions'), false, '(max-width: '. get_option($tpl->name . '__theme_width', '1230') . 'px)');
}

// tablet.css is always loaded after the desktop.small.css file
wp_enqueue_style('gavern-tablet', gavern_file_uri('css/tablet.css'), array('gavern-extensions'), false, '(max-width: '. get_option($tpl->name . '_tablet_width', '900') . 'px)');

// tablet.small.css is always loaded after the tablet.css file
wp_enqueue_style('gavern-tablet-small', gavern_file_uri('css/tablet.small.css'), array('gavern-tablet'), false, '(max-width: '. get_option($tpl->name . '_small_tablet_width', '820') . 'px)');

// mobile.css is always loaded after the tablet.small.css file
wp_enqueue_style('gavern-mobile', gavern_file_uri('css/mobile.css'), array('gavern-tablet-small'), false, '(max-width: '. get_option($tpl->name . '_mobile_width', '580') . 'px)');

