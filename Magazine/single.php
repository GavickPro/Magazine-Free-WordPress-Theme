<?php

/**
 *
 * Single page
 *
 **/

global $tpl;

gk_load('header');
gk_load('before');

?>

<div id="gk-mainbody">
	<?php while ( have_posts() ) : the_post(); ?>	
		<?php get_template_part( 'content', get_post_format() ); ?>
				
		<?php comments_template( '', true ); ?>
		
		<?php gk_content_nav(); ?>
	<?php endwhile; // end of the loop. ?>
</div>

<?php

gk_load('after');
gk_load('footer');

// EOF