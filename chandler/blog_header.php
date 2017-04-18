<?php wp_head();
?><!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
      <title>Chandilersports Blog</title>
      <!-- Bootstrap -->
      <link href="<?php bloginfo('template_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?php bloginfo('template_directory'); ?>/css/font-awesome.css" rel="stylesheet">
      <link href="<?php bloginfo('template_directory'); ?>/css/blog_style.css" rel="stylesheet">
      <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
      <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css"/>
      <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>
      <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.6.0/slick-theme.css"/>
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
<style>.slick-slide img {
    height: 300px !important;
    width: 100% !important;
}</style>
   </head>
   <body>
      <div id="wrapper">
          
          <div id="page-content-wrapper">
              <header>
                 <nav class="navbar ">
                    <div class="container-fluid1">
                    <div class="row mob-nav">
                       <div class="col-md-6 col-xs-8">
                          <div class="social-menu2">
                             <ul>
                                <li>
                                   <a href="#"><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                   <a href="#"><i class="fa fa-instagram"></i></a>
                                </li>
                                <li>
                                   <a href="#"><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                   <a href="#"><i class="fa fa-youtube-play"></i></a>
                                </li>
                                <li>
                                   <a href="#"><i class="fa fa-google-plus"></i></a>
                                </li>
                                <li>
                                   <a href="#"><i class="fa fa-envelope"></i></a>
                                </li>
                                <li>
                                   <a href="#"><i class="fa fa-search"></i></a>
                                </li>
                                
                             </ul>
                          </div>
                       </div>
                       <div class="col-md-6 col-xs-4">
                          <div class="navbar-header">
                             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                             <span class="sr-only">Toggle navigation</span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                             </button>
                             <a class="navbar-brand" href="#">Brand</a>
                          </div>
                       </div>
                    </div>
                    <div class="container-fluid">
                       <div class="logo">
                          <a href="#">
                            <img src="<?php bloginfo('template_directory'); ?>/images/logo-test-final-1.png" alt="chandlersports">
                          </a>
                       </div>
                    </div>
                    <div class="menu-part">
                       <div class="container-fluid">
                          <div class="row">
                             <div class="col-md-9 col-sm-9 full-menu">
                                <div class="menu">
                                   <div class="container-fluid">
                                      <!-- Collect the nav links, forms, and other content for toggling -->
                                      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                         <ul class="nav navbar-nav">
                                            <li class="active"><a href="<?php echo site_url()?>/blog-listing">Home <span class="sr-only">(current)</span></a></li>
                                            <li><a href="<?php echo site_url()?>/blog-listing/about">About</a></li>
                                            <li class="dropdown">
                                               <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                                               <ul class="dropdown-menu">
                                                  <?php $categories = get_terms( 'category', array(
                                                      'orderby'    => 'count',
                                                      'hide_empty' => 1,
                                                      'exclude'    => array(428,351),
                                                      
                                                  ) );
                                                  
                                                   foreach ( $categories as $term ) {
                                                    ?>
                                                    
                                                     <li>
                                                        <a href="<?php echo get_term_link($term->term_id, 'category'); ?>">
                                                              <?php echo $term->name; ?>
                                                        </a>    
                                                     </li>
                                                  
                                                   <?php }
                                                   
                                              ?> 
                                               </ul>
                                            </li>
                                            <li><a href="<?php echo site_url()?>/blog-listing/contact">Contact</a></li>
                                            <li><a href="<?php echo site_url()?>">Visit Chandlersports Store</a></li>
                                            <!-- <li><a href="#">View all product</a></li> -->
                                         </ul>
                                      </div>
                                      <!-- /.navbar-collapse -->
                                   </div>
                                   <!-- /.container-fluid -->
                                </div>
                                <!-- menu ends here -->
                             </div>
                             <div class="col-md-3 col-sm-3 social-menu">
                               <div class="row">
                                <ul>
                                   <li>
                                      <a href="https://www.instagram.com/chandler_sports/"><i class="fa fa-instagram"></i></a>
                                   </li>
                                   <li>
                                      <a href="https://www.facebook.com/chandlersports/?ref=ts"><i class="fa fa-facebook"></i></a>
                                   </li>
                                   <li>
                                      <a href="https://www.youtube.com/user/chandlersports"><i class="fa fa-youtube-play"></i></a>
                                   </li>
                                   <li>
                                      <a href="https://plus.google.com/+ChandlersportsCoUk"><i class="fa fa-google-plus"></i></a>
                                   </li>
                                   <li>
                                      <a href="#menu-toggle" id="menu-toggle"><i class="fa fa-search"></i></a>
                                   </li>
                                </ul>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </nav>
              </header>