<?php 
	
	/**
	 *
	 * Template toolbar
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;
	
	$mail_output = get_option($tpl->name . '_email_url', '');
	
	if(get_option($tpl->name . '_email_url', '')) {
	    if(stripos($mail_output, 'mailto:') !== FALSE) {
	     	$encoded_email = '';
			$mail_output = str_replace('mailto:', '', $mail_output);
	
		    for ($i = 0; $i < strlen($mail_output); $i++) {
		    	$encoded_email .= "&#" . ord($mail_output[$i]) . ';';
			}
			
			$mail_output = 'mailto:' . $encoded_email;
	    }
	}

?>

<aside id="gk-toolbar">
	<?php if(gk_show_menu('mainmenu')) : ?>
		<?php gavern_menu('mainmenu', 'main-menu-mobile', array('walker' => new GKMenuWalkerMobile(), 'items_wrap' => '<select onchange="window.location.href=this.value;"><option value="#">'.__('Select a page', GKTPLNAME).'</option>%3$s</select>', 'container' => 'div')); ?>
	<?php endif; ?>
	
	<?php if(get_option($tpl->name . '_email_url', '') != '' || get_option($tpl->name . '_rss_url', '') != '') : ?>
	<div id="gk-links">
		<?php if(get_option($tpl->name . '_email_url', '') != '') : ?>
		<a href="<?php echo $mail_output; ?>" class="gk-icon-email"></a>
		<?php endif; ?>
		
		<?php if(get_option($tpl->name . '_rss_url', '') != '') : ?>
		<a href="<?php echo get_option($tpl->name . '_rss_url', ''); ?>" class="gk-icon-rss"></a>
		<?php endif; ?>
	</div>
	<?php endif; ?>
	
	<?php if(gk_is_active_sidebar('search')) : ?>
	<div id="gk-search" class="gk-icon-search">
		<?php gk_dynamic_sidebar('search'); ?>
	</div>
	<?php endif; ?>
	
	<?php if(gk_is_active_sidebar('social')) : ?>
	<div id="gk-social-icons">
		<?php gk_dynamic_sidebar('social'); ?>
	</div>
	<?php endif; ?>
	
	<?php if(get_option($tpl->name . '_styleswitcher_state', 'Y') == 'Y') : ?>
	<div id="gk-style-area" class="gk-icon-cog">
		<?php for($i = 0; $i < count($tpl->styles); $i++) : ?>
		<div class="gk-style-switcher-<?php echo $tpl->styles[$i]; ?>">
			<?php 
				$j = 1;
				foreach($tpl->style_colors[$tpl->styles[$i]] as $stylename => $link) : 
			?> 
			<a href="#<?php echo $link; ?>" class="gk-color-<?php echo $j; ?>"><?php echo $stylename; ?></a>
			<?php 
				$j++;
				endforeach; 
			?>
		</div>
		<?php endfor; ?>
	</div>
	<?php endif; ?>
</aside>

<a href="#" id="gk-back-to-top" class="gk-icon-top"><?php _e('Back to top', GKTPLNAME); ?></a>