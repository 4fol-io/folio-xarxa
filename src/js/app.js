/**
 * Main FolioXarxa Application Script
 */


/**
 * Boostrap dependencies
 * NOTE: Popover, dropdowns and tooltip require popper and util modules. Popovers also require tooltip
 */
import 'popper.js';
//import 'bootstrap';
import 'bootstrap/js/dist/util';
//import 'bootstrap/js/dist/alert';
//import 'bootstrap/js/dist/button';
import 'bootstrap/js/dist/collapse';
import 'bootstrap/js/dist/dropdown';
//import 'bootstrap/js/dist/modal';
//import 'bootstrap/js/dist/popover';
//import 'bootstrap/js/dist/scrollspy';
//import 'bootstrap/js/dist/tab';
//import 'bootstrap/js/dist/toast';
//import 'bootstrap/js/dist/tooltip';

import Masonry from 'masonry-layout';

/**
 * App modules
 */
import { debounce, isMobile, goTo } from './modules/utils.js';
import './modules/bootstrap-dropdown-hover.js';
import './modules/anchor-scrolls.js';



( function ( $, themeData ) {

  'use strict';

  // Expose jquery to modules
  window.jQuery = $;
  window.$ = $;

  // Aux constants
  const $body = $( 'body' );
  const $win = $( window );
  const $doc = $( document );
  const $goup = $( '.sticky-scroll' );
  const breakpoint = 768;
  const page = document.getElementById( 'page' );

  // Aux variables
  let ww = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
  let msnry = null;


  /**
   * On resize event handler (debounced)
   */
  const onResize = debounce( () => {
    ww = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    if ( ww > breakpoint ) {
      $body.removeClass( 'device-sm' );
    } else {
      $body.addClass( 'device-sm' );
    }

    /*
    if (ww >= breakpoint) {
      if(!msnry){
          msnry = new Masonry( document.querySelector('.agora-view'), {
            itemSelector: '.view-col',
            "percentPosition": true 
          })
      }
    }else if(msnry){
      msnry.destroy();
      msnry = null;
    }
    */

    /*$( ".img-cover.fade.show" ).each( function () {
      fitThumb( this );
    } );*/

  }, 50, false )


  /**
   * On scroll event handler (debounced)
   */
  const onScroll = debounce( () => {

    const top = $win.scrollTop();

    if ( top > 300 ) {
      $goup.removeClass( 'off' );
    } else {
      $goup.addClass( 'off' );
    }

  }, 10, true )


  /**
   * Append external
   * @param {object} item dom element
   */
  const appendExternal = function ( item ) {
    var $item = $( item );
    if ( !$item.find( '.sr-only' ).length ) {
      $item.append( `<span class="sr-only">${themeData.t.externalLink}</span>` );
    }
  }

  /**
   * Sum fixed elements to offset
   */
  const getOffset = function ( offset ) {
    const $header = $( '.site-header' );
    const $menu = $( '.site-menu' );
    offset = offset || 0;

    if ( $header.length ) {
      offset += $header.height();
    }

    if ( $menu.length && !$body.hasClass( 'device-sm' ) ) {
      offset += $menu.height();
    }

    if ( $( 'body' ).hasClass( 'admin-bar' ) ) {
      offset += $( '#wpadminbar' ).height();
    }

    return offset;
  }


  /**
   * Toggle offcanvas menu
   */
  const toggleOffCanvas = function () {
    const $overlay = $( '.offcanvas-overlay' );
    const $trigger = $( '.offcanvas-trigger' );
    if ( $body.hasClass( 'offcanvas-open' ) ) {
      $trigger.addClass('closed');
      setTimeout( function () { $overlay.addClass( 'closed' ) }, 300 );
    } else {
      $trigger.removeClass( 'closed' )
      $overlay.removeClass( 'closed' );
    }
    $body.toggleClass( "offcanvas-open" );
    if ( $body.hasClass( 'device-touch' ) ) {
      $body.toggleClass( "overflow-hidden" );
    }
  }

  /**
   * Setup menu
   */
  const setupMenu = function () {


    // Offcanvas menu

    $( ".offcanvas-trigger" ).on( 'click', function ( ev ) {
      ev.preventDefault();
      toggleOffCanvas();
      return false;
    } )

    $( ".offcanvas-overlay" ).on( 'click', function () {
      if ( $body.hasClass( 'offcanvas-open' ) ) {
        toggleOffCanvas();
      }
    } )

    /*
    $doc.on('click', function(ev) {
      if (!$(ev.target).closest('.offcanvas').length) { 
        $body.toggleClass('offcanvas-open', false);
      }
    });
    */

    // External links
    /*const $external = $( '.site-menu ul.navbar-nav a[target=_blank], ul.footer-list a[target=_blank], ul.footer-text a[target=_blank]' );
    $external.each( function () {
      appendExternal( this );
    } )*/

  }


  /**
   * Setup generic events
   */
  const setupEvents = function () {

    // Resize event
    $win.on( 'resize', function () {
      onResize();
    } );

    // Scroll event
    $win.on( 'scroll', function () {
      onScroll();
    } );

    // Go to top scroll
    $goup.on( 'click', function () {
      window.scrollTo( { top: 0, behavior: 'smooth' } );
      return false;
    } );

    // Tooltips
    /*$( '[data-toggle="tooltip"]' ).tooltip( {
      animated: 'fade'
    } );*/

    // Popovers
    //$( '[data-toggle="popover"]' ).popover();


    if (!msnry){
      var elms = document.querySelector('.masonry-row');
      if(elms){
        msnry = new Masonry( elms, {
          itemSelector: '.masonry-col',
          "percentPosition": true 
        });
      }
    }


    // Fetch all the forms we want to apply custom validation styles to
    $doc.on( 'submit', '.needs-validation', function ( e ) {
      if ( !this.checkValidity() ) {
        e.preventDefault();
        e.stopPropagation();
        const el = document.querySelector( '.needs-validation :invalid' );
        if ( el ) {
          goTo( el, 'smooth', getOffset( 100 ), function () {
            el.focus();
          } );
        }
      }
      $( this ).addClass( 'was-validated' );
    } );


  }



  /**
   * Set object fit image 
   * @param {object} img image object
   * @returns 
   */
  /*const fitThumb = function ( img ) {

    if ( !img ) return false;

    const $img = $( img );
    const w = img.naturalWidth;
    const h = img.naturalHeight;

    $img.addClass( 'show' );

    if ( !w || !h ) return false;

    if ( w < $img.parent().width() || h < $img.parent().height() ) {
      $img.addClass( 'contain' );
    } else {
      $img.removeClass( 'contain' );
    }

  }*/

  /**
   * Position and Fade In image thumbnails after load complete
   */
  const preloadThumbs = function () {
    $( ".img-cover.fade:not(.show),.img-fluid.fade:not(.show)" ).on( "load", function () {
      //fitThumb( this );
      $( this ).addClass( 'show' );
    } ).each( function () {
      // forze for cached images
      if ( this.complete ) $( this ).trigger( "load" );
    } );
  }

  /**
   * Initialize application
   */
  $( function () {
    console.log( '🚀 Folio is ready!' );
    if ( isMobile.any() ) $body.addClass( 'device-touch' );
    //objectFitImages( 'img.img-cover' );
    setupMenu();
    setupEvents();
    preloadThumbs();
    onResize();
    onScroll();
  } )

} )( jQuery, typeof folioXarxaData !== 'undefined' ? folioXarxaData : {} );