<?php
    /**
     * Need to load wp-load.php so that we can use all of the
     * WordPress / WooCommerce / Subscriptions functions
     */
    $rooturl = str_replace( 'wp-content/plugins/woocommerce-gateway-sagepay-form/assets/pages/3dcomplete.php','',$_SERVER['SCRIPT_FILENAME'] );
    // Bloody windows hosting!
    $rooturl = str_replace( 'wp-content\plugins\woocommerce-gateway-sagepay-form\assets\pages\3dcomplete.php','',$rooturl );
    
    require( $rooturl . 'wp-load.php' );

    //alphanumeric unlimited length base64 encoded    
    if ( base64_decode( $_REQUEST['PARes'], true ) ) {
        $pares = $_REQUEST['PARes'];
    } else {
        $pares = "";
    }
        
    //alphanumeric max 35 chars
    if( preg_match( '/^[A-Z0-9]{1,35}$/i', $_REQUEST['MD'] ) ) {
        $md = $_REQUEST['MD'];
    } else {
        $md = "";    
    }
    
    $page = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' .
            '<html><head>' .
            '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />' .
            '<title>3D-Secure Redirect</title></head>' . 
            '<body>' .
            $pares . '<br />' .
            $md . '<br >' .
            '</body></html>';
            
    echo $page;
?>
