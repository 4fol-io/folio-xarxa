(self.webpackChunkfolio_xarxa=self.webpackChunkfolio_xarxa||[]).push([[773],{272:(o,t,e)=>{"use strict";e(801),e(863),e(872);var n=e(751),r=e.n(n),a=function(o,t){var e=arguments.length>2&&void 0!==arguments[2]&&arguments[2],n=null;return function(){var r=arguments,a=this,i=e&&!n,s=function(){return o.apply(a,r)};clearTimeout(n),n=setTimeout(s,t),i&&s()}},i={Android:function(){return navigator.userAgent.match(/Android/i)},BlackBerry:function(){return navigator.userAgent.match(/BlackBerry/i)},iOS:function(){return navigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return navigator.userAgent.match(/Opera Mini/i)},Windows:function(){return navigator.userAgent.match(/IEMobile/i)},any:function(){return i.Android()||i.BlackBerry()||i.iOS()||i.Opera()||i.Windows()}};e(211);!function(o,t){window.jQuery=o,window.$=o;var e=o("body"),n=o(window),s=o(document),d=o(".sticky-scroll"),l=(document.getElementById("page"),window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth,null),h=a((function(){(window.innerWidth||document.documentElement.clientWidth||document.body.clientWidth)>768?e.removeClass("device-sm"):e.addClass("device-sm")}),50,!1),c=a((function(){n.scrollTop()>300?d.removeClass("off"):d.addClass("off")}),10,!0),u=function(){var t=o(".offcanvas-overlay"),n=o(".offcanvas-trigger");e.hasClass("offcanvas-open")?(n.addClass("closed"),setTimeout((function(){t.addClass("closed")}),300)):(n.removeClass("closed"),t.removeClass("closed")),e.toggleClass("offcanvas-open"),e.hasClass("device-touch")&&e.toggleClass("overflow-hidden")},f=function(){if(n.on("resize",(function(){h()})),n.on("scroll",(function(){c()})),d.on("click",(function(){return window.scrollTo({top:0,behavior:"smooth"}),!1})),!l){var t=document.querySelector(".masonry-row");t&&(l=new(r())(t,{itemSelector:".masonry-col",percentPosition:!0}))}s.on("submit",".needs-validation",(function(t){if(!this.checkValidity()){t.preventDefault(),t.stopPropagation();var n=document.querySelector(".needs-validation :invalid");n&&function(o,t,e,n){t=t||"smooth",e=e||0;var r=(o.getBoundingClientRect().top+(window.scrollY||document.documentElement.scrollTop)-e).toFixed(),a=function o(){window.pageYOffset.toFixed()===r&&(window.removeEventListener("scroll",o),n&&n())};window.addEventListener("scroll",a),a(),window.scrollTo({top:r,behavior:t})}(n,"smooth",(r=100,a=o(".site-header"),i=o(".site-menu"),r=r||0,a.length&&(r+=a.height()),i.length&&!e.hasClass("device-sm")&&(r+=i.height()),o("body").hasClass("admin-bar")&&(r+=o("#wpadminbar").height()),r),(function(){n.focus()}))}var r,a,i;o(this).addClass("was-validated")}))};o((function(){console.log("🚀 Folio is ready!"),i.any()&&e.addClass("device-touch"),o(".offcanvas-trigger").on("click",(function(o){return o.preventDefault(),u(),!1})),o(".offcanvas-overlay").on("click",(function(){e.hasClass("offcanvas-open")&&u()})),f(),o(".img-cover.fade:not(.show),.img-fluid.fade:not(.show)").on("load",(function(){o(this).addClass("show")})).each((function(){this.complete&&o(this).trigger("load")})),h(),c()}))}(jQuery,"undefined"!=typeof folioXarxaData&&folioXarxaData)},211:()=>{function o(t){return o="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(o){return typeof o}:function(o){return o&&"function"==typeof Symbol&&o.constructor===Symbol&&o!==Symbol.prototype?"symbol":typeof o},o(t)}!function(t){"use strict";var e=function(o,e){this.options=e,this.$element=t(o);var n=this;this.$element.hasClass("dropdown-toggle")?this.dropdowns=this.$element.parent().find(".dropdown-menu").parent(".dropdown"):this.dropdowns=this.$element.find(".dropdown"),this.dropdowns.each((function(){t(this).children("a, button").on("touchstart",(function(o){t(this).attr("data-touchstart-event","true")})).on("click",(function(o){if("true"===t(this).attr("data-touchstart-event")){var e=t(this).parent().hasClass("show"),r=t(this).attr("data-show-menu");if(e||"true"===r)t(this).attr("href")||n.hide(t(this));else n.show(t(this)),o.preventDefault(),o.stopImmediatePropagation()}})),t(this).on("mouseenter.bs.dropdownhover",(function(o){n.show(t(this).children("a, button"))})).on("mouseleave.bs.dropdownhover",(function(o){n.hide(t(this).children("a, button"))})),t(this).on("keydown",(function(o){("ArrowDown"===o.key&&n.show(t(this).children("a, button"),o),"Escape"===o.key&&(t(this).children("a").first().trigger("focus"),n.hide(t(this).children("a, button")))," "===o.key)&&(t(this).hasClass("show")?(t(this).children("a").first().trigger("focus"),n.hide(t(this).children("a, button"))):n.show(t(this).children("a, button"),o))}))}))};function n(o){o&&3===o.which||(t(".dropdown-backdrop").remove(),t('[data-hover="dropdown"]').each((function(){var e=t(this),n=function(o){var e=o.attr("data-target");e||(e=(e=o.attr("href"))&&/#[A-Za-z]/.test(e)&&e.replace(/.*(?=#[^\s]*$)/,""));var n=e&&t(document).find(e);return n&&n.length?n:o.parent()}(e),r={relatedTarget:this};n.hasClass("show")&&(o&&"click"===o.type&&/input|textarea/i.test(o.target.tagName)&&t.contains(n[0],o.target)||(n.trigger(o=t.Event("hide.bs.dropdownhover",r)),o.isDefaultPrevented()||(e.attr("aria-expanded","false"),n.removeClass("show").trigger(t.Event("hidden.bs.dropdownhover",r)))))})))}function r(n){return this.each((function(){var r=t(this),a=r.data("bs.dropdownhover"),i=r.data();void 0!==r.data("animations")&&null!==r.data("animations")&&(i.animations=Array.isArray(i.animations)?i.animations:i.animations.split(" "));var s=t.extend({},e.DEFAULTS,i,"object"==o(n)&&n);a||r.data("bs.dropdownhover",a=new e(this,s))}))}e.TRANSITION_DURATION=300,e.DELAY_SHOW=100,e.DELAY_HIDE=150,e.DEFAULTS={onClick:!1,animations:["fadeInDown","fadeInRight","fadeInUp","fadeInLeft"]},e.prototype.show=function(o,r){var a=this,i=t(o),s=r||!1;return window.clearTimeout(e.TIMEOUT_HIDE),e.TIMEOUT_SHOW=window.setTimeout((function(){t(".dropdown").not(i.parents()).each((function(){t(this).removeClass("show"),t(this).children(".dropdown-menu").removeClass("show")}));var o=a.options.animations[0];if(!i.is(".disabled, :disabled")){var r=i.parent();if(!r.hasClass("show")){s&&"keydown"===s.type&&r.addClass("dropdown-key-triggered"),"ontouchstart"in document.documentElement&&r.closest(".navbar-nav").length>0&&t(document.createElement("div")).addClass("dropdown-backdrop").on("click",n).appendTo("body");var d=i.next(".dropdown-menu");switch(r.addClass("show"),r.children(".dropdown-menu").addClass("show"),i.attr("aria-expanded",!0),r.siblings().each((function(){t(a).hasClass("show")||t(a).find('[data-hover="dropdown"]').attr("aria-expanded",!1)})),a.position(d)){case"top":o=a.options.animations[2];break;case"right":o=a.options.animations[3];break;case"left":o=a.options.animations[1];break;default:o=a.options.animations[0]}d.addClass("animated "+o),function(){var o=(document.body||document.documentElement).style,t="transition";if("string"==typeof o[t])return!0;var e=["Moz","webkit","Webkit","Khtml","O","ms"];t=t.charAt(0).toUpperCase()+t.substr(1);for(var n=0;n<e.length;n++)if("string"==typeof o[e[n]+t])return!0;return!1}()&&d.hasClass("animated")?d.one("bsTransitionEnd",(function(){d.removeClass("animated "+o),s&&"keydown"===s.type&&d.trigger("focus")})).emulateTransitionEnd(e.TRANSITION_DURATION):d.removeClass("animated "+o)}}}),e.DELAY_SHOW),!1},e.prototype.hide=function(o){var n=t(o),r=n.parent();window.clearTimeout(e.TIMEOUT_SHOW),e.TIMEOUT_HIDE=window.setTimeout((function(){r.removeClass("show dropdown-key-triggered"),r.children(".dropdown-menu").removeClass("show"),n.attr("aria-expanded",!1)}),e.DELAY_HIDE)},e.prototype.position=function(o){var e=t(window);o.css({bottom:"",left:"",top:"",right:""}).removeClass("dropdownhover-top");var n={top:e.scrollTop(),left:e.scrollLeft()};n.right=n.left+e.width(),n.bottom=n.top+e.height();var r=o.offset();if(void 0===r)return i="right";r.right=r.left+o.outerWidth(),r.bottom=r.top+o.outerHeight();var a=o.position();a.right=r.left+o.outerWidth(),a.bottom=r.top+o.outerHeight();var i="";if(o.parents(".dropdown-menu").length)a.left<0?(i="left",o.removeClass("dropdownhover-right").addClass("dropdownhover-left")):(i="right",o.addClass("dropdownhover-right").removeClass("dropdownhover-left")),r.left<n.left?(i="right",o.css({left:"100%",right:"auto"}).addClass("dropdownhover-right").removeClass("dropdownhover-left")):r.right>n.right&&(i="left",o.css({left:"auto",right:"100%"}).removeClass("dropdownhover-right").addClass("dropdownhover-left")),r.bottom>n.bottom?o.css({bottom:"auto",top:-(r.bottom-n.bottom)}):r.top<n.top&&o.css({bottom:-(n.top-r.top),top:"auto"});else{var s=o.parent(".dropdown"),d=s.offset();if(d.right=d.left+s.outerWidth(),d.bottom=d.top+s.outerHeight(),r.right>n.right){var l=o.attr("style");l&&-1===l.indexOf("left: auto !important;")&&-1===l.indexOf("right: auto !important;")&&o.css({left:-(r.right-n.right),right:"auto"})}r.bottom>n.bottom&&d.top-n.top>n.bottom-d.bottom||o.position().top<0?(i="top",o.css({bottom:"100%",top:"auto"}).addClass("dropdownhover-top").removeClass("dropdownhover-bottom")):(i="bottom",o.addClass("dropdownhover-bottom"))}return i};var a=t.fn.dropdownhover;t.fn.dropdownhover=r,t.fn.dropdownhover.Constructor=e,t.fn.dropdownhover.noConflict=function(){return t.fn.dropdownhover=a,this},t((function(){t('[data-hover="dropdown"]').each((function(){var o=t(this);"ontouchstart"in document.documentElement?r.call(o,t.extend({},o.data(),{onClick:!0})):r.call(o,o.data())})),t(document).on("blur",".dropdown.dropdown-key-triggered .dropdown-item",(function(o){if(o.relatedTarget&&!t(o.relatedTarget).hasClass("dropdown-item")){var e=t(this).closest(".dropdown.dropdown-key-triggered");e.removeClass("show dropdown-key-triggered"),e.children(".dropdown-menu").removeClass("show"),e.children(".dropdown-toggle").attr("aria-expanded",!1)}})),t(document).on("mouseup",(function(){var o=t(".dropdown.dropdown-key-triggered");o.length>0&&(o.removeClass("show dropdown-key-triggered"),o.children(".dropdown-menu").removeClass("show"),o.children(".dropdown-toggle").attr("aria-expanded",!1))}))}))}(jQuery)},21:()=>{},502:()=>{},204:()=>{},783:()=>{},311:o=>{"use strict";o.exports=jQuery}},o=>{var t=t=>o(o.s=t);o.O(0,[386,613,703,938,898],(()=>(t(272),t(21),t(502),t(204),t(783))));o.O()}]);
//# sourceMappingURL=app.js.map