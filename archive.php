<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FolioXarxa
 */

use FolioXarxa\Pagination;


$layout = get_theme_mod('folio_xarxa_archive_layout', 'list');

get_header();
?>

	<main id="primary" class="site-main layout-<?php echo $layout; ?>">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			if ($layout !== 'list'): 
			?>
			<div class="row <?php echo $layout; ?>-row">
			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				if ($layout !== 'list'): 
				?>
				<div class="<?php echo $layout; ?>-col col-xs-12 col-md-6 col-lg-4 d-flex flex-column">
				<?php
				endif;

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content',  get_theme_mod( 'folio_xarxa_archive_content', 'excerpt' ) );

				if ($layout !== 'list'): 
				?>
				</div>
				<?php
				endif;

			endwhile;

			if ($layout !== 'list'):
			?>
			</div>
			<?php
			endif;

			Pagination\pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
