<?php

/**
 *
 * Author page
 *
 **/

global $tpl;

gk_load('header');
gk_load('before');

?>

<div id="gk-mainbody">
	<?php if ( have_posts() ) : ?>
	
		<?php the_post(); ?>
	
		<?php rewind_posts(); ?>
	
		<?php gk_author(true); ?>
	
		<?php do_action('gavernwp_before_loop'); ?>
	
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		
		<?php gk_content_nav(); ?>
		
		<?php do_action('gavernwp_after_loop'); ?>
	
	<?php else : ?>
		<h1 class="page-title">
			<?php _e( 'Nothing Found', GKTPLNAME ); ?>
		</h1>
	
		<div class="intro">
			<?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', GKTPLNAME ); ?>
		</div>
		
		<?php get_search_form(); ?>
	<?php endif; ?>
</div>

<?php

gk_load('after');
gk_load('footer');

// EOF