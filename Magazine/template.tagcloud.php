<?php

/*
Template Name: Tag cloud
*/

global $tpl;

gk_load('header');
gk_load('before');

?>

<div id="gk-mainbody" class="tagcloud">
	<?php while ( have_posts() ) : the_post(); ?>
		<header>
			<h1 class="page-title"><?php the_title(); ?></h1>
		</header>
		
		<div class="content">
			<?php the_content(); ?>
			
			<div class="tag-cloud">
				<?php wp_tag_cloud('number=0'); ?>
			</div>
		</div>
		
	<?php endwhile; ?>
</div>

<?php

gk_load('after');
gk_load('footer');

// EOF