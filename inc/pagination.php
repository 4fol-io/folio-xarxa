<?php

/**
 * FolioXarxa pagination
 *
 * @package FolioXarxa
 */

namespace FolioXarxa\Pagination;

// Exit if accessed directly.
defined('ABSPATH') || exit;


/**
 * Adjuns pagination links (screen readers prefix && leading zero)
 */
function pagination_link($link) {
  $n = (int)strip_tags($link);
  $before = '';
  if ($n > 0) {
    $before = '<span class="sr-only">' . __('Page', 'folio-xarxa') . ' </span>';
  }
  echo str_replace('page-numbers', 'page-link', str_replace('<span class="before"></span>', $before, $link));
}


/**
 * Render pagination
 */
function render_pagination($current = 0, $total = 0, $links = array(), $args = array()) {

  if (empty($links) || empty($args)) return false;
  ?>

  <nav class="pagination-nav my-5" aria-label="<?php echo $args['screen_reader_text']; ?>">
    <ul class="pagination flex-wrap align-items-center justify-content-center mb-0">
      <?php
      $prev = false;
      $next = false;
      foreach ($links as $key => $link) {
        if (strpos($link, 'prev')) $prev = true;
        if (strpos($link, 'next')) $next = true;
      }

      if (!$prev) {
      ?>
        <li class="page-item">
          <span class="page-link text-muted"><?php echo __('Previous', 'folio-xarxa'); ?></span>
        </li>
        <?php
      }

      foreach ($links as $key => $link) {
        if (strpos($link, 'prev')) {
        ?>
          <li class="page-item">
            <?php echo str_replace('page-numbers', 'page-link', $link); ?>
          </li>
        <?php
        } else if (strpos($link, 'next')) {
        ?>
          <li class="page-item">
            <?php echo str_replace('page-numbers', 'page-link', $link); ?>
          </li>
        <?php
        } else {
        ?>
          <li class="page-item <?php echo strpos($link, 'current') ? 'active' : '' ?>">
            <?php pagination_link($link); ?>
          </li>
        <?php
        }
      }

      if (!$next) {
        ?>
        <li class="page-item">
          <span class="page-link text-muted"><?php echo __('Next', 'folio-xarxa'); ?></span>
        </li>
      <?php
      }

      ?>
    </ul>
  </nav>
  <?php
}



/**
 * Posts pagination
 */
function pagination($args = array()) {

  $total = $GLOBALS['wp_query']->max_num_pages;
  if ($total <= 1) return;
  $current =  max(1, get_query_var('paged'));

  $end = 1;
  $mid = 2;
  if ($current >= $total - 2 || $current < 3) $end = 3;
  if ($current == 3 || $current == $total - 2) {
    $end = 1;
    $mid = 2;
  };
  $all = ($total <= 7) ? true : false;

  $args = wp_parse_args($args, array(
    'end_size'           => $end,
    'mid_size'           => $mid,
    'show_all'           => $all,
    'prev_next'          => true,
    'prev_text'          => __('Previous', 'folio-xarxa'),
    'next_text'          => __('Next', 'folio-xarxa'),
    'screen_reader_text' => __('Navigation', 'folio-xarxa'),
    'type'               => 'array',
    'current'            => $current,
    'before_page_number' => '<span class="before"></span>'
  ));

  $links = paginate_links($args);

  render_pagination($current, $total, $links, $args);
}



/**
 * Comments pagination
 */
function comments_pagination($args = array()) {

  $total = get_comment_pages_count();

  if ($total <= 1) return;
  $current =  max(1, get_query_var('cpage'));

  $end = 1;
  $mid = 1;
  if ($current >= $total - 2 || $current < 3) $end = 3;
  if ($current == 3 || $current == $total - 2) {
    $end = 1;
    $mid = 2;
  };
  //$all = ($total <= 7) ? true : false;

  $args = wp_parse_args($args, array(
    'end_size'           => $end,
    'mid_size'           => $mid,
    'prev_next'          => true,
    'prev_text'          => __('Previous', 'folio-xarxa'),
    'next_text'          => __('Next', 'folio-xarxa'),
    'screen_reader_text' => __('Comments navigation', 'folio-xarxa'),
    'type'               => 'array',
    'echo'               => false,
    'current'            => $current,
    'before_page_number' => '<span class="before"></span>'
  ));

  $links = paginate_comments_links($args);

  render_pagination($current, $total, $links, $args);
}


/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function navigation() {
  // Don't print empty markup if there's only one page.
  if ($GLOBALS['wp_query']->max_num_pages < 2) {
    return;
  }
  ?>
  <nav class="navigation paging-navigation" role="navigation">
    <h1 class="sr-only"><?php esc_html_e('Posts navigation', 'folio-xarxa'); ?></h1>
    <div class="nav-links">

      <?php if (get_next_posts_link()) : ?>
        <div class="nav-previous btn btn-sm"><span class="icon icon-chevron-left" aria-hidden="true"></span> <?php next_posts_link(__('Older posts', 'folio-xarxa')); ?></div>
      <?php endif; ?>

      <?php if (get_previous_posts_link()) : ?>
        <div class="nav-next btn btn-sm"><?php previous_posts_link(__('Newer posts', 'folio-xarxa')); ?> <span class="icon icon-chevron-right" aria-hidden="true"></span></div>
      <?php endif; ?>

    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}
