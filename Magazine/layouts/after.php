<?php 
	
	/**
	 *
	 * Template elements after the page content
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
?>
		
				<?php if(gk_is_active_sidebar('mainbody_bottom')) : ?>
				<div id="gk-mainbody-bottom">
					<?php gk_dynamic_sidebar('mainbody_bottom'); ?>
				</div>
				<?php endif; ?>
			</div><!-- end of the #gk-content-wrap -->
			
			<?php 
			if( 
				get_option($tpl->name . '_sidebar_position', 'right') != 'none' && 
				gk_is_active_sidebar('sidebar') && 
				( $args == null || ($args != null && $args['sidebar'] == true) )
			) : ?>
			<?php do_action('gavernwp_before_column'); ?>
			<aside id="gk-sidebar">
				<div>
					<?php gk_dynamic_sidebar('sidebar'); ?>
				</div>
			</aside>
			<?php do_action('gavernwp_after_column'); ?>
			<?php endif; ?>
		</section><!-- end of the mainbody section -->
	
		<?php 
		if( 
			get_option($tpl->name . '_inset_position', 'right') != 'none' && 
			(gk_is_active_sidebar('inset') || gk_show_menu('mainmenu'))
		) : ?>
		<?php do_action('gavernwp_before_inset'); ?>
		<aside id="gk-inset"<?php if(!gk_is_active_sidebar('inset')) : ?> class="gk-main-menu"<?php endif; ?>>
			<?php if(gk_show_menu('mainmenu')) : ?>
				<nav>
				<?php gavern_menu('mainmenu', 'gk-main-menu', array('walker' => new GKMenuWalker(), 'menu_class' => 'menu-lvl-' . get_option($tpl->name . '_mainmenu_visible_levels', '2'))); ?>
				</nav>
			<?php endif; ?>
		
			<?php gk_dynamic_sidebar('inset'); ?>
		</aside>
		<?php do_action('gavernwp_after_inset'); ?>
		<?php endif; ?>
		
		<!--[if IE 8]>
		<div class="ie8clear"></div>
		<![endif]-->
	</div><!-- end of the #gk-mainbody-columns -->
</div><!-- end of the .gk-page-wrap section -->	

<?php if(gk_is_active_sidebar('bottom1')) : ?>
<div id="gk-bottom1" class="gk-page widget-area">
	<div>
		<?php gk_dynamic_sidebar('bottom1'); ?>
		<!--[if IE 8]>
		<div class="ie8clear"></div>
		<![endif]-->
	</div>
</div>
<?php endif; ?>

<?php if(gk_is_active_sidebar('bottom2')) : ?>
<div id="gk-bottom2" class="gk-page widget-area">
	<div>
		<?php gk_dynamic_sidebar('bottom2'); ?>
		<!--[if IE 8]>
		<div class="ie8clear"></div>
		<![endif]-->
	</div>
</div>
<?php endif; ?>