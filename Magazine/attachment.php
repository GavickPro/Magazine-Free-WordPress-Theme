<?php

/**
 *
 * Attachment page
 *
 **/

global $tpl;

gk_load('header');
gk_load('before');

?>

<div id="gk-mainbody">
<?php while ( have_posts() ) : the_post(); ?>
	<article class="attachment-page">
		<header>
			<?php if(get_option($tpl->name . '_details_on_attachment_page', 'Y') == 'Y') : ?>
			<?php gk_post_meta(true); ?>
			<?php endif; ?>
		
			<h2><?php the_title(); ?></h2>
		</header>
	
		<?php if ( is_search() || is_archive() || is_tag() ) : ?>
		<div class="summary">
			<?php the_excerpt(); ?>
			
			<a href="<?php echo get_permalink(get_the_ID()); ?>" class="btn btn-more"><?php _e('Read more', GKTPLNAME); ?></a>
		</div>
		<?php else : ?>
		<div class="intro">
			<?php if ( wp_attachment_is_image() ) :
				$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
				//
				foreach ( $attachments as $k => $attachment ) {
					if ( $attachment->ID == $post->ID )
						break;
				}
				$k++;
				// If there is more than 1 image attachment in a gallery
				if (count($attachments) > 1) {
					if(isset($attachments[$k])) {
						$next_attachment_url = get_attachment_link($attachments[$k]->ID);
					} else {
						$next_attachment_url = get_attachment_link($attachments[0]->ID);
					}
				} else {
					$next_attachment_url = wp_get_attachment_url();
				}
			?>			
				<p>
					<a href="<?php echo $next_attachment_url; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment">
						<?php echo wp_get_attachment_image( $post->ID, array( 900, 9999 ) ); ?>
					</a>
				</p>
					
				<?php previous_image_link( false, __('Previous Image', GKTPLNAME) ); ?>
				<?php next_image_link( false, __('Next Image', GKTPLNAME) ); ?>
			<?php else : ?>
			<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo esc_attr(get_the_title()); ?>" rel="attachment">
				<?php echo basename(get_permalink()); ?>
			</a>
			<?php endif; ?>
			
			<a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php esc_attr(printf(__('Return to %s', GKTPLNAME), get_the_title($post->post_parent))); ?>" rel="gallery" class="btn">
				<?php echo get_the_title($post->post_parent); ?>
			</a>
		</div>
		
		<div class="content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', GKTPLNAME ) ); ?>
			<?php gk_post_links(); ?>
		</div>
		<?php endif; ?>
		
		<?php get_template_part( 'layouts/content.post.footer' ); ?>
	</article>
	
	<?php comments_template('', true); ?>
<?php endwhile; ?>
</div>

<?php

gk_load('after');
gk_load('footer');

// EOF