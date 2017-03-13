/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

(function($){
	"use strict";
	// init Plugin
	$.fn.WPO_ThemeCustomize = function(opts) {
	 	/**
	 	 * initialize every element
	 	 */
	 	var config = $.extend({}, {
	 		customizeURL : '',
	 		templateURL : ''
		}, opts);

		var output='';

	 	function iframe_ready(){
	 		$('#wpo-customize .panelbutton').toggle(function() {
	 			$('#wpo-customize').addClass('active');
	 		}, function() {
	 			$('#wpo-customize').removeClass('active');
	 		});
	 		$('#wpo-customize .wrapper').css('height', $('#wpo-customize').height());
	 		$(window).resize(function(event) {
	 			$('#wpo-customize .wrapper').css('height', $('#wpo-customize').height());
	 		});
	 		$('#wpo-customize-skill').change(function(event) {
	 			var link = config.templateURL+'/css/'+$(this).val();
	 			$('#base-template-css').attr('href',link);
	 		});

	 		/**
			 * BACKGROUND-IMAGE SELECTION
			 */
			$(".background-images").each( function(){
				var $parent = this;
				var $input  = $(".input-setting", $parent );
				$(".bi-wrapper > div",this).click( function(){

					 $input.val( $(this).data('val') );
					 $('.bi-wrapper > div', $parent).removeClass('active');
					 $(this).addClass('active');
					 if( $input.data('selector') ){
						//$($input.data('selector')).css( $input.data('attrs'),'url('+ $(this).data('image') +')' );
						setStyle();
					 }
				} );
			});

			$(".clear-bg").click( function(){

				var $parent = $(this).parent();
				var $input  = $(".input-setting", $parent );

				if( $input.val('') ) {
					if( $parent.hasClass("background-images") ) {
						$('.bi-wrapper > div',$parent).removeClass('active');
						$($input.data('selector')).css( $input.data('attrs'),'none' );
					}else {
						$input.attr( 'style','' )
					}
					//$($input.data('selector')).css( $input.data('attrs'),'inherit' );
					setStyle();
				}
				$input.val('');
				return false;

			} );

			function setStyle(){
		 		var _iframe = $("html");
		 		if( _iframe.find('style#custom-style').length>0){
		 			_iframe.find('style#custom-style').remove();
		 		}
		 		output = '<style id="custom-style">';
	 			$('.accordion-group input.input-setting').each(function() {
	 				if($(this).val()!='' && $(this).hasClass('enable') ){
	 					output+=$(this).data('selector')+"{\n"+$(this).data('attrs')+":#"+$(this).val()+";}\n";
	 				}
	 			});
	 			$('.bi-wrapper').each(function(){
	 				var bg = $(this).find('>div.active');
	 				if(bg.length>0){
	 					var parent = bg.parent().parent().find('.input-setting');
	 					output+=parent.data('selector')+"{\n"+parent.data('attrs')+":url('"+bg.data('image')+"');}\n";
	 				}
	 			});
		 		output+='</style>';
		 		_iframe.find('head').append(output);
		 	}

			$('.accordion-group input.input-setting').each( function(){
			 	 var input = this;
			 	 $(input).attr('readonly','readonly');
			 	 $(input).ColorPicker({
			 	 	onChange:function (hsb, hex, rgb) {

			 	 		$(input).css('backgroundColor', '#' + hex);
			 	 		$(input).val( hex );
			 	 		if( $(input).data('selector') ){
							setStyle();
						}
			 	 	}
			 	 });
		 	} );

		 	$('.accordion-group select.input-setting').change( function(){
				var input = this;
					if( $(input).data('selector') ){
					var ex = $(input).data('attrs')=='font-size'?'px':"";
					$("html").find($(input).data('selector')).css( $(input).data('attrs'), $(input).val() + ex);
				}
			} );
	 	}

	 	function resetInput(){
	 		$('.input-setting').val('').attr('style','');
	 	}

		this.each(function() {
			iframe_ready();
		});
		return this;
	};

})(jQuery);
