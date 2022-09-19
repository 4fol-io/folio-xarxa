<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FolioXarxa
 */

Use FolioXarxa\Pagination;

get_header();

$layout = get_theme_mod('folio_xarxa_archive_layout', 'list');
?>

	<main id="primary" class="site-main layout-<?php echo $layout; ?>">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header>
					<h1 class="page-title sr-only"><?php single_post_title(); ?></h1>
				</header>
				<?php
			endif;

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
				get_template_part( 'template-parts/content', get_theme_mod( 'folio_xarxa_archive_content', 'excerpt' )  );

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

			//the_posts_navigation();
			Pagination\pagination();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
