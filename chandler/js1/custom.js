var brtimer = '';

(function ($){
    $(document).ready(function (){
        $('.widget-container li')
        .on('mouseenter', function (){
            $("> ul", $(this)).stop(false, true).removeAttr("style").slideDown(300);
        })
        .on('mouseleave', function (){
            $("> ul", $(this)).stop(true, false).slideUp(300);
        });

        $('ul#main li').on('mouseenter', function (){
            if( $(this).attr('id') == 'menu-item-9824' || $(this).attr('id') == 'menu-item-1618' ){
                $('#navigation .sub-menu').addClass('isHidden');
                $('.menu-homepage').removeClass('isHidden');
            }else if( $(this).attr('id') == 'menu-item-9802' ){
                $('#navigation .sub-menu').addClass('isHidden');
                $('.menu-commercial').removeClass('isHidden');
            }else if( $(this).attr('id') == 'menu-item-9803' ){
                $('#navigation .sub-menu').addClass('isHidden');
                $('.menu-repair').removeClass('isHidden');
            }else if( $(this).attr('id') == 'menu-item-9804' ){
                $('#navigation .sub-menu').addClass('isHidden');
                $('.menu-service').removeClass('isHidden');
            }
        });

         $('body').on('click','.show-mega-menu-on-hover', function (e){            
              e.preventDefault();              
            if( $(this).parent('li').attr('id') == 'menu-item-9824' || $(this).attr('id') == 'menu-item-1618' ){
            //    $('#navigation .sub-menu').addClass('isHidden');
                $('.menu-homepage').toggle();    
                $('.menu-service').hide();                 
                $('.menu-commercial').hide();
                $('.menu-repair').hide();
          //      $('.menu-homepage').removeClass('isHidden');

               $('html, body').animate({
               scrollTop: $('.menu-homepage').offset().top-80
               },'slow');

            }else if( $(this).parent('li').attr('id') == 'menu-item-9802' ){
                //$('#navigation .sub-menu').addClass('isHidden');
                 $('.menu-homepage').hide();    
                $('.menu-service').hide();                 
                $('.menu-commercial').toggle();
                $('.menu-repair').hide();
                //$('.menu-commercial').removeClass('isHidden');

                $('html, body').animate({
               scrollTop: $('.menu-commercial').offset().top-80
               },'slow');

            }else if( $(this).parent('li').attr('id') == 'menu-item-9803' ){
               // $('#navigation .sub-menu').addClass('isHidden');           
                 $('.menu-homepage').hide();    
                $('.menu-service').hide();                 
                $('.menu-commercial').hide();
                $('.menu-repair').toggle();
                   
                $('html, body').animate({
               scrollTop: $('.menu-repair').offset().top-80
               },'slow');
               // $('.menu-repair').removeClass('isHidden');
            }else if( $(this).parent('li').attr('id') == 'menu-item-9804' ){
               // $('#navigation .sub-menu').addClass('isHidden');

                $('.menu-homepage').hide();    
                $('.menu-service').toggle();                 
                $('.menu-commercial').hide();
                $('.menu-repair').hide();
                
                $('html, body').animate({
               scrollTop: $('.menu-service').offset().top-80
               },'slow');
               // $('.menu-service').removeClass('isHidden');
            }

            else if( $(this).parent('li').attr('id') == 'menu-item-9805' ){
               // $('#navigation .sub-menu').addClass('isHidden');
                $('.menu-homepage').hide();    
                $('.menu-service').hide();                 
                $('.menu-commercial').hide();
                $('.menu-repair').hide();
               // $('.menu-service').removeClass('isHidden');
            }
              else if( $(this).parent('li').attr('id') == 'menu-item-1618' ){
               // $('#navigation .sub-menu').addClass('isHidden');
                $('.menu-homepage').hide();     
                $('.menu-service').hide();                 
                $('.menu-commercial').hide();
                $('.menu-repair').hide();
               // $('.menu-service').removeClass('isHidden');
            }  
        });



           $('body').on('click','.show-inside-menu-on-hover', function (e){    
            //$(this).unbind("mouseenter mouseleave");        
              e.preventDefault();  
              var checkhover =  $('#checkhover').val();
              // alert('dddd');   
              if(checkhover==1)
              {  
               $(this).parent('li').children('.mega-menu').addClass('hidemenu');
             //  $(this).parent('li').children('.mega-menu').hide();  
             $('#checkhover').val(0)
              }
              else
              {       
               $(this).parent('li').children('.mega-menu').removeClass('hidemenu');
             //  $(this).parent('li').children('.mega-menu').show();
             $('#checkhover').val(1)
              }   
                //alert('dfdsfsdf');
            });






      /*   $('body').on('click', function (e){            
             $('.inside-menu').css('display','none');         
        });   */

        /* slider */

        slider_init();

        $('.br-menu-slider-wrapper').each(function (){
            menu_slider_init( $(this) );
        });

    });


    function slider_init(){
        $('.br-recent-posts-wrapper').width( $('.slide').length*300 );
        $('.br-recent-posts-wrapper .slide').addClass('vis');

        $('.br-prev').on('click', function (){
            $('.br-recent-posts-wrapper')
                .prepend( $('.br-recent-posts-wrapper').find('.slide:last') )
                .css({left:'-300px'})
                .animate({left:'0'}, 500);

            set_slider_timer(5000);
        });

        $('.br-next').on('click', function (){
            $('.br-recent-posts-wrapper').animate({left:'-300px'}, 500, function (){
                $('.br-recent-posts-wrapper')
                    .append( $(this).find('.slide:first') )
                    .css({left:'0'});
            });

            set_slider_timer(5000);
        });

        set_slider_timer(0);
    }

    function set_slider_timer(time){
        clearInterval( brtimer );
        brtimer = setTimeout( function (){
            brtimer = setInterval(function (){
                $('.br-recent-posts-wrapper').animate({left:'-300px'}, 500, function (){
                    $('.br-recent-posts-wrapper')
                        .append( $(this).find('.slide:first') )
                        .css({left:'0'});
                });
            }, 3000);
        }, time );
    }

    /** ***************************************************************** **/
    /***********************************************************************/
    /** ***************************************************************** **/

    function menu_slider_init( $obj ){
        $obj.width( $('.slide', $obj).length * $obj.parent().width() );
        $('.slide', $obj).addClass('vis');

        setInterval(function (){
            $obj.animate({left:'-'+$('.slide:first',$obj).width()+'px'}, 500, function (){
                $obj
                    .append( $(this).find('.slide:first') )
                    .css({left:'0'});
            });
        }, 3000);
    }

})(jQuery);


