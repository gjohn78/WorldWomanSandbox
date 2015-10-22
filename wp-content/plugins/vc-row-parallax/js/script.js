jQuery(document).ready(function($) {
	"use strict";


	/*
	 * SMOOTH SCROLL
	 */


    if ( $('.gambit_parallax_enable_smooth_scroll').length > 0 ) {
        if ( typeof $.easing.easeOutQuint === 'undefined' ) {
            $.extend(jQuery.easing, {
                easeOutQuint: function(x, t, b, c, d) {
                    return c * ((t = t / d - 1) * t * t * t * t + 1) + b;
                }
            });
        }

        var wheel = false,
            $docH = $(document).height() - $(window).height(),
            $scrollTop = $(window).scrollTop();

        $(window).bind('scroll', function() {
            if (wheel === false) {
                $scrollTop = $(this).scrollTop();
            }
        });
        $(document).bind('DOMMouseScroll mousewheel', function(e, delta) {
            delta = delta || -e.originalEvent.detail / 3 || e.originalEvent.wheelDelta / 120;
            wheel = true;

            $scrollTop = Math.min($docH, Math.max(0, parseInt($scrollTop - delta * 120)));
            $(navigator.userAgent.indexOf('AppleWebKit') !== -1 ? 'body' : 'html').stop().animate({
                scrollTop: $scrollTop + 'px'
            }, 1600, 'easeOutQuint', function() {
                wheel = false;
            });
            return false;
        });
    }


	/*
	 * Initialize Rowspans
	 */


	$('div.bg-parallax').each(function() {
		if ( typeof $(this).attr('data-row-span') === 'undefined' ) {
			return;
		}
		var rowSpan = parseInt( $(this).attr('data-row-span') );
		if ( isNaN( rowSpan ) ) {
			return;
		}
		if ( rowSpan === 0 ) {
			return;
		}

		var $nextRows = $(this).nextAll('.wpb_row');
		$nextRows.splice(0,1);
		$nextRows.splice(rowSpan);

		// Clear stylings for the next rows that our parallax will occupy
		$nextRows.each(function() {
			if ( $(this).prev().is('.bg-parallax') ) {
				$(this).prev().remove();
			}
			// we need to apply this class to make the row children visible
			$(this).addClass('bg-parallax-parent')
			// we need to clear the row background to make the parallax visible
			.css( {
				'backgroundImage': '',
				'backgroundColor': 'transparent'
			} );

            var otherStyles = '';
            if ( typeof $(this).attr('style') !== 'undefined' ) {
                otherStyles = $(this).attr('style') + ';';
            }

            // Fix for VC adding !important styles that we can't override
            $(this).attr('style', otherStyles + 'background-image: none !important; background-color: transparent !important;');
		});
	});


	/*
	 * Initialize parallax
	 */


	$('div.bg-parallax').each(function() {
		var $row = $(this).next();
		if ( $row.css( 'backgroundSize' ) === 'contain' ) {
			$row.css( 'backgroundSize', 'cover' );
		}
		$(this).css( {
			'backgroundImage': $row.css( 'backgroundImage' ),
			'backgroundRepeat': $row.css( 'backgroundRepeat' ),
			'backgroundSize': $row.css( 'backgroundSize' ),
            'backgroundColor': $row.css( 'backgroundColor' )
		} )
		.prependTo( $row.addClass('bg-parallax-parent') )
		.scrolly2().trigger('scroll');
		$row.css( {
			'backgroundImage': '',
			'backgroundRepeat': '',
			'backgroundSize': '',
			'backgroundColor': ''
		});

        var otherRowStyles = '';
        if ( typeof $row.attr('style') !== 'undefined' ) {
            otherRowStyles = $row.attr('style') + ';';
        }

        // Fix for VC adding !important styles that we can't override
        $row.attr('style', otherRowStyles + 'background-image: none !important; background-color: transparent !important;');

		if ( $(this).attr('data-direction') === 'up' || $(this).attr('data-direction') === 'down' ) {
			$(this).css( 'backgroundAttachment', 'fixed' );
		}
	});


	$(window).resize( function() {
		setTimeout( function() {
			var $ = jQuery;
		// Break container
		$('div.bg-parallax').each(function() {
			if ( typeof $(this).attr('data-break-parents') === 'undefined' ) {
				return;
			}
			var breakNum = parseInt( $(this).attr('data-break-parents') );
			if ( isNaN( breakNum ) ) {
				return;
			}

			var $immediateParent = $(this).parent();

			// Find the parent we're breaking away to
			var $parent = $immediateParent;
			for ( var i = 0; i < breakNum; i++ ) {
				if ( $parent.is('html') ) {
					break;
				}
				$parent = $parent.parent();
			}

			// Compute dimensions & location
			var parentWidth = $parent.width() +
				              parseInt( $parent.css('paddingLeft') ) +
				              parseInt( $parent.css('paddingRight') );
			var left = - ( $immediateParent.offset().left - $parent.offset().left );
			if ( left > 0 ) {
				left = 0;
			}

			$(this).addClass('broke-out')
			.css({
				'width': parentWidth,
				'left': left
			})
			.parent().addClass('broke-out');
		});


		/*
		 * multiple rows
		 */


		$('div.bg-parallax').each(function() {
			if ( typeof $(this).attr('data-row-span') === 'undefined' ) {
				return;
			}
			var rowSpan = parseInt( $(this).attr('data-row-span') );
			if ( isNaN( rowSpan ) ) {
				return;
			}
			if ( rowSpan === 0 ) {
				return;
			}

            var $current = $(this).parent('.wpb_row');

			var $nextRows = $(this).parent('.wpb_row').nextAll('.wpb_row');
			$nextRows.splice(rowSpan);

			// Clear stylings for the next rows that our parallax will occupy
			var heightToAdd = 0;
            heightToAdd += parseInt($current.css('marginBottom'));
			$nextRows.each(function() {
				heightToAdd += $(this).height() +
					           parseInt($(this).css('paddingTop')) +
					           parseInt($(this).css('paddingBottom')) +
					           parseInt($(this).css('marginTop'));
			});
			$(this).css( 'height', 'calc(100% + ' + heightToAdd + 'px)' );
		});

		$(document).trigger('scroll');
		}, 1 );
	});

	jQuery(window).trigger('resize');
});