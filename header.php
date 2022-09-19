<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FolioXarxa
 */

use FolioXarxa\Assets\AssetResolver;
use FolioXarxa\Utils;

$content_align = get_theme_mod('folio_xarxa_align', '');
$lang_menu_show = get_theme_mod('folio_xarxa_lang_show', true);
$cta_show = get_theme_mod('folio_xarxa_cta_show', false);

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Roboto&display=swap" rel="stylesheet">

	<?php if (!get_option('site_icon')) : ?>
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo AssetResolver::resolve('images/apple-touch-icon.png') ?>">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo AssetResolver::resolve('images/favicon-32x32.png') ?>">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo AssetResolver::resolve('images/favicon-16x16.png') ?>">
		<!--[if IE]>
		<link rel="shortcut icon" href="<?php echo AssetResolver::resolve('images/favicon.ico') ?>">
		<![endif]-->
	<?php endif; ?>

	<link rel="manifest" href="<?php echo get_stylesheet_directory_uri() ?>/site.webmanifest">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if (function_exists('wp_body_open')) {
		wp_body_open();
	}
	?>

	<div id="page" class="site d-flex flex-column min-vh-100">

		<div class="skippy overflow-hidden">
			<a class="skip-link sr-only sr-only-focusable position-absolute" href="#primary"><?php esc_html_e('Skip to content', 'folio-xarxa'); ?></a>
		</div>

		<header id="masthead" class="site-header">

			<div class="container container-wide d-flex position-relative justify-content-between">

				<div class="site-branding d-flex align-items-center">

					<div class="navbar-brand site-logo">
						<?php
						if (has_custom_logo()) :
							the_custom_logo();
						else :
						?>
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" class="custom-logo-link ml-1">
								<img src="<?php echo AssetResolver::resolve('images/folio-xarxa-logo.svg') ?>" alt="<?php esc_html_e(get_bloginfo('name', 'esc_html')); ?>">
							</a>
						<?php endif; ?>
					</div>

					<?php
					if (is_front_page() && is_home()) :
					?>
						<h1 class="site-title sr-only"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
					<?php
					else :
					?>
						<p class="site-title sr-only"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
					<?php
					endif;

					$site_description = get_bloginfo('description', 'display');
					if ($site_description || is_customize_preview()) :
					?>
						<p class="site-description sr-only"><?php echo $site_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
															?></p>
					<?php endif; ?>

				</div><!-- .site-branding -->

				<nav id="site-navigation" class="site-menu navbar navbar-expand flex-fill py-0">

					<div class="d-none d-lg-flex flex-lg-fill">

						<?php
						wp_nav_menu(
							array(
								'theme_location' 	=> 'primary-menu',
								'menu_id'        	=> 'primary-menu',
								'depth'             => 2, // 1 = no dropdowns, > 1 top level dropdown
								'container'	=> '',
								'menu_class'        => 'navbar-nav mx-auto',
								'fallback_cb'       => 'FolioXarxa\Nav\WP_Bootstrap_Navwalker::fallback',
								'walker'            => new FolioXarxa\Nav\WP_Bootstrap_Navwalker(),
							)
						);
						?>

						<nav class="top-menu d-flex align-items-center ml-3 mr-n3">

							<?php 
							if($cta_show) :
								$cta_type = get_theme_mod('folio_xarxa_cta_type', 'btn-primary');
								$cta_outline = get_theme_mod('folio_xarxa_cta_outline', false);
								$cta_url = get_theme_mod('folio_xarxa_cta_type', '#');
								$cta_title = get_theme_mod('folio_xarxa_cta_title', 'Button');
								$cta_target = get_theme_mod('folio_xarxa_cta_type', '_self');
								$cta_type = $cta_outline ? str_replace('btn-','btn-outline-', $cta_type) : $cta_type;
							?>
								<div class="cta"><a href="<?php echo $cta_url ?>" class="btn btn-sm <?php echo $cta_type ?> px-3 py-2" target="<?php echo $cta_target ?>"><?php echo $cta_title ?></a></div>
							<?php
							endif;
							?>

							<?php if($lang_menu_show) Utils\language_selector(); ?>

						</nav>

					</div>

					<div class="ml-auto mr-n3 d-lg-none">
						<button type="button" id="offcanvas-trigger" class="btn offcanvas-trigger closed" aria-label="<?php esc_html_e('Menu', 'folio-xarxa'); ?>" aria-expanded="false">
							<span></span>
							<span></span>
							<span></span>
						</button>
					</div>

				</nav><!-- #site-navigation -->

			</div>

		</header><!-- #masthead -->


		<?php get_template_part('template-parts/menu', 'offcanvas'); ?>

		<div id="site-container" class="site-container">

			<div class="container">

				<div id="site-content" class="site-content py-5 <?php echo $content_align; ?>">