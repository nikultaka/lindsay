jQuery( document ).ready( function( $ ) {

	"use strict";

	/* START */

	/* Scroll to top */
	$('.btn-to-top').on( 'click', function() {

		$('html, body').animate( { scrollTop: 0 }, 500 );
		return false;

	} );

	/* Detect Browser */
	var chrome   = navigator.userAgent.indexOf( 'Chrome' ) > -1;
	var explorer = navigator.userAgent.indexOf( 'MSIE' ) > -1;
	var firefox  = navigator.userAgent.indexOf( 'Firefox' ) > -1;
	var safari   = navigator.userAgent.indexOf( 'Safari' ) > -1;
	var opera    = navigator.userAgent.toLowerCase().indexOf( 'op' ) > -1;
	if ( chrome && safari ) { safari = false; }
	if ( chrome && opera ) { chrome = false; }
	/* */

	/* Add extra style for Cats/Tags widget and share icons */
	if ( chrome || opera ) {

		$( '.share-icon-outer a' ).css( 'line-height', '18px' );

	} else {

		$( '.share-icon-outer a' ).css( 'line-height', '16px' );
		$( '.wp-tag-cloud li' ).css( 'line-height', '16px' );
		$( '.wp-tag-cloud li' ).css( 'height', '19px' );

	}
	/* */

	/* Fitvids */
	$('.bxslider-vid').fitVids();
	/* */

	/* Added to avoid iframe confuse on Chrome, Safari and Opera */
	$('iframe').each( function() {

        this.src = this.src;

    } );
	/* */

	/* MailChimp Label Class */
	$( '.mc4wp-checkbox-wp-comment-form' ).addClass( 'brnhmbx-font-3 fs14' );
	/* */

	/* Search */
	// WP Search box focus
	var brnhmbx_bourz_searchDefaultVal = $('#s').val();

	$('.search-box').on( 'focus', function() {

		if ( $(this).val() == brnhmbx_bourz_searchDefaultVal ) {

			$(this).val('');

		}

	} );

	$('.search-box').on( 'focusout', function() {

		if ( $(this).val() == '' ) {

			$(this).val(brnhmbx_bourz_searchDefaultVal);

		}

	} );

	// Custom Search box focus
	var brnhmbx_bourz_searchDefaultVal_custom = $('#s_custom').val();

	$('.search-widget-input').on( 'focus', function() {

		if ( $(this).val() == brnhmbx_bourz_searchDefaultVal_custom ) {

			$(this).val('');

		}

	} );

	$('.search-widget-input').on( 'focusout', function() {

		if ( $(this).val() == '' ) {

			$(this).val(brnhmbx_bourz_searchDefaultVal_custom);

		}

	} );

	$('.search-widget-s-icon').on( 'click', function() {

		window.location = $('#siteUrl').html() + '/?s=' + $(this).parent().find('.search-widget-input').val();

	} );
	/* */

	/* Top Search */
	var searchOpenBO = true;
	var brnhmbx_bourz_top_search_container = $( '.top-search' );

	// Top Search Button
	if ( Modernizr.touch ) {

		$( '.brnhmbx-top-search-button' ).on( 'click', function() {

			$( '#site-menu' ).slicknav( 'close' );

			if ( searchOpenBO ) {

				searchOpenBO = false;
				brnhmbx_bourz_top_search_container.css( 'display', 'none' );

			} else {

				searchOpenBO = true;
				brnhmbx_bourz_top_search_container.css( 'display', 'block' );

			}

		} );

	} else {

		jQuery( '.brnhmbx-top-search-button' ).on( 'hover', function() {

			searchOpenBO = true;
			brnhmbx_bourz_top_search_container.css( 'display', 'block' );

		} );

	}

	// Top Search Box Focus
	var brnhmbx_bourz_topSearchDefaultVal_custom = $( '#s_top' ).val();

	$( '.top-search-input' ).on( 'focus', function() {

		if ( $( this ).val() == brnhmbx_bourz_topSearchDefaultVal_custom ) {

			$( this ).val( '' );

		}

	} );

	$( '.top-search-input' ).on( 'focusout', function() {

		if ( $( this ).val() == '' ) {

			$( this ).val( brnhmbx_bourz_topSearchDefaultVal_custom );

		}

	} );

	$( '.top-search-input' ).on( 'keyup', function( event ) {

		if ( event.which == 13 ) {
			//ENTER
			window.location = $( '#siteUrl' ).html() + '/?s=' + $( this ).val();
		}

	} );
	/* */

	/* Menu Button */
	$( '.brnhmbx-menu-button' ).on( 'click', function() {

		$( '#site-menu' ).slicknav( 'toggle' );
		searchOpenBO = false;
		brnhmbx_bourz_top_search_container.css( 'display', 'none' );

	} );
	/* */

	/* Body Mouse Move */
	$( 'body' ).on( 'mousemove', function( event ) {

		if ( searchOpenBO && brnhmbx_bourz_top_search_container.width() ) {

			if ( event.pageX >= $( '.brnhmbx-top-search-button' ).offset().left + 40 || event.pageX < $( '.brnhmbx-top-search-button' ).offset().left - 300 || event.pageY >= $( '.brnhmbx-top-search-button' ).offset().top + 40 || event.pageY < $( '.brnhmbx-top-search-button' ).offset().top - 40 ) {

				brnhmbx_bourz_top_search_container.css( 'display', 'none' );
				searchOpenBO = false;

			}

		} else {

			brnhmbx_bourz_top_search_container.css( 'display', 'none' );
			searchOpenBO = false;

		}

	} );

	function mouseWithin( bounds, x, y ) {

		var offset = bounds.offset();
		var l = offset.left;
		var t = offset.top;
		var h = bounds.height();
		var w = bounds.width();

		var maxx = l + w;
		var maxy = t + h;

		return (y <= maxy && y >= t) && (x <= maxx && x >= l);

	};
	/* */

	/* Apply Slicknav */
	var slicknav_apl = true;
	var slicknav_apl_check = Number( $( '#slicknav_apl' ).html() );
	if ( !slicknav_apl_check ) { slicknav_apl = false; }

	$( '#site-menu' ).slicknav( {

		label: '',
		prependTo: '#touch-menu',
		allowParentLinks: slicknav_apl,
		closedSymbol: '<i class="fa fa-angle-right" style="font-size: 16px;"></i>',
		openedSymbol: '<i class="fa fa-angle-down" style="font-size: 16px;"></i>',
		init: brnhmbx_bourz_appendSocialIcons,
		open: brnhmbx_bourz_showSocialIcons

	} );
	/* */

	/* Append social icons to Slicknav */
	function brnhmbx_bourz_appendSocialIcons() {

		if ( $('.header-social').html() != 'undefined' && $('.header-social').html() != undefined && $('.header-social').html() != '' ) {

			$('#touch-menu .slicknav_menu').append( '<div class="social-accounts-touch">' + $('.header-social').html() + '</div>' );
			$('.social-accounts-touch').hide();

		}

		if ( $('.header-menu-outer').html() != 'undefined' && $('.header-menu-outer').html() != undefined && $('.header-menu-outer').html() != '' && $('.header-menu-outer .assign-menu').html() != 'Please assign a menu.' ) {

			$('#touch-menu .slicknav_menu').append( '<div class="header-menu-touch clearfix">' + $('.header-menu-outer').html() + '</div>' );
			$('.header-menu-touch').hide();

		}

	}

	$('.brnhmbx-menu-button').on( 'click', function() {

		$('.social-accounts-touch, .header-menu-touch').hide();

	} );

	function brnhmbx_bourz_showSocialIcons() {

		$('.social-accounts-touch, .header-menu-touch').show();

	}
	/* */

	/* Spot Messages */
	var spotMessages = new Array();
	var smInt = new Number();
	var smOrder = new Number();
	var smLength = new Number();
	$( '.spot-messages' ).children().each( function ( i ) { spotMessages.push( $( this ) ); } );
	setSpotMessageLength();

	function setSpotMessageLength() {

		spotMessages.forEach( function( i ) {

			if ( i.text() != '' ) {

				smLength += 1;

			}

		} );

		if ( smLength > 0 ) {

			switchSpotMessage();

			if ( smLength > 1 ) {

				smInt = setInterval( switchSpotMessage, Number( $( '#spot-duration' ).text() ) );

			}

		}

	}

	function switchSpotMessage() {

		spotMessages.forEach( function( i ) { i.css( 'display', 'none' ); } );

		if ( !Modernizr.touch ) {

			spotMessages[ smOrder ].show().css( 'display', 'inline' ).addClass( 'animated fadeInDown' );

		} else {

			spotMessages[ smOrder ].show().css( 'display', 'inline' );

		}

		if ( smOrder == smLength - 1 ) {

			smOrder = 0;

		} else {

			smOrder += 1;

		}

	}
	/* */

	/* Woo Commerce */
	$('.search-widget-s-pro-icon').on( 'click', function() {

		window.location = $('#siteUrl').html() + '/?s=' + $(this).parent().find('.search-widget-input').val() + '&post_type=product';

	} );

	$('.checkout_coupon').find('#coupon_code').attr( 'placeholder', '' );

	if ( $('.brnhmbx-wc-outer').find('div.term-description').text() == '' ) {

		$('.brnhmbx-wc-outer').find('.page-title').after( $('#woo-border').html() );

	} else {

		$('.brnhmbx-wc-outer').find('div.term-description').after( $('#woo-border').html() );

	}
	/* */

	/* Sticky Menu Trigger */
	$( window ).on( 'scroll', function() {

		if ( $(this).scrollTop() > $( '#trigger-sticky-value' ).html() ) {

			$( '#sticky-menu' ).addClass( 'menu-sticky' );

		} else {

			$( '#sticky-menu' ).removeClass( 'menu-sticky' );

		}

	} );
	/* */

	/* Instagram Slider Widget - Text Position */
	function brnhmbx_bourz_instagram() {

		if ( $( 'footer .jr-insta-thumb' ).width() > 0 ) {

			$( '.instagram-label' ).offset( { top: $( 'footer .jr-insta-thumb' ).offset().top + ( $( 'footer .jr-insta-thumb' ).height() / 2 ) - ( $( '.instagram-label' ).outerHeight() / 2 ), left: ( $( window ).width() / 2 ) - ( $( '.instagram-label' ).outerWidth() / 2 ) } );
			$( '.instagram-label' ).css( 'opacity', 1 );

		}

	}
	setTimeout( brnhmbx_bourz_instagram, 5000 );
	/* */

	function brnhmbxResizing() {

		if( $( window ).width() <= 960 ) {

			brnhmbx_bourz_top_search_container.css( 'display', 'none' );
			searchOpenBO = false;

		}

		brnhmbx_bourz_instagram();

	}

	$( window ).on( 'resize', brnhmbxResizing );

	/* END */

} );
