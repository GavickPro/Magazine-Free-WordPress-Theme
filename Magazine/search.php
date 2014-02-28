<?php

/**
 *
 * Search page
 *
 **/

global $tpl;

gk_load('header');
gk_load('before');

?>

<div id="gk-mainbody" class="search-page">
	<?php if ( have_posts() ) : ?>
		<h1 class="page-title">
			<?php printf( __( 'Search Results for: %s', GKTPLNAME ), '<em>' . get_search_query() . '</em>' ); ?>
		</h1>
	
		<?php 
			get_search_form(); 
			$founded = false;
		?>
		
		<?php do_action('gavernwp_before_loop'); ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			<?php
			
				get_template_part( 'content', get_post_format() );
				$founded = true;
			?>
		<?php endwhile; ?>
		
		<?php gk_content_nav(); ?>
	
		<?php do_action('gavernwp_after_loop'); ?>
	
		<?php if(!$founded) : ?>
		<h2>
			<?php _e( 'Nothing Found', GKTPLNAME ); ?>
		</h2>
		
		<div class="intro">
			<?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', GKTPLNAME ); ?>
		</div>
		<?php endif; ?>
	
	<?php else : ?>				
		<h1 class="page-title">
			<?php _e( 'Nothing Found', GKTPLNAME ); ?>
		</h1>
		
		<?php get_search_form(); ?>
		
		<div class="intro">
			<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', GKTPLNAME ); ?></p>
		</div>
	<?php endif; ?>
</div>

<?php

gk_load('after');
gk_load('footer');

// EOF