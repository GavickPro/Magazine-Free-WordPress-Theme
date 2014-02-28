<?php 
	
	/**
	 *
	 * Template footer
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
?>

	<footer id="gk-footer" class="gk-page">			
		<div>
			<?php gavern_menu('footermenu', 'gk-footer-menu'); ?>
			
			<div class="gk-copyrights">
				Free <a href="http://www.gavick.com/wordpress-themes.html" title="WordPress Themes">WordPress Theme</a> designed by <a href="http://www.gavick.com">GavickPro</a>
			</div>
			
			<?php if(get_option($tpl->name . '_template_footer_logo', 'Y') == 'Y') : ?>
			<img src="<?php echo gavern_file_uri('images/gavernwp.png'); ?>" class="gk-framework-logo" alt="GavernWP" />
			<?php endif; ?>
		</div>
	</footer>
	
	<?php gk_load('login'); ?>
	<?php gk_load('toolbar'); ?>
	
	<?php gk_load('social'); ?>
	
	<?php do_action('gavernwp_footer'); ?>
	
	<?php 
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($tpl->name . '_footer_code', ''))
			)
		); 
	?>
	
	<?php wp_footer(); ?>
	
	<?php do_action('gavernwp_ga_code'); ?>
</body>
</html>
