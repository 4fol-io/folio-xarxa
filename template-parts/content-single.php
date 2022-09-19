<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FolioXarxa
 */

use FolioXarxa\Templates;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title('<h1 class="entry-title">', '</h1>'); ?>

		<?php if ('post' === get_post_type()) :
		?>
			<div class="entry-meta">
				<?php
				Templates\posted_on();
				Templates\posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php Templates\featured_image(); ?>

	<div class="entry-content">
		<?php
		the_content(sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__('Continue reading<span class="sr-only"> "%s"</span>', 'fland'),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post( get_the_title() )
		));

		Templates\post_navigation();
		?>

	</div><!-- .entry-content -->


	<footer class="entry-footer">
		<?php Templates\entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->