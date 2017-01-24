


<?php $padding = get_field('50px_in_top'); ?>
<?php $meno_top = get_field('padding_delle_sezioni'); ?>


<section class=" main_section parallax_sections <?php echo $padding; ?>  <?php echo $meno_top; ?> <?php echo get_post_type();?>-<?php the_ID();?> <?php echo (isset($bg)) ? $bg : '';?>" id="<?php echo $post->post_name;?>" style="background-image: url(<?php the_field('background_del_box_full'); ?>); background-color: <?php the_field('colore_del_box_full'); ?>;">









	<?php

// check if the flexible content field has rows of data
if( have_rows('flex_section') ):

     // loop through the rows of data
    while ( have_rows('flex_section') ) : the_row();







/*  ========================================
       FORM - MAPPA - CONTATTI
 ======================================== */

   if( get_row_layout() == 'form_-_mappa_-_contatti' ):


         echo '<div class="container">';
               echo '<div class="row">';

		             echo '<div class="col-md-4 wow bounceInLeft animated">';
                         // gravity FORM
   		               the_sub_field('campo_form');

		             echo '<div class="clear margin-20"></div> ';

		             echo '</div> <!-- end col-md-4 -->';



		             echo '<div class="col-md-4 wow bounceInRight animated">';
                         //  MAPPA







   		               the_sub_field('mappa_contatti');















		             echo '</div> <!-- end col-md-4 -->';



		             echo '<div class="col-md-4 wow bounceInRight animated">';
                         //  CONTATTI
   		               the_sub_field('campo_contatti');

		             echo '</div> <!-- end col-md-4 -->';


		       echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';




 /*  ========================================
     INDIRIZZO + TABELLA ORARI
 ======================================== */




         elseif( get_row_layout() == 'editor_+_tab_orari' ):





           echo '<div class="container">';
                echo '<div class="row">';


	                 echo '<div class="col-md-4">';



           the_sub_field('editor_per_indirizzo');




	                     echo '</div> <!-- end col-md-4 -->';


	                         echo '<div class="col-md-8">';




  $lunedi_mat = get_sub_field('lunedi_mat');
  $lunedi_pom = get_sub_field('lunedi_pom');

  $martedi_mat = get_sub_field('martedi_mat');
  $martedi_pom = get_sub_field('martedi_pom');

  $mercoledi_mat = get_sub_field('mercoledi_mat');
  $mercoledi_pom = get_sub_field('mercoledi_pom');

  $giovedi_mat = get_sub_field('giovedi_mat');
  $giovedi_pom = get_sub_field('giovedi_pom');

  $venerdi_mat = get_sub_field('venerdi_mat');
  $venerdi_pom = get_sub_field('venerdi_pom');

  $sabato_mat = get_sub_field('sabato_mat');
  $sabato_pom = get_sub_field('sabato_pom');



 echo '

<table class="table table-condensed table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th><strong class="d-color">Mattino</strong></th>
                    <th><strong class="d-color">Pomeriggio</strong></th>
                </tr>
            </thead>
            <tbody>
                                    <tr>
                        <td><strong class="d-color">Luned&igrave;
</strong></td>
                                                    <td>' . $lunedi_mat . '</td>
                            <td>' . $lunedi_pom . '</td>
                                            </tr>
                                        <tr>
                        <td><strong class="d-color">Marted&igrave;</strong></td>
                                                    <td>' . $martedi_mat . '</td>
                            <td>' . $martedi_pom . '</td>
                                            </tr>
                                        <tr>
                        <td><strong class="d-color">Mercoled&igrave;</strong></td>
                                                    <td>' . $mercoledi_mat . '</td>
                            <td>' . $mercoledi_pom . '</td>
                                            </tr>
                                        <tr>
                        <td><strong class="d-color">Gioved&igrave;</strong></td>
                                                    <td>' . $giovedi_mat . '</td>
                            <td>' . $giovedi_pom . '</td>
                                            </tr>
                                        <tr>
                        <td><strong class="d-color">Venerd&igrave;</strong></td>
                                                    <td>' . $venerdi_mat . '</td>
                            <td>' . $venerdi_pom . '</td>
                                            </tr>
                                        <tr>
                        <td><strong class="d-color">Sabato</strong></td>
                                                    <td>' . $sabato_mat . '</td>
                            <td>' . $sabato_pom . '</td>
                                            </tr>
                                        <tr>
                        <td><strong class="d-color">Domenica</strong></td>
                                                    <td>CHIUSO</td>
                            <td>CHIUSO</td>
                                            </tr>
                                </tbody>
        </table>


';













	                     echo '</div> <!-- end col-md-8 -->';





               echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';








 /*  ========================================
     OFF SET contenuto semplice
 ======================================== */




         elseif( get_row_layout() == 'off-set_contenuto' ):





           echo '<div class="container">';
                echo '<div class="row">';
	                 echo '<div class="col-md-8 col-md-offset-2  wow fadeInUp animated">';



           the_sub_field('contenuto_in_offset');




	                     echo '</div> <!-- end col-md-8 col-md-offset-2 -->';
               echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';







 /*  ========================================
     SEMPLICE CONTENUTO
 ======================================== */




         elseif( get_row_layout() == 'semplice_editor' ):





           echo '<div class="container">';
                echo '<div class="row">';
	                 echo '<div class="col-md-12">';



           the_sub_field('editor');




	                     echo '</div> <!-- end col-md-12 -->';
               echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';



		if( get_field('on_off_shodown') )
		{
		    echo '<div class="headershadow"></div>';
		}
		else
		{
		   // niente
		}






 /*  ========================================
      Shortcode revselider
 ======================================== */






        elseif( get_row_layout() == 'revslider' ):

           	$revsliderx = get_sub_field('shortcode_revselider');


		if( get_sub_field('dentro_al_contenitore') )
		{



         echo '<div class="container">';
               echo '<div class="row">';
		             echo '<div class="col-md-12">';

						echo '<section class="main_section"> ';
						           echo do_shortcode( $revsliderx );
						           /* o anche con     echo apply_filters('the_content', $revsliderx);     */
						echo '</section>';

		             echo '</div> <!-- end col-md-12 -->';
		       echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';

		}
		else
		{

		echo '  <section class="main_section"> ';
		           echo do_shortcode( $revsliderx );
		           /* o anche con     echo apply_filters('the_content', $revsliderx);     */
		echo '</section>';



		}





 /*  ========================================
      SERVIZI - Box servizi
 ======================================== */


        elseif( get_row_layout() == 'box_servizi' ):


         echo '<div class="container">';
               echo '<div class="row">';
		             echo '<div class="col-md-12">';


					        //   the_sub_field('ripetizione_box_servizio');




if( have_rows('ripetizione_box_servizio') ):
    while ( have_rows('ripetizione_box_servizio') ) : the_row();


          //   the_sub_field('ripetizione_box_servizio');
          //         has_sub_field('ripetizione_box_servizio');

				         echo '<div class="box_servizio wow bounceInUp animated">';

   		               echo '<p> ';


   		               the_sub_field('nome_servizio');

   		                 echo ' </p>';

		           echo '</div><!-- end box_servizio-->';


				   endwhile;

else :

    // no rows found

endif;


		             echo '</div> <!-- end col-md-12 -->';
		       echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';



 /*  ========================================
      SEZIONE CONTATTI
 ======================================== */

   elseif( get_row_layout() == 'sezione_contatti' ):


         echo '<div class="container">';
               echo '<div class="row">';

		             echo '<div class="col-md-8 wow bounceInLeft animated">';
                         // gravity form
   		               the_sub_field('form_editor');

		             echo '<div class="clear margin-20"></div> ';

		             echo '</div> <!-- end col-md-8 -->';


		             echo '<div class="col-md-4 wow bounceInRight animated">';

   		               the_sub_field('contatti_studio');

		             echo '</div> <!-- end col-md-4 -->';


		       echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';













 /*  ========================================
      3 BOX SPECIALIZZAZIONI
 ======================================== */

   elseif( get_row_layout() == '3_box_specializzazioni' ):


         echo '<div class="container">';
               echo '<div class="row">';




		        echo '<div class="col-md-4 wow fadeInUp animated">';
                        echo '<div class="ibox top-aligned">
					          <div class="ibox-media">

					          <span class="ibox-icon-border">
					          <i class="fa fa-graduation-cap"></i>

					          </span>

					          </div> <!-- end  ibox-media img -->';




		                        echo '<h2 class="tit_special">';
		   		                    the_sub_field('box_1_titolo');
		                        echo '</h2>';




		                        echo '<div class="textdesc" style="text-align: justify">';
		   		                    the_sub_field('box_1_contenuto');
		                        echo '</div> <!-- end  textdesc -->';


                     echo '</div>';
		        echo '</div> <!-- end col-md-4 -->';














		        echo '<div class="col-md-4 wow fadeInUp animated">';
                        echo '<div class="ibox top-aligned">
					          <div class="ibox-media">

					          <span class="ibox-icon-border">
					          <i class="fa fa-graduation-cap"></i>

					          </span>

					          </div> <!-- end  ibox-media img -->';




		                        echo '<h2 class="tit_special">';
		   		                    the_sub_field('box_2_titolo');
		                        echo '</h2>';




		                        echo '<div class="textdesc" style="text-align: justify">';
		   		                    the_sub_field('box_2_contenuto');
		                        echo '</div> <!-- end  textdesc -->';


                     echo '</div>';
		        echo '</div> <!-- end col-md-4 -->';





 /*  <span class="ibox-icon-border">
     <img src="'.get_template_directory_uri().'/diadent-images/ico-special.png">
     </span>
 */




		        echo '<div class="col-md-4 wow fadeInUp animated">';
                        echo '<div class="ibox top-aligned">
					          <div class="ibox-media">



					           <span class="ibox-icon-border">
					          <i class="fa fa-graduation-cap"></i>

					          </span>


					          </div> <!-- end  ibox-media img -->';




		                        echo '<h2 class="tit_special">';
		   		                    the_sub_field('box_3_titolo');
		                        echo '</h2>';




		                        echo '<div class="textdesc" style="text-align: justify">';
		   		                    the_sub_field('box_3_contenuto');
		                        echo '</div> <!-- end  textdesc -->';


                     echo '</div>';
		        echo '</div> <!-- end col-md-4 -->';






		       echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';



 /*  ========================================
      MAPPA
 ======================================== */

   elseif( get_row_layout() == 'mappa' ):


    //  echo '<div class="container">';
          echo '<div class="row no-margin wow fadeInUp animated hidden-phone">';





	$location = get_sub_field('mappa_studio');
	$img_marker = get_sub_field('immagine_marker');
	$desc_marker = get_sub_field('description_marker');
	$zoom = get_sub_field('zoom');
	$colore_mappa = get_sub_field('colore_mappa');

	$lat2 = get_sub_field('latitudine');
	$lon2 = get_sub_field('longitudine');
	$img_marker2 = get_sub_field('immagine_marker2');
	$desc_marker2 = get_sub_field('description_marker2');


	if( !empty($location) ):
		echo "<div id='map_canvas' class='map_canvas' style='height:400px'></div>\n";
		echo "<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true'></script>\n";
		echo "<script type='text/javascript'>\n";
		echo "jQuery(document).ready(function() {\n";
		echo "	var map;\n";
		echo "	var options = {\n";
		echo "		zoom: $zoom,\n";
		echo "		zoomControl: true, // controllo manuale zoom\n";
		echo "		scaleControl: true,// controllo manuale zoom\n";
		echo "		scrollwheel: false,// controllo mouse zoom\n";
		echo "		disableDoubleClickZoom: true,\n";
		echo "		center: new google.maps.LatLng(".$location['lat'].", ".$location['lng']."),\n";
		echo "		mapTypeId: google.maps.MapTypeId.ROADMAP\n";
		echo "	};\n";
		echo "	var map = new google.maps.Map(document.getElementById('map_canvas'), options);\n";
		echo "	var marker = new google.maps.Marker({\n";
		echo "		position: new google.maps.LatLng(".$location['lat'].", ".$location['lng']."),\n";
		echo "				map: map,\n";
		echo "				icon: '".$img_marker."'\n";
		echo "		});\n";
		echo "	var infowindow = new google.maps.InfoWindow({\n";
		echo "		content: '".$desc_marker."'\n";
		echo "	});\n";
		echo "	google.maps.event.addListener(marker, 'click', function() {\n";
		echo "		infowindow.open(map,marker);\n";
		echo "	});\n";

		if(!empty($lat2) && !empty($lon2)) {
			echo "	var marker2 = new google.maps.Marker({\n";
			echo "		position: new google.maps.LatLng(".$lat2.", ".$lon2."),\n";
			echo "				map: map,\n";
			echo "				icon: '".$img_marker2."'\n";
			echo "		});\n";
			echo "	var infowindow2 = new google.maps.InfoWindow({\n";
			echo "		content: '".$desc_marker2."'\n";
			echo "	});\n";
			echo "	google.maps.event.addListener(marker2, 'click', function() {\n";
			echo "		infowindow2.open(map,marker2);\n";
			echo "	});\n";
		}

		echo "	var styles = [{\n";
		echo "			stylers: [\n";
		echo "				{ hue: '$colore_mappa' },\n";
		echo "				{ saturation: -30 },\n";
		echo "				{ lightness: 30 }\n";
		echo "			]},{\n";
		echo "			featureType: 'road',\n";
		echo "			elementType: 'geometry',\n";
		echo "			stylers: [\n";
		echo "				{ lightness: 50 },\n";
		echo "				{ saturation: 0 },\n";
		echo "				{ visibility: 'simplified' }\n";
		echo "			]},{\n";
		echo "			featureType: 'road',\n";
		echo "			elementType: 'labels',\n";
		echo "			stylers: [\n";
		echo "			{ visibility: 'on' }\n";
		echo "			]\n";
		echo "	}];\n";
		echo "	var styledMap = new google.maps.StyledMapType(styles,{name: 'Styled Map'});\n";
		echo "	map.mapTypes.set('map_style', styledMap);\n";
		echo "	map.setMapTypeId('map_style');\n";
		echo "	});\n";
		echo "</script>\n";
	 endif;

   echo '</div><!-- end row -->';
     //   echo '</div><!-- end container -->';







 /*  ========================================
     TITLE
 ======================================== */




         elseif( get_row_layout() == 'title' ):





           echo '<div class="container">';
                echo '<div class="row">';
	                 echo '<div class="col-md-12">';



                  echo '<h3 class="home-title"><span>';

                     the_title();

                  echo '</span></h3>';



	                     echo '</div> <!-- end col-md-12 -->';
               echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';






 /*  ========================================
     SPECIAL HADING
 ======================================== */




         elseif( get_row_layout() == 'special_hading' ):





           echo '<div class="container">';
                echo '<div class="row">';
	                 echo '<div class="col-md-12">';



                  echo '<h3 class="textaligncenter">';

      the_sub_field('testo_special');

                  echo '</h3>';

 echo '<div class="separator small" style="margin-top:7px;margin-bottom:45px;"></div>';
 echo '<div class="divider solid"></div>';



	                     echo '</div> <!-- end col-md-12 -->';
               echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';





 /*  ========================================
     BANNER TEXT
 ======================================== */




         elseif( get_row_layout() == 'banner_text' ):





           echo '<div class="container">';
                echo '<div class="row">';
	                 echo '<div class="col-md-12">';




	                 echo '<div class="title_banner margin-40">';

		                 echo '<h2>';
      the_sub_field('titolone');
		                 echo '</h2>';



		                 echo '<i><h5>';
      the_sub_field('testo_italic');
		                 echo '</h5></i> ';

	                 echo '</div>';





	                     echo '</div> <!-- end col-md-12 -->';
               echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';




 /*  ========================================
      3 Box ( con colore + testo )
 ======================================== */



        elseif( get_row_layout() == '3_box_diadent' ):

          	$colorbox1 = get_sub_field('color_box_1');
          	$colorbox2 = get_sub_field('color_box_2');
          	$colorbox3 = get_sub_field('color_box_3');


           echo '<div class="container">';
                echo '<div class="row">';


	                 echo '<div class="col-md-4 padding_box three_box textaligncenter" style="background-color:' . $colorbox1 . ';">';


      the_sub_field('box_1_(_diadent_)');




 echo '<a style="margin-top:20px;" class="jumper in_absolut button_cont  button-small" href="#mappa-studio">Vedi mappa </a>';



	                 echo '</div> <!-- end col-md-4 -->';






	                 echo '<div class="col-md-4 padding_box three_box" style="background-color:' . $colorbox2 . ';">';

           the_sub_field('box_2');


 echo '<a style="margin-top:20px;" class="jumper in_absolut button_cont  button-small" href="#contatti">Prenota la tua visita</a>';

	                 echo '</div> <!-- end col-md-4 -->';






	                 echo '<div class="col-md-4 padding_box three_box" style="background-color:' . $colorbox3 . ';">';

           the_sub_field('box_3');

	                 echo '</div> <!-- end col-md-4 -->';




	              //   echo '</div><!-- end col-md-8 col-md-offset-2 -->';
               echo '</div><!-- end row -->';
         echo '</div><!-- end container -->';



        endif;








 /*  ========================================
      fine flex_section
 ======================================== */




    endwhile;

else :

    // no layouts found

endif;

?>

























</section>