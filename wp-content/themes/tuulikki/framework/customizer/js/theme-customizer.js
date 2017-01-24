/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
 var _api=null;

(function($) {
	"use strict";

	_api=parent.wp.customize;

	/*wp.customize('ig_disable_social_footer', function(value) {
		value.bind(function(newval) {
			set_social_footer(newval);
			_api.previewer.refresh();
		});
	});*/

	wp.customize('header_single_page', function(value) {
		value.bind(function(newval) {
			set_header_single_page(newval);
			_api.previewer.refresh();
		});
	});

	set_header_single_page(_api.instance('header_single_page').get());

})(jQuery);

function set_header_single_page(newval) {
	var cdisplay="block";

	if (newval=="ig_header_big_logo") {
		cdisplay="none";
	}

	/*jQuery("#customize-control-upload_single_logo", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-size_single_logo_retina", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-single_logo_padding_top", window.parent.document).css("display",cdisplay);*/
}

/*function set_social_footer(newval) {
	//console.log("set_layout_columns:"+newval);

	var cdisplay="none";

	if (newval) {
		cdisplay="block";
	}
	jQuery("#customize-control-f_facebook", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_twitter", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_instagram", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_pinterest", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_bloglovin", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_google", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_tumblr", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_youtube", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_dribbble", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_soundcloud", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_vimeo", window.parent.document).css("display",cdisplay);
	jQuery("#customize-control-f_linkedin", window.parent.document).css("display",cdisplay);
}*/


