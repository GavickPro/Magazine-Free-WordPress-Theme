<?php

/**
 *
 * The template fragment to show post footer
 *
 **/

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');

global $tpl; 

$tag_list = get_the_tag_list( '', __( ', ', GKTPLNAME ) );

$params = get_post_custom();
$params_aside = isset($params['gavern-post-params-aside']) ? $params['gavern-post-params-aside'][0] : false;

$param_aside = true;
$param_tags = true;

 if($params_aside) {
  $params_aside = unserialize(unserialize($params_aside));
  $param_aside = $params_aside['aside'] == 'Y';
  $param_tags = $params_aside['tags'] == 'Y';
 }

?>

<?php do_action('gavernwp_after_post_content'); ?>

<?php if(is_singular()) : ?>
	<?php if($tag_list != '' && $param_tags): ?>
	<p class="tags">
		<?php _e('Tagged under:', GKTPLNAME); ?>
		<?php echo $tag_list; ?>
	</p>
	<?php endif; ?>
	<?php if($attachment && wp_attachment_is_image()) : ?>
	<p class="size">
		<?php _e('Attachment size:', GKTPLNAME); ?>	
		<?php
			$metadata = wp_get_attachment_metadata();
			printf( __( 'Full size is %s pixels', GKTPLNAME),
				sprintf( '<a href="%1$s" title="%2$s">%3$s &times; %4$s</a>',
					wp_get_attachment_url(),
					esc_attr( __('Link to full-size image', GKTPLNAME) ),
					$metadata['width'],
					$metadata['height']
				)
			);
		?> 
	</p>	
	<?php endif; ?>
	
	
	<?php 
		// variable for the social API HTML output
		$social_api_output = gk_social_api(get_the_title(), get_the_ID()); 
	?>
		
	<?php if($social_api_output != '' || gk_author(false, true)): ?>
	<footer>
		<?php echo $social_api_output; ?>
		<?php gk_author(); ?>
	</footer>
	<?php endif; ?>
<?php endif; ?>

<!--[if IE 8]>
<div class="ie8clear"></div>
<![endif]-->