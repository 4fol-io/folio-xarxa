<?php

/**
 * Template part for displaying offcanvas menu
 *
 * @package FolioXarxa
 */

use FolioXarxa\Utils;

?>
<div class="offcanvas-overlay closed ml-auto d-lg-none"></div>

<div class="offcanvas ml-auto d-lg-none text-left" aria-labelledby="offcanvas-trigger">

  <div class="offcanvas-wrap">

    <div class="offcanvas-header d-flex align-items-center">

      <button type="button" title="<?php esc_attr_e('Close', 'folio-xarxa'); ?>" aria-label="<?php esc_attr_e('Close', 'folio-xarsa'); ?>" class="btn offcanvas-trigger offcanvas-close">
        <span></span>
        <span></span>
        <span></span>
      </button>

    </div>

    <nav role="navigation" class="offcanvas-menu d-flex flex-column">
      <?php
      wp_nav_menu(array(
        'theme_location'    => 'primary-menu',
        'menu_id'            => 'offcanvas-menu',
        'depth'             => 2, // 1 = no dropdowns, 2 = with dropdowns.
        'container'         => 'div',
        'container_class'   => 'navbar',
        'container_id'      => 'offcanvas-menu-container',
        'menu_class'        => 'navbar-nav nav',
        'fallback_cb'       => 'FolioXarxa\Nav\WP_Bootstrap_Navwalker::fallback',
        'walker'            => new FolioXarxa\Nav\WP_Bootstrap_Navwalker(),
      ));
      ?>

      <?php 
      $lang_menu_show = get_theme_mod('folio_xarxa_lang_show', true);
      if($lang_menu_show) Utils\language_selector(); 
      ?>

      <?php 
      $cta_show = get_theme_mod('folio_xarxa_cta_show', false);
			if($cta_show) :
				$cta_type = get_theme_mod('folio_xarxa_cta_type', 'btn-primary');
				$cta_url = get_theme_mod('folio_xarxa_cta_type', '#');
        $cta_outline = get_theme_mod('folio_xarxa_cta_outline', false);
				$cta_title = get_theme_mod('folio_xarxa_cta_title', 'Button');
				$cta_target = get_theme_mod('folio_xarxa_cta_type', '_self');
        $cta_type = $cta_outline ? str_replace('btn-','btn-outline-', $cta_type) : $cta_type;
			?>
				<div class="cta mb-2 mt-auto"><a href="<?php echo $cta_url ?>" class="btn btn-block <?php echo $cta_type ?> py-3" target="<?php echo $cta_target ?>"><?php echo $cta_title ?></a></div>
			<?php
			endif;
			?>

    </nav>

  </div>

</div>