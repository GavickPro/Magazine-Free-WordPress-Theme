<?php

/**
 *
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 **/

global $tpl; 

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'layouts/content.post.header' ); ?>

		<?php get_template_part( 'layouts/content.post.featured' ); ?>

		<?php if (is_search() || is_home() || is_archive() || is_tag()) : ?>
		<div class="summary">
			<?php the_excerpt(); ?>
			
			<a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn btn-more"><?php _e('Read more', GKTPLNAME); ?></a>
		</div>
		<?php else : ?>
		<div class="content">
			<?php if(is_single()) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php the_content( __( 'Continue reading &rarr;', GKTPLNAME ) ); ?>
			<?php endif; ?>
			
			<?php gk_post_fields(); ?>
			<?php gk_post_links(); ?>
		</div>
		<?php endif; ?>

		<?php get_template_part( 'layouts/content.post.footer' ); ?>
	</article>