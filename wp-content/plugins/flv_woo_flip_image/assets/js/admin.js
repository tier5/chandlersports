jQuery(document).ready(function($){
	
var flv_gallery=jQuery("#woocommerce-product-images");
jQuery("#flv_woo_flip_prod").parent().insertAfter(flv_gallery);

jQuery( "#woocommerce-product-images ul.product_images li > img" ).each(function( index ) {

var data_id=jQuery(this).parent().attr("data-attachment_id");
if(jQuery(this).attr("alt"))var data_alt=jQuery(this).attr("alt"); else var data_alt=data_id;


if(jQuery("#woo_flip_img").attr("class")==data_id || jQuery("#woo_flip_img").attr("class")==data_alt  ){ 

jQuery("#woo_flip_img").append('<option selected value="'+data_id+'">'+data_alt+'</option>');
}else{
jQuery("#woo_flip_img").append('<option value="'+data_id+'">'+data_alt+'</option>');	
}

});

});