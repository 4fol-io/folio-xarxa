<?php

/**
 * FolioXarxa templates utilities
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package FolioXarxa
 */

namespace FolioXarxa\Templates;

use FolioXarxa\Images;


// Exit if accessed directly.
defined('ABSPATH') || exit;


/**
 * Prints page links for paginated posts (i.e. including the <!--nextpage--> quicktag)
 */
function link_pages() {
	wp_link_pages(array(
		'before' => '<div class="page-links">' . esc_html__('Pages:', 'folio-xarxa'),
		'after'  => '</div>',
	));
}


/**
 * Print the customized post navigation for desktop
 */
function post_navigation() {
	the_post_navigation(array(
		'prev_text' => '<span class="sr-only">' . __(
			'Previous Post',
			'folio-xarxa'
		) . '</span><span class="btn btn-sm btn-default">&lsaquo; %title</span>',
		'next_text' => '<span class="sr-only">' . __(
			'Next Post',
			'folio-xarxa'
		) . '</span><span class="btn btn-sm btn-default">%title &rsaquo;</span>',
	));
}


/**
 * Comments link button
 */
function comments_link() {
	if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {

		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__('Leave a Comment<span class="sr-only"> on %s</span>', 'folio-xarxa'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post(get_the_title())
			)
		);
		echo '</span>';
	}
}


/**
 * Edit link
 */
function edit_link() {
	if (get_edit_post_link()) :
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit %s', 'folio-xarxa'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				'<span class="sr-only">' . get_the_title() . '</span>'
			),
			null,
			null,
			null,
			'btn btn-light btn-sm post-edit-link mb-2'
		);
	endif;
}


/**
 * Prints HTML with meta information for the current post-date/time.
 */
function posted_on() {
	//$time_string = '<span class="icon icon--calendar icon--xsmall icon--before" aria-hidden="true"></span>';
	$time_string = '';
	if (get_the_time('U') !== get_the_modified_time('U')) {
		$time_string .= '<span class="sr-only">%5$s </span><time class="entry-date published" datetime="%1$s">%2$s</time> <time class="updated sr-only" datetime="%3$s">%4$s</time>';
	} else {
		$time_string .= '<span class="sr-only">%3$s </span><time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr(get_the_date(DATE_W3C)),
		esc_html(get_the_date()),
		esc_attr(get_the_modified_date(DATE_W3C)),
		esc_html(get_the_modified_date() . ' ' . get_the_modified_time()),
		__('Publication date', 'folio-xarxa')
	);


	//$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
	$posted_on = '<a href="' . esc_url(get_day_link(
		get_post_time('Y'),
		get_post_time('m'),
		get_post_time('j')
	)) . '" rel="bookmark">' . $time_string . '</a>';

	echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}


/**
 * Prints HTML with meta information for the current author.
 */
function posted_by() {
	$byline = sprintf(
		/* translators: %s: post author. */
		esc_html_x('by %s', 'post author', 'folio-xarxa'),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
	);

	echo '<span class="byline">' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}


/**
 * Displays post tag list
 */
function tags_list() {
	$tags_list = get_the_tag_list('<ul class="list-unstyled list-inline" role="list"><li>', '</li><li>', '</li></ul>');
	if ($tags_list) {
		printf(
			'<div class="entry-tags"><span class="sr-only">%1$s </span>%2$s</div>',
			__('Tags', 'folio-xarxa'),
			$tags_list
		);
	}
}


/**
 * Displays post cats list
 */
function cats_list() {
	if (get_theme_mod('folio_xarxa_cats_show', false)){
		$categories_list = get_the_category_list(', ');
		if ($categories_list) {
			printf(
				'<div class="entry-cats"><span class="sr-only">%1$s </span>%2$s</div>',
				__('Categories', 'folio-xarxa'),
				$categories_list
			);
		}
	}
}


/**
 * Prints HTML with meta information for entry footer (tags list, comments link, edit link)
 */
function entry_footer() {

	if (get_theme_mod('folio_xarxa_tags_show', true)){
		tags_list();
	}
	edit_link();
}



/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function post_thumbnail($size = 'post-thumbnail') {

	if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
		return;
	}


	if (is_singular()) :
?>
		<div class="entry-media">
			<div class="post-thumbnail cover-img">
				<?php the_post_thumbnail($size, array('class' => 'img-cover fade', 'sizes' => 'calc(100vw - 30px)')); ?>
			</div>
		</div>
	<?php else : ?>
		<div class="entry-media">
			<a class="post-thumbnail cover-img" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail($size, array(
					'class' => 'img-cover fade',
					'alt'   => the_title_attribute(array(
						'echo' => false,
					)),
				));
				?>
			</a>
		</div>
	<?php
	endif; // End is_singular().
}


/**
 * Displays featured image post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 */
function featured_image($size = 'folio-xarxa-featured') {
	if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
		return;
	}
	?>
	<div class="featured-img mb-4">
		<?php the_post_thumbnail($size, array('class' => 'img-fluid fade', 'sizes' => 'calc(100vw - 30px)')); ?>
	</div>
<?php
}


/**
 * Custom comments form
 */
function comments_form() {

	$user          = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';
	$user_avatar   = $user->exists() ? get_avatar($user->ID, 70) : '';
	$req_msg = '<div class="invalid-feedback">' . __( 'Please enter the message', 'folio-xarxa' ) . '</div>';

	$comments_args = array(
		'comment_field' => '<div class="form-group comment-form-comment"><label id="lbl-comment" for="comment" class="sr-only">' .
		__( 'Your comment', 'folio-xarxa' ) . '</label> <textarea class="form-item" placeholder="' .
		__( 'Your message', 'folio-xarxa' ) . '" id="comment" name="comment" rows="3" required aria-required="true"></textarea>'.$req_msg.'</div>',
		'class_form'           => 'form comment-form needs-validation',
		'class_submit'         => 'submit btn btn-primary',
		'label_submit'         => __('Send comment', 'folio-xarxa'),
		'title_reply'          => __('Leave a comment', 'folio-xarxa'),
		'cancel_reply_link'    => __('Cancel Reply', 'folio-xarxa'),
		'submit_field'         => '<span class="form-submit d-inline-block">%1$s %2$s</span>',
		'comment_notes_before' => '',
		'comment_notes_after'  => '',
		'logged_in_as'         => sprintf(
			'<div class="logged-in-as d-flex align-items-center mb-4">' . $user_avatar . '%s</div>',
			sprintf(
				'<a href="%1$s" aria-label="%2$s" class="fn mr-1">%3$s</a> <a href="%4$s" class="logout btn btn-light btn-sm ml-auto">%5$s</a>',
				get_edit_user_link(),
				/* translators: %s: User name. */
				esc_attr(sprintf(__('Logged in as %s. Edit your profile.'), $user_identity)),
				$user_identity,
				wp_logout_url(apply_filters('the_permalink', get_permalink())),
				__('Log out?', 'folio-xarxa')
			)
		),
	);

	comment_form($comments_args);
}


/**
 * Comment form default fields
 */
function comment_form_default_fields($fields) {

	//var_dump($fields);

	$commenter     = wp_get_current_commenter();
	$req       = get_option('require_name_email');
	$aria_req  = ($req ? 'required aria-required="true"' : '');
	$req_name  = $req ? '<div class="invalid-feedback">' . __('Please enter the name', 'folio-xarxa') . '</div>' : '';
	$req_email = $req ? '<div class="invalid-feedback">' . __('Please enter a valid email', 'folio-xarxa') . '</div>' : '';

	$fields['author'] = '<div class="form-group comment-form-author">' .
		'<label id="lbl-author" for="author" class="sr-only">' . __('Name', 'folio-xarxa') . '</label> ' .
		'<input class="form-item" placeholder="' . __('Name') . '" id="author" name="author" type="text" value="' .
		esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' />' . $req_name . '</div>';

	$fields['email']  = '<div class="form-group comment-form-email">' .
		'<label id="lbl-email" for="email" class="sr-only">' . __('Your email') . '</label> ' .
		'<input class="form-item" placeholder="' . __('Your email') . '"id="email" name="email" type="email" value="' .
		esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' />' . $req_email . '</div>';

	$fields['url']    = '<div class="form-group comment-form-url">' .
		'<label id="lbl-url" for="url" class="sr-only">' . __('Website') . '</label>' .
		'<input class="form-item" placeholder="' . __('Website') . '" id="url" name="url" type="url" value="' .
		esc_attr($commenter['comment_author_url']) . '" /></div>';

	if (has_action('set_comment_cookies', 'wp_set_comment_cookies') && get_option('show_comments_cookies_opt_in')) {
		$consent           = empty($commenter['comment_author_email']) ? '' : ' checked="checked"';
		$fields['cookies'] = '<div class="form-group comment-form-cookies-consent"><div class="custom-control custom-checkbox">' .
		'<input class="custom-control-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" ' . $consent . ' />' .
	  '<label class="custom-control-label" for="wp-comment-cookies-consent">' .
	  __( 'Save my name, email, and website in this browser for the next time I comment.' ) .'</label></div></div>';
	}

	// change comment textarea order
	/*$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;*/

	return $fields;
}

add_filter('comment_form_fields',  __NAMESPACE__ . '\\comment_form_default_fields');