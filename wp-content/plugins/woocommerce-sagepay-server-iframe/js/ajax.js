jQuery(function($) {

    var xhr;

    jQuery('form.checkout').submit(function(e) { 

        var result = true;
        var sagepay_server_iframe_checked = jQuery('#payment_method_sagepay-server-iframe').attr('checked');

        if(sagepay_server_iframe_checked != 'undefined' &&
           sagepay_server_iframe_checked == 'checked') {

            e.preventDefault();
            e.stopPropagation();
            e.returnValue = false;

            jQuery(this).addClass('processing');
            process_checkout();
            result = false;
        }
        return result;
    });

    process_checkout = function() {

        if (xhr) xhr.abort();
        
        var loader_url = woocommerce_params.plugin_url + '/assets/images/ajax-loader.gif';

        /*
        jQuery('#order_methods, #order_review').block({
            message: null, 
            overlayCSS: {
                background: '#fff url(' + loader_url + ') no-repeat center', 
                opacity: 0.6
            }
        });
        */

        var unblockWithMsg = function(msg) {
            // ADD error MSG & UNBLOCK
            jQuery('form.checkout').prepend(msg);
            jQuery('form.checkout').removeClass('processing')//.unblock(); 
        
            jQuery('html, body').animate({
                scrollTop: (jQuery('form.checkout').offset().top - 100)
            }, 1000);
        }
        
        var data = {};

        xhr = jQuery.ajax({
            type: 		'POST',
            url: 		woocommerce_params.checkout_url,
            data: 		jQuery('form.checkout').serialize(),
            dataType: 	"html",
            success: 	function( code ) {

                // REMOVE any errors or messages
                jQuery('.woocommerce_error, .woocommerce_message').remove();

                try {

	    	    code = code.replace(/<!--WC_END-->$/, '')
                    result = jQuery.parseJSON(code);	

                    if (result && result.result=='success') {
                        
                        // container element
                        var container = jQuery(sagepayServerIframe.container);

                        // add the OVERLAY if not exists
                        var overlay = jQuery('#sagepay-server-iframe-overlay');
                        if(overlay.length == 0) {
                            overlay = jQuery('<div/>');
                            jQuery(overlay).attr('id', 'sagepay-server-iframe-overlay');
                            jQuery(overlay).css({
                                'display': 'none', 
                                'position': 'absolute', 
                                'top': '0px', 
                                'left': '0px', 
                                'width': '100%', 
                                'height': container.css('height'),
                                'z-index': '99999', 
                                'background-color': '#eee'
                            });
                            container.append(overlay);
                            container.css('position', 'relative');
                        }

                        // CREATE the IFRAME and ADD it to the OVERLAY
                        var iframe = jQuery('<iframe>');
                        jQuery(iframe).attr('src', result.nexturl);
                        jQuery(iframe).attr('width', '100%');
                        jQuery(iframe).attr('height', '100%');

                        // SHOW the OVERLAY & SCROLL to it
                        jQuery(overlay).html(iframe);
                        jQuery(overlay).show();
                        window.scroll(0,0);

                        // UNBLOCK the checkout
                        //jQuery('#order_methods, #order_review').css('position', '')//.unblock();
                        //jQuery('form.checkout').removeClass('processing')//.unblock(); 
                        
                    } 
                    else { 
                        unblockWithMsg(result.messages);
                    } 
                }
                catch(err) {
                    unblockWithMsg(code + " " + err);
                }
            }
        });
    }
	
});
