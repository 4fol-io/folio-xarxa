<?php
/**
 * FolioXarxa Gutenberg blocks utilities
 *
 * @package FolioXarxa
 */

namespace FolioXarxa\Blocks;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


/**
 * Applies wrapper div around aligned blocks (deprecated)
 * ONLY when using bootstrap .container to wide and full alignment 
 *
 *
 * @see   https://developer.wordpress.org/reference/hooks/render_block/
 * @link  https://codepen.io/webmandesign/post/gutenberg-full-width-alignment-in-wordpress-themes
 *
 * @param  string $block_content  The block content about to be appended.
 * @param  array  $block          The full block, including name and attributes.
 */
function wrap_alignment( $block_content, $block ) {
	if ( isset( $block['attrs']['align'] ) && in_array( $block['attrs']['align'], array( 'wide', 'full' ) ) ) {
		$block_content = sprintf(
			'<div class="%1$s">%2$s</div>',
			'align-wrap align-wrap-' . esc_attr( $block['attrs']['align'] ),
			$block_content
		);
	}
	return $block_content;
}

//add_filter( 'render_block',  __NAMESPACE__ . '\\wrap_alignment', 10, 2 );


/**
 * Inject class column count
 * 
 * @param string 	$content 		The block content about to be appended.
 * @param array 	$block 			The full block, including name and attributes
 * @return $content;
 */
function inject_class_column_count( $content, $block ) {
	if ( ! is_block_type( $block, "core/columns" ) ) {
		return $content;
	} else {
		$column_count = array_column($block['innerBlocks'],'blockName');
		$modified_content = str_replace('wp-block-columns','wp-block-columns has-'.count($column_count).'-columns',$content);
		return $modified_content;
	}
}

// Adjust columns rendering classes
add_filter( 'render_block', __NAMESPACE__ . '\\inject_class_column_count' , 10, 2 );

/**
 * block type aux function
 *
 * @param array $block 		A WordPress block array
 * @param string $type 		The block name being queried
 * @return bool;
 */
function is_block_type( $block, $type ) {
	if ( $type === $block['blockName'] ) {
		return true;
	}
	return false;
}