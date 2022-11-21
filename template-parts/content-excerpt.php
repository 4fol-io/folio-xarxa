<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FolioXarxa
 */

use FolioXarxa\Templates;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('mb-4'); ?>>

	<header class="entry-header">

		<?php Templates\cats_list(); ?>

		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			Templates\posted_on();
			Templates\posted_by();
			Templates\comments_link();
			?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php 
	if (get_theme_mod('folio_xarxa_archive_thumb_show', true)){
		Templates\featured_image(); 
	}
	?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php Templates\entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
