<?php

/**
 *
 * The template fragment to show post header
 *
 **/

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');

global $tpl; 

$params = get_post_custom();
$params_title = isset($params['gavern-post-params-title']) ? esc_attr( $params['gavern-post-params-title'][0] ) : 'Y';

$show_meta = false;

if((!is_page_template('template.fullwidth.php') && ('post' == get_post_type() || 'page' == get_post_type())) && get_the_title() != '') {
	if(!is_home() || (is_home() && get_option($tpl->name . '_template_homepage_mainbody_meta', 'Y') == 'Y')) {
			$show_meta = true;
	}
}

?>

<?php if($show_meta || (get_the_title() != '' && $params_title == 'Y')) : ?>
<header>
	<?php 
	if(!('post' == get_post_type() && get_option($tpl->name . '_post_aside_state', 'Y') == 'N') && !is_home()) {
		if(!(get_post_type() == 'page' && get_option($tpl->name . '_template_show_details_on_pages', 'Y') == 'N')) {
			gk_post_meta(); 
		}
	}
	else if (is_home() && $show_meta) {
		gk_post_meta(); 
	} ?>
	
	<?php if(get_the_title() != '' && $params_title == 'Y') : ?>
	<h<?php echo (is_singular()) ? '1' : '2'; ?>>
		<?php if(!is_singular()) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', GKTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
		<?php endif; ?>
			<?php the_title(); ?>
		<?php if(!is_singular()) : ?>
		</a>
		<?php endif; ?>
		
		<?php if(is_sticky() && !is_home()) : ?>
		<sup>
			<?php _e( 'Featured', GKTPLNAME ); ?>
		</sup>
		<?php endif; ?>
	</h<?php echo (is_singular()) ? '1' : '2'; ?>>	
	<?php endif; ?>
</header>
<?php endif; ?>

<?php do_action('gavernwp_before_post_content'); ?>