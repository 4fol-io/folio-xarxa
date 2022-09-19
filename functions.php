<?php
/**
 * FolioXarxa functions and definitions
 *
 * @package FolioXarxa
 */

define('FOLIO_XARXA_THEME_VERSION',  '1.0.0');
define('FOLIO_XARXA_NO_IMAGE',       get_stylesheet_directory_uri() . '/dist/images/no-image.jpg');

$folio_xarxa_includes = array(
  '/clean.php',                           // Clean head, inline styles,...
  '/setup.php',                           // Theme setup and custom theme supports
  '/images.php',                          // Theme image custom utils
  '/assets.php',                          // Assets management
  '/blocks.php',                          // Blocks (alingwide, alignfull) wrapper
  '/utils.php',                           // General utils, filters, action hooks,...
  '/nav.php',                             // Custom Bootstrap Nav Walker
  '/pagination.php',                      // Custom pagination
  '/templates.php',                       // Custom templates for this theme
  '/customizer.php',                      // Customizer preview

);


if ( defined( 'JETPACK__VERSION' ) ) {
	$folio_xarxa_includes[] = '/jetpack.php';     // Load Jetpack compatibility file
}

/**
 * Include theme dependencies
 */
foreach ( $folio_xarxa_includes as $file ) {
	$filepath = locate_template( '/inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}
