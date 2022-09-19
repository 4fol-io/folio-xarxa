<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FolioXarxa
 */

$gototop_show = get_theme_mod('folio_xarxa_gototop_show', true);
$footer_text = get_theme_mod('folio_xarxa_footer_text', '');
$footer_align = get_theme_mod('folio_xarxa_footer_align', '');

?>
			</div><!-- #site-content -->

			<?php get_sidebar(); ?>

		</div><!-- .container -->

	</div><!-- #site-container -->

	<footer id="site-colophon" class="site-footer mt-auto">

		<div class="container">


			<?php if ($gototop_show) : ?>
			<div class="sticky-scroll-foot d-none d-md-block">
				<a class="sticky-scroll off" role="button" href="#page">
					<span class="sr-only"><?php echo __("Go to top", "folio-xarxa"); ?></span>
				</a>
			</div><!-- .sticky-scroll-foot -->
			<?php endif; ?>

			
			<?php if ($footer_text !== '') : ?>
			<div class="footer-text small <?php echo $footer_align; ?> py-4">
				<?php echo $footer_text ?>
			</div><!-- .footer_text -->
			<?php endif; ?>

		</div>

	</footer><!-- #site-colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>