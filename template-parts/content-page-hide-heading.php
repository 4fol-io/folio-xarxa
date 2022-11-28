<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FolioXarxa
 */

use FolioXarxa\Templates;
use FolioXarxa\Utils;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header screen-reader-text">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php Utils\the_breadcrumb(); ?>
	</header><!-- .entry-header -->

	<?php Templates\featured_image(); ?>

	<div class="entry-content">
		<?php
		the_content();

		Templates\link_pages(); 
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
	<footer class="entry-footer">
		<?php Templates\edit_link() ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
