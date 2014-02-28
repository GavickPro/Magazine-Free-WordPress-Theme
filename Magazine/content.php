<?php

/**
 *
 * The default template for displaying content
 *
 **/

global $tpl; 

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'layouts/content.post.header' ); ?>
		
		<?php get_template_part( 'layouts/content.post.featured' ); ?>
		
		<?php if ( is_search() || is_home() || is_archive() || is_tag() ) : ?>
		<div class="summary">
			<?php the_excerpt(); ?>
			
			<a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn btn-more"><?php _e('Read more', GKTPLNAME); ?></a>
		</div>
		<?php else : ?>
		<div class="content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', GKTPLNAME ) ); ?>
			
			<?php gk_post_fields(); ?>
			<?php gk_post_links(); ?>
		</div>
		<?php endif; ?>
		
		<?php get_template_part( 'layouts/content.post.footer' ); ?>
	</article>