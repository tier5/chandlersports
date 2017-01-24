jQuery(document).ready(function($){
	
var animation_in="fadeInDown";
var animation_out="fadeOutUp";

if(window.flv_hover_in!=''){animation_in=window.flv_hover_in;}
if(window.flv_hover_out!=''){animation_out=window.flv_hover_out;}

jQuery(".flv_second_img").each(function(){
	jQuery(this).parents("li").addClass("flv-has-gallery");
	var move_to=jQuery(this).parent().prev().find("a");
	jQuery(this).appendTo(move_to);
})
jQuery( 'ul.products li.flv-has-gallery' ).hover( function() {
	
if(animation_in=="fadeIn")	{
  jQuery( this ).find(".im_br a").children( '.wp-post-image' ).removeClass( 'flv_show '+animation_in ).addClass( ' flv_hide '+animation_out );
 jQuery( this ).find(".im_br a").children( '.flv_second_img' ).removeClass( animation_out ).addClass( 'flv_show  '+animation_in );
 }else	{
  jQuery( this ).find(".im_br a").children( '.wp-post-image' ).removeClass( 'flv_show '+animation_in ).addClass( 'animated flv_hide '+animation_out );
 jQuery( this ).find(".im_br a").children( '.flv_second_img' ).removeClass( animation_out ).addClass( 'flv_show animated '+animation_in );
 }

  }, function() {
  jQuery( this ).find(".im_br a").children( '.wp-post-image' ).removeClass( 'flv_hide '+animation_out ).addClass( animation_in );
  jQuery( this ).find(".im_br a").children( '.flv_second_img' ).removeClass( 'flv_show '+animation_in ).addClass( animation_out );

  }
);


});


