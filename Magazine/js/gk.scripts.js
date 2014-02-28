/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */
(function () {
    "use strict";
    jQuery.cookie = function (key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && String(value) !== "[object Object]") {
            options = jQuery.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires,
                    t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=',
                options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var result, decode = options.raw ? function (s) {
                return s;
            } : decodeURIComponent;
        return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
    };

    /**
     *
     * Template scripts
     *
     **/

    // onDOMLoadedContent event
    jQuery(document).ready(function () {
        // Back to Top Scroll
        jQuery('#gk-top-link').click(function () {
            jQuery('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        // Thickbox use
        jQuery(document).ready(function () {
            if (typeof tb_init !== "undefined") {
                tb_init('div.wp-caption a'); //pass where to apply thickbox
            }
        });
        // style area
        if (jQuery('#gk-style-area')) {
            jQuery('#gk-style-area div').each(function () {
                jQuery(this).find('a').each(function () {
                    jQuery(this).click(function (e) {
                        e.stopPropagation();
                        e.preventDefault();
                        changeStyle(jQuery(this).attr('href').replace('#', ''));
                    });
                });
            });
        }
        // font-size switcher
        if (jQuery('#gk-font-size') && jQuery('#gk-mainbody')) {
            var current_fs = 100;
            jQuery('#gk-mainbody').css('font-size', current_fs + "%");

            jQuery('#gk-increment').click(function (e) {
                e.stopPropagation();
                e.preventDefault();

                if (current_fs < 150) {
                    jQuery('#gk-mainbody').animate({
                        'font-size': (current_fs + 10) + "%"
                    }, 200);
                    current_fs += 10;
                }
            });

            jQuery('#gk-reset').click(function (e) {
                e.stopPropagation();
                e.preventDefault();

                jQuery('#gk-mainbody').animate({
                    'font-size': "100%"
                }, 200);
                current_fs = 100;
            });

            jQuery('#gk-decrement').click(function (e) {
                e.stopPropagation();
                e.preventDefault();

                if (current_fs > 70) {
                    jQuery('#gk-mainbody').animate({
                        'font-size': (current_fs - 10) + "%"
                    }, 200);
                    current_fs -= 10;
                }
            });
        }

        // Function to change styles

        function changeStyle(style) {
            var file = $GK_TMPL_URL + '/css/' + style;
            jQuery('head').append('<link rel="stylesheet" href="' + file + '" type="text/css" />');
            jQuery.cookie($GK_TMPL_NAME + '_style', style, {
                expires: 365,
                path: '/'
            });
        }

        // Responsive tables
        jQuery('article .content table').each(function (i, table) {
            table = jQuery(table);
            var heads = table.find('thead th');
            var cells = table.find('tbody td');
            var heads_amount = heads.length;
            // if there are the thead cells
            if (heads_amount) {
                var cells_len = cells.length;
                for (var j = 0; j < cells_len; j++) {
                    var head_content = jQuery(heads.get(j % heads_amount)).text();
                    jQuery(cells.get(j)).html('<span class="gk-table-label">' + head_content + '</span>' + jQuery(cells.get(j)).html());
                }
            }
        });

        // login popup
        if (jQuery('#gk-popup-login')) {
            var popup_overlay = jQuery('#gk-popup-overlay');
            popup_overlay.css({
                'opacity': '0',
                'display': 'block'
            });
            popup_overlay.fadeOut();

            var opened_popup = null;
            var popup_login = null;
            var popup_login_h = null;
            var popup_login_fx = null;

            popup_login = jQuery('#gk-popup-login');
            popup_login.css({
                'opacity': 0,
                'display': 'block'
            });
            popup_login_h = popup_login.find('.gk-popup-wrap').outerHeight();

            popup_login.animate({
                'opacity': 0,
                'height': 0
            }, 200);

            jQuery('#gk-login').click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                popup_overlay.fadeTo(200, 0.45);
                popup_login.animate({
                    'opacity': 1,
                    'height': popup_login_h
                }, 200);
                opened_popup = 'login';
            });

            popup_overlay.click(function () {
                if (opened_popup === 'login') {
                    popup_overlay.fadeOut();
                    popup_login.animate({
                        'opacity': 0,
                        'height': 0
                    }, 200);
                }
            });
        }
        // NSP nsphover suffix
        jQuery(document).find('.nsphover').each(function (i, elm) {
            elm = jQuery(elm);

            if (elm.hasClass('box')) {
                elm.find('.gk-nsp-art').each(function (i, art) {
                    art = jQuery(art);
                    var overlay = jQuery('<div class="gk-nsp-hover-overlay"></div>');
                    var info1 = jQuery(art.find('.gk-nsp-info'));
                    var info2 = jQuery(art.find('.gk-nsp-category'));

                    art.append(overlay);
                    art.find('.gk-image-link').append(art.find('.gk-nsp-header'));

                    overlay.append(art.find('.gk-nsp-header').clone());
                    overlay.append(art.find('.gk-nsp-text'));
                    overlay.append(info1);
                    overlay.prepend(info2);

                    art.mouseenter(function () {
                        overlay.addClass('active');
                    });

                    art.mouseleave(function () {
                        overlay.removeClass('active');
                    });
                });
            }
        });
        // search
        if (jQuery('#gk-search')) {
            jQuery('#gk-search').bind('touchstart', function () {
                jQuery('gk-search').toggleClass('active');
            });

            jQuery('body').bind('touchstart', function () {
                if (jQuery('#gk-search').hasClass('active')) {
                    jQuery('#gk-search').removeClass('active');
                }
            });
        }
        // style switcher
        if (jQuery('#gk-style-area')) {
            jQuery('#gk-style-area').bind('touchstart', function () {
                jQuery('#gk-style-area').toggleClass('active');
            });

            jQuery('body').bind('touchstart', function () {
                if (jQuery('#gk-style-area').hasClass('active')) {
                    jQuery('#gk-style-area').removeClass('active');
                }
            });
        }
    });

    //
    jQuery(window).load(function () {
        // check for IE8
        if (!(jQuery.browser.msie && parseInt(jQuery.browser.version, 10) <= 8)) {
            // NSP header suffix
            jQuery(document).find('.headlines').each(function (i, elm) {
                elm = jQuery(elm);

                if (elm.hasClass('box')) {
                    elm.find('.gk-nsp-art').each(function (i, art) {
                        art = jQuery(art);

                        var newWrap = jQuery('<div class="gk-nsp-new-wrap"></div>');
                        var img = jQuery(art.find('.gk-image-link img'));
                        var header = jQuery(art.find('.gk-nsp-header'));
                        var h = art.outerHeight() - parseInt(art.css('padding-top'), 10) - parseInt(art.css('padding-bottom'), 10);

                        if (img && header) {
                            newWrap.css({
                                'height': h + "px",
                                'padding-left': (img.outerWidth() + parseInt(img.css('margin-right'), 10) + parseInt(img.css('margin-left'), 10)) + "px",
                                'padding-bottom': Math.floor((h - header.outerHeight()) / 2) + "px",
                                'padding-right': '10px',
                                'padding-top': Math.floor((h - header.outerHeight()) / 2) + "px",
                                'top': parseInt(art.css('padding-top'), 10) + "px",
                                'background-position': Math.floor((img.outerWidth() - 40) / 2.0) + "px " + Math.floor(((h - 40) / 2.0) - 17) + "px"
                            });
                        } else {
                            newWrap.css({
                                'height': h + "px",
                                'padding': "10px 10px 10px 60px",
                                'top': parseInt(art.css('padding-top'), 10) + "px"
                            });
                        }

                        newWrap.css({
                            'width': art.outerWidth() + "px",
                            'right': (-1 * art.outerWidth()) + "px"
                        });

                        if (header.find('a')) {
                            newWrap.click(function () {
                                window.location = header.find('a').attr('href');
                            });
                        }

                        newWrap.append(art.find('.gk-nsp-header').clone().css('margin', '0'));
                        art.append(newWrap);

                        art.mouseenter(function () {
                            if (Math.abs(art.outerWidth() - newWrap.outerWidth()) < 10) {
                                if (!art.hasClass('active')) {
                                    art.addClass('active');
                                }
                            }
                        });

                        art.mouseleave(function () {
                            if (art.hasClass('active')) {
                                art.removeClass('active');
                            }

                            if (!art.hasClass('unactive')) {
                                art.addClass('unactive');
                                setTimeout(function () {
                                    art.removeClass('unactive');
                                }, 400);
                            }
                        });
                    });
                }
            });
        }
    });
})();