/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	$(document).ready( function() {	

		// Site title and description.
		wp.customize( 'blogname', function( value ) {
			value.bind( function( to ) {
				$( '.site-title a' ).text( to );
			} );
		} );
		wp.customize( 'blogdescription', function( value ) {
			value.bind( function( to ) {
				$( '.site-description' ).text( to );
			} );
		} );

		// Header text color.
		wp.customize( 'header_textcolor', function( value ) {
			value.bind( function( to ) {
				if ( 'blank' === to ) {
					$( '.site-title, .site-description' ).css( {
						'clip': 'rect(1px, 1px, 1px, 1px)',
						'position': 'absolute'
					} );
				} else {
					$( '.site-title, .site-description' ).css( {
						'clip': 'auto',
						'color': to,
						'position': 'relative'
					} );
				}
			} );
		} );

	  // Read more text
	  wp.customize( 'opal_options[post_readmore]', function( value ) {
			value.bind(function( to ) {
				$( '.more-link' ).html( to );
			});
		});

	  /// 


	var api = wp.customize;
	api.controlConstructor.WPO_Layout = api.Control.extend({
			ready: function() {
			
			var control = this;


			$(this.selector + " .page-layout" ).each( function(){
				var $select = $('select',this);
				var $val = $select.val();
				var $img = $('img.layout', this );
				if( $val ){
					$img.each( function(){
						if( $val == $(this).data('value') ){
							$(this).addClass( 'selected');
						}
					} );
				}
				$("select", this).hide();
			
				$img.each( function(){
					var $i = $(this);
					$i.click( function() {  
						$img.removeClass('selected');
						$i.addClass('selected');
						$select.val( $i.data('value') );
						$select.change();
					} );
				} );
			} );
		}
	});

} );

//
} )( jQuery );


