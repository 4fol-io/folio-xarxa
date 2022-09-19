/* ========================================================================
 * Bootstrap: dropdownhover.js v1.1.x
 * http://kybarg.github.io/bootstrap-dropdown-hover/
 * ========================================================================
 * Licensed under MIT (https://github.com/kybarg/bootstrap-dropdown-hover/blob/master/LICENSE)
 * ========================================================================
 * Adapted for Boostrap 4 by Raúl Solana with keyDown interactions
 * ======================================================================== */

+function($) {
    'use strict';

    // DROPDOWN CLASS DEFINITION
    // =========================

    var backdrop = '.dropdown-backdrop';

    var Dropdownhover = function(element, options) {
        this.options  = options;
        this.$element = $(element);

        var that = this;

        // defining if navigation tree or single dropdown
        if (this.$element.hasClass('dropdown-toggle')) {
            this.dropdowns = this.$element.parent().find('.dropdown-menu').parent('.dropdown');
        } else {
            this.dropdowns = this.$element.find('.dropdown');
        }

        // this.dropdowns contains all "li" elements which have a submenu

        // this.options contains a onClick property which contains that the actual browser fires touch events, but this isn't used

        this.dropdowns.each(function() {

            $(this).children('a, button').on('touchstart', function(e) {

                 // console.log('Dropdownhover - options.onClick - touchstart');

                $(this).attr('data-touchstart-event', 'true');

            }).on('click', function(e) {

                // console.log('Dropdownhover - options.onClick - click', e);

                var touchstartEvent = $(this).attr('data-touchstart-event');

                if (touchstartEvent === 'true') {

                    var isActive = $(this).parent().hasClass('show');
                    var showMenu = $(this).attr('data-show-menu');
                    if (!isActive && showMenu !== 'true') {
                        that.show($(this));
                        e.preventDefault();

                        // Hack: Stop immediate to disable all followed event handlers, to stop that bootstrap offcanvas
                        // can interfer with the menu. This will also stop all further event handler.
                        e.stopImmediatePropagation();

                    } else {
                        var href = $(this).attr('href');
                        if (!href) {
                            that.hide($(this));
                        }
                    }

                    // console.log('Dropdownhover - options.onClick - click - touched', e);
                }

            });

            $(this).on('mouseenter.bs.dropdownhover', function(e) {

                // console.log('Dropdownhover - !options.onClick - mouseenter.bs.dropdownhover', e.target);

                that.show($(this).children('a, button'))

            }).on('mouseleave.bs.dropdownhover', function(e) {

                // console.log('Dropdownhover - !options.onClick - mouseleave.bs.dropdownhover', e.target);

                that.hide($(this).children('a, button'))

            })

            $(this).on('keydown', function(e) {

                // console.log('Dropdownhover - keydown', e.target);

                // Open with Arrow Down key
                if (e.key === 'ArrowDown') { 
                    that.show($(this).children('a, button'), e)
                }

                // Close with Escape Key
                if (e.key === 'Escape') { 
                    $(this).children('a').first().trigger('focus');
                    that.hide($(this).children('a, button'))
                }

                // Toggle with Space key
                if (e.key === ' ') { 

                    var isActive = $(this).hasClass('show');
                    if(isActive){
                        $(this).children('a').first().trigger('focus');
                        that.hide($(this).children('a, button'))
                    }else{
                        that.show($(this).children('a, button'), e)
                    }
                }

            })

        })

    };

    Dropdownhover.TRANSITION_DURATION = 300;
    Dropdownhover.DELAY_SHOW          = 100;
    Dropdownhover.DELAY_HIDE          = 150;
    Dropdownhover.TIMEOUT_SHOW;
    Dropdownhover.TIMEOUT_HIDE;

    Dropdownhover.DEFAULTS = {
        onClick:    false,
        animations: [
            'fadeInDown',
            'fadeInRight',
            'fadeInUp',
            'fadeInLeft'
        ]
    };

    /**
     * @param $this
     *
     * @returns {*}
     */
    function getParent($this) {
        var selector = $this.attr('data-target');

        if (!selector) {
            selector = $this.attr('href');
            selector = selector && /#[A-Za-z]/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '') // strip for ie7
        }

        var $parent = selector && $(document).find(selector);

        return $parent && $parent.length ? $parent : $this.parent()
    }

    /**
     * @param e
     */
    function clearMenus(e) {
        if (e && e.which === 3) {
            return;
        }

        $(backdrop).remove();
        $('[data-hover="dropdown"]').each(function() {
            var $this         = $(this);
            var $parent       = getParent($this);
            var relatedTarget = { relatedTarget: this };

            if (!$parent.hasClass('show')) {
                return;
            }

            if (
                e
                &&
                e.type === 'click'
                &&
                /input|textarea/i.test(e.target.tagName)
                &&
                $.contains($parent[0], e.target)
            ) {
                return;
            }

            $parent.trigger(e = $.Event('hide.bs.dropdownhover', relatedTarget));

            if (e.isDefaultPrevented()) {
                return;
            }

            $this.attr('aria-expanded', 'false');
            $parent.removeClass('show').trigger($.Event('hidden.bs.dropdownhover', relatedTarget))
        })
    }


    /**
     * Detect transition support
     * 
     * @returns {boolean}
     */
    function supportsTransitions() {
        var b = document.body || document.documentElement,
            s = b.style,
            p = 'transition';

        if (typeof s[p] == 'string') { return true; }

        // Tests for vendor specific prop
        var v = ['Moz', 'webkit', 'Webkit', 'Khtml', 'O', 'ms'];
        p = p.charAt(0).toUpperCase() + p.substr(1);

        for (var i=0; i<v.length; i++) {
            if (typeof s[v[i] + p] == 'string') { return true; }
        }

        return false;
    }

    /**
     * Opens dropdown menu when mouse is over the trigger element.
     *
     * @param _dropdownLink
     *
     * @returns {boolean}
     */
    Dropdownhover.prototype.show = function(_dropdownLink, e) {

        var that  = this;
        var $this = $(_dropdownLink);
        var event = e || false;

        window.clearTimeout(Dropdownhover.TIMEOUT_HIDE);

        Dropdownhover.TIMEOUT_SHOW = window.setTimeout(function() {

            // close all dropdowns
            $('.dropdown').not($this.parents()).each(function() {
                $(this).removeClass('show');
                $(this).children('.dropdown-menu').removeClass('show');
            });

            var effect = that.options.animations[0];

            if ($this.is('.disabled, :disabled')) {
                return;
            }

            var $parent  = $this.parent();
            var isActive = $parent.hasClass('show');

            if (!isActive) {

                if (event && event.type === 'keydown' ){
                    $parent.addClass('dropdown-key-triggered');
                }

                if ('ontouchstart' in document.documentElement && $parent.closest('.navbar-nav').length > 0) {

                    // if mobile we use a backdrop because click events don't delegate
                    //
                    // it will also be append to the dom multiple times, but if you click on the menu entry the site
                    // will be reloaded or if you click outsite of the menu all dom elements will be removed
                    $(document.createElement('div'))
                        .addClass('dropdown-backdrop')
                        .on('click', clearMenus)
                        .appendTo('body');
                }

                var $dropdown = $this.next('.dropdown-menu');

                $parent.addClass('show');
                $parent.children('.dropdown-menu').addClass('show');
                $this.attr('aria-expanded', true);

                // Ensures that all menus that are closed have proper aria tagging.
                $parent.siblings().each(function() {
                    if (!$(that).hasClass('show')) {
                        $(that).find('[data-hover="dropdown"]').attr('aria-expanded', false);
                    }
                });

                var side = that.position($dropdown);

                switch (side) {
                    case 'top':
                        effect = that.options.animations[2];
                        break;
                    case 'right':
                        effect = that.options.animations[3];
                        break;
                    case 'left':
                        effect = that.options.animations[1];
                        break;
                    default:
                        effect = that.options.animations[0];
                        break;
                }

                $dropdown.addClass('animated ' + effect);

                var transition = supportsTransitions() && $dropdown.hasClass('animated');

                transition ?
                    $dropdown
                        .one('bsTransitionEnd', function() {
                            $dropdown.removeClass('animated ' + effect);
                            if (event && event.type === 'keydown' ){
                                $dropdown.trigger('focus');
                            }
                        })
                        .emulateTransitionEnd(Dropdownhover.TRANSITION_DURATION) :
                    $dropdown.removeClass('animated ' + effect)
            }

        }, Dropdownhover.DELAY_SHOW);

        return false
    };

    /**
     * Closes dropdown menu when mouse is out of it.
     *
     * @param _dropdownLink
     */
    Dropdownhover.prototype.hide = function(_dropdownLink) {

        var $this   = $(_dropdownLink);
        var $parent = $this.parent();

        window.clearTimeout(Dropdownhover.TIMEOUT_SHOW);

        Dropdownhover.TIMEOUT_HIDE = window.setTimeout(function() {

            $parent.removeClass('show dropdown-key-triggered');
            $parent.children('.dropdown-menu').removeClass('show');
            $this.attr('aria-expanded', false)

        }, Dropdownhover.DELAY_HIDE);
    };

    /**
     * Calculating position of dropdown menu.
     *
     * @param dropdown
     *
     * @returns {string}
     */
    Dropdownhover.prototype.position = function(dropdown) {

        var win = $(window);

        // reset css to prevent incorrect position
        dropdown.css({
            bottom: '',
            left:   '',
            top:    '',
            right:  ''
        }).removeClass('dropdownhover-top');

        var viewport    = {
            top:  win.scrollTop(),
            left: win.scrollLeft()
        };
        viewport.right  = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();

        var bounds = dropdown.offset();
        if (bounds === undefined) {
            // fallback hack
            side = 'right';
            return side;
        }
        bounds.right    = bounds.left + dropdown.outerWidth();
        bounds.bottom   = bounds.top + dropdown.outerHeight();
        var position    = dropdown.position();
        position.right  = bounds.left + dropdown.outerWidth();
        position.bottom = bounds.top + dropdown.outerHeight();

        var side = '';

        var isSubnow = dropdown.parents('.dropdown-menu').length;

        if (isSubnow) {

            if (position.left < 0) {
                side = 'left';
                dropdown.removeClass('dropdownhover-right').addClass('dropdownhover-left')
            } else {
                side = 'right';
                dropdown.addClass('dropdownhover-right').removeClass('dropdownhover-left')
            }

            if (bounds.left < viewport.left) {
                side = 'right';
                dropdown.css({
                    left:  '100%',
                    right: 'auto'
                }).addClass('dropdownhover-right').removeClass('dropdownhover-left')
            } else if (bounds.right > viewport.right) {
                side = 'left';
                dropdown.css({
                    left:  'auto',
                    right: '100%'
                }).removeClass('dropdownhover-right').addClass('dropdownhover-left')
            }

            if (bounds.bottom > viewport.bottom) {
                dropdown.css({
                    bottom: 'auto',
                    top:    -(bounds.bottom - viewport.bottom)
                })
            } else if (bounds.top < viewport.top) {
                dropdown.css({
                    bottom: -(viewport.top - bounds.top),
                    top:    'auto'
                })
            }

        } else { // defines special position styles for root dropdown menu

            var parentLi   = dropdown.parent('.dropdown');
            var pBounds    = parentLi.offset();
            pBounds.right  = pBounds.left + parentLi.outerWidth();
            pBounds.bottom = pBounds.top + parentLi.outerHeight();

            if (bounds.right > viewport.right) {
                var styleTmp = dropdown.attr('style');
                // keep css if "auto !important" is used
                if (
                    styleTmp
                    &&
                    (
                        styleTmp.indexOf('left: auto !important;') === -1
                        &&
                        styleTmp.indexOf('right: auto !important;') === -1
                    )
                ) {
                    dropdown.css({
                        left:  -(bounds.right - viewport.right),
                        right: 'auto'
                    });
                }
            }

            if (
                bounds.bottom > viewport.bottom
                &&
                (pBounds.top - viewport.top) > (viewport.bottom - pBounds.bottom)
                ||
                dropdown.position().top < 0
            ) {
                side = 'top';
                dropdown.css({
                    bottom: '100%',
                    top:    'auto'
                }).addClass('dropdownhover-top').removeClass('dropdownhover-bottom')
            } else {
                side = 'bottom';
                dropdown.addClass('dropdownhover-bottom')
            }
        }

        return side;

    };


    // DROPDOWNHOVER PLUGIN DEFINITION
    // ==========================

    /**
     * @param option
     *
     * @returns {*}
     *
     * @constructor
     */
    function Plugin(option) {
        return this.each(function() {
            var $this    = $(this);
            var data     = $this.data('bs.dropdownhover');
            var settings = $this.data();

            if ($this.data('animations') !== undefined && $this.data('animations') !== null) {
                settings.animations = Array.isArray(settings.animations) ? settings.animations : settings.animations.split(' ');
            }

            var options = $.extend({}, Dropdownhover.DEFAULTS, settings, typeof option == 'object' && option);

            if (!data) {
                $this.data('bs.dropdownhover', (data = new Dropdownhover(this, options)));
            }

        })
    }

    var old = $.fn.dropdownhover;

    $.fn.dropdownhover             = Plugin;
    $.fn.dropdownhover.Constructor = Dropdownhover;

    // DROPDOWNHOVER NO CONFLICT
    // ====================
    $.fn.dropdownhover.noConflict = function() {
        $.fn.dropdownhover = old;
        return this
    };

    // APPLY TO STANDARD DROPDOWNHOVER ELEMENTS
    // ===================================
    $(function() {
        $('[data-hover="dropdown"]').each(function() {
            var $target = $(this);
            if ('ontouchstart' in document.documentElement) {
                Plugin.call($target, $.extend({}, $target.data(), { onClick: true }))
            } else {
                Plugin.call($target, $target.data())
            }
        })

        // Hacks to close opened dropdowns by keyboard

        $(document).on('blur', '.dropdown.dropdown-key-triggered .dropdown-item', function(e){
            if(e.relatedTarget && ! $(e.relatedTarget).hasClass('dropdown-item')){
                var $dropdown = $(this).closest('.dropdown.dropdown-key-triggered')
                $dropdown.removeClass('show dropdown-key-triggered');
                $dropdown.children('.dropdown-menu').removeClass('show');
                $dropdown.children('.dropdown-toggle').attr('aria-expanded', false);
            }
        });
        
        $(document).on('mouseup', function() {
            var $dropdown = $('.dropdown.dropdown-key-triggered');
            if($dropdown.length > 0){
                $dropdown.removeClass('show dropdown-key-triggered');
                $dropdown.children('.dropdown-menu').removeClass('show');
                $dropdown.children('.dropdown-toggle').attr('aria-expanded', false);
            }
        });
    });

}(jQuery);
