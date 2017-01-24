<?php



if ( is_admin() ) {

    include_once( 'core/bulk-edit.php' );
    include_once( 'core/options-pages.php' );
    include_once( 'core/update.php' );

    if ( wpuxss_eml_enhance_media_shortcodes() ) {
        include_once( 'core/medialist.php' );
    }
}



/**
 *  wpuxss_eml_pro_admin_enqueue_scripts
 *
 *  @since    2.0
 *  @created  04/09/14
 */

add_action( 'admin_enqueue_scripts', 'wpuxss_eml_pro_admin_enqueue_scripts' );

if ( ! function_exists( 'wpuxss_eml_pro_admin_enqueue_scripts' ) ) {

    function wpuxss_eml_pro_admin_enqueue_scripts() {

        global $wpuxss_eml_version,
               $wpuxss_eml_dir,
               $current_screen;


        $media_library_mode = get_user_option( 'media_library_mode', get_current_user_id() ) ? get_user_option( 'media_library_mode', get_current_user_id() ) : 'grid';


        if ( 'upload' === $current_screen->base && 'grid' === $media_library_mode ) {

            wp_dequeue_script( 'media' );
            wp_dequeue_script( 'wpuxss-eml-media-grid-script' );
            wp_enqueue_script(
                'wpuxss-eml-pro-media-grid-script',
                $wpuxss_eml_dir . 'pro/js/eml-media-grid.js',
                array( 'wpuxss-eml-media-models-script', 'wpuxss-eml-media-views-script' ),
                $wpuxss_eml_version,
                true
            );
        }


        if ( isset( $current_screen ) &&
             ( ( 'upload' === $current_screen->base && 'list' === $media_library_mode ) ||
             ( 'media' === $current_screen->base && 'add' === $current_screen->action ) ) ) {

            wp_enqueue_media();

            if ( class_exists('acf') ) {

                add_action( 'admin_footer', 'wpuxss_eml_pro_admin_footer', 1 );
                do_action('acf/input/admin_enqueue_scripts');
            }

            wp_enqueue_script(
                'wpuxss-eml-pro-bulk-popup-script',
                $wpuxss_eml_dir . 'pro/js/eml-bulk-popup.js',
                array( 'wpuxss-eml-pro-bulk-edit-script' ),
                $wpuxss_eml_version,
                true
            );
        }


        // admin styles
        wp_enqueue_style(
            'wpuxss-eml-pro-admin-custom-style',
            $wpuxss_eml_dir . 'pro/css/eml-pro-admin.css',
            false,
            $wpuxss_eml_version,
            'all'
        );

    }
}



if ( ! function_exists( 'wpuxss_eml_pro_admin_footer' ) ) {

    function wpuxss_eml_pro_admin_footer() {

        global $wp_version;

        $acf_version = get_option('acf_version');

        if ( version_compare( $acf_version, '5.0.0', '<' ) ) {

            $l10n = apply_filters( 'acf/input/admin_l10n', array(
                'core' => array(
                    'expand_details' => __("Expand Details",'acf'),
                    'collapse_details' => __("Collapse Details",'acf')
                ),
                'validation' => array(
                    'error' => __("Validation Failed. One or more fields below are required.",'acf')
                )
            ));
        }
        else {

            $l10n = apply_filters( 'acf/input/admin_l10n', array(
                'unload'			=> __('The changes you made will be lost if you navigate away from this page','acf'),
                'expand_details' 	=> __('Expand Details','acf'),
                'collapse_details' 	=> __('Collapse Details','acf'),
            ));
        }

        $o = array(
            'post_id'		=> 0,
            'nonce'			=> wp_create_nonce( 'acf_nonce' ),
            'admin_url'		=> admin_url(),
            'ajaxurl'		=> admin_url( 'admin-ajax.php' ),
            'ajax'			=> 0,
            'validation'	=> 1,
            'wp_version'	=> $wp_version,
        );

        ?>
        <script type="text/javascript">
        (function($) {

            acf.o = <?php echo json_encode( $o ); ?>;
            acf.l10n = <?php echo json_encode( $l10n ); ?>;

        })(jQuery);
        </script>
        <?php
    }
}



/**
 *  wpuxss_eml_pro_enqueue_media
 *
 *  @since    2.0
 *  @created 04/09/14
 */

add_action( 'wp_enqueue_media', 'wpuxss_eml_pro_enqueue_media' );

if ( ! function_exists( 'wpuxss_eml_pro_enqueue_media' ) ) {

    function wpuxss_eml_pro_enqueue_media() {

        global $wpuxss_eml_version,
               $wpuxss_eml_dir;


        if ( ! is_admin() ) {
            return;
        }


        wp_enqueue_script(
            'wpuxss-eml-pro-bulk-edit-script',
            $wpuxss_eml_dir . 'pro/js/eml-bulk-edit.js',
            array( 'wpuxss-eml-media-models-script', 'wpuxss-eml-media-views-script' ),
            $wpuxss_eml_version,
            true
        );

        $bulk_edit_l10n = array(
            'toolTip_all' => __( 'ALL files belong to this item', 'eml' ),
            'toolTip_some' => __( 'SOME files belong to this item', 'eml' ),
            'toolTip_none' => __( 'NO files belong to this item', 'eml' ),
            'saveButton_success' => __( 'Changes saved.', 'eml' ),
            'saveButton_failure' => __( 'Something went wrong.', 'eml' ),
            'saveButton_text' => __( 'Save Changes', 'eml' ),
            'media_new_close' => __( 'Close', 'eml' ),
            'media_new_title' => __( 'Edit Media Files', 'eml' ),
            'media_new_button' => __( 'Bulk Edit', 'eml' ),

            'bulk_edit_nonce' => wp_create_nonce( 'eml-bulk-edit-nonce' ),
            'bulk_edit_save_button_off' => get_option('wpuxss_eml_pro_bulkedit_savebutton_off'),
        );

        wp_localize_script(
            'wpuxss-eml-pro-bulk-edit-script',
            'wpuxss_eml_pro_bulk_edit_l10n',
            $bulk_edit_l10n
        );


        if ( wpuxss_eml_enhance_media_shortcodes() ) {

            wp_enqueue_script(
                'wpuxss-eml-pro-enhanced-medialist-script',
                $wpuxss_eml_dir . 'pro/js/eml-enhanced-medialist.js',
                array( 'wpuxss-eml-enhanced-medialist-script' ),
                $wpuxss_eml_version,
                true
            );

            $enhanced_medialist_l10n = array(
                'createNewGallery'  => __( 'Create a filter-based gallery', 'eml' ),
                'createNewPlaylist'  => __( 'Create a filter-based playlist', 'eml' ),
                'createNewVideoPlaylist'  => __( 'Create a filter-based video playlist', 'eml' )
            );

            wp_localize_script(
                'wpuxss-eml-pro-enhanced-medialist-script',
                'wpuxss_eml_pro_enhanced_medialist_l10n',
                $enhanced_medialist_l10n
            );
        }
    }
}



/**
 *  wpuxss_eml_pro_on_activation
 *
 *  @since    2.0
 *  @created 14/11/14
 */

if ( ! function_exists( 'wpuxss_eml_pro_on_activation' ) ) {

    function wpuxss_eml_pro_on_activation() {

        wpuxss_eml_pro_on_both_active();

        // actualize all upgrade admin messages
        // pre_set_site_transient_update_plugins filter gets the correct info
        $site_transient = get_site_transient('update_plugins');
        set_site_transient( 'update_plugins', $site_transient );
    }
}



/**
 *  wpuxss_eml_pro_on_both_active
 *
 *  @since    2.0.4
 *  @created 28/12/15
 */

add_action( 'admin_init', 'wpuxss_eml_pro_on_both_active' );

if ( ! function_exists( 'wpuxss_eml_pro_on_both_active' ) ) {

    function wpuxss_eml_pro_on_both_active() {

        $all_eml_plugins = wpuxss_eml_preg_grep_keys( '/enhanced-media-library/i', get_plugins() );

        if ( count( $all_eml_plugins ) <= 1 )
            return;

        $old_free_eml = array_filter( $all_eml_plugins, 'wpuxss_eml_old_free_eml' );

        $network_active = count( preg_grep( '/enhanced-media-library/i', array_keys( (array) get_site_option( 'active_sitewide_plugins', array() ) ) ) );

        $active = count( preg_grep( '/enhanced-media-library/i', (array) get_option( 'active_plugins', array() ) ) );

        if ( count( $old_free_eml ) ) {

            $action = isset( $_REQUEST['action'] ) ? $_REQUEST['action'] : '';

            if ( 'activate' == $action || 'activate-selected' == $action ) {

                $free_basename = key( $old_free_eml );
                $pro_basename = wpuxss_get_eml_basename();

                $plugins = ( 'activate' == $action ? array( $_REQUEST['plugin'] ) : ( 'activate-selected' == $action ? (array) $_REQUEST['checked'] : array() ) );

                if ( ! empty( $plugins ) && ( $active || $network_active ) &&
                   ( in_array( $free_basename, $plugins ) || in_array( $pro_basename, $plugins ) ) ) {

                    wp_die( __('Please deactivate and <strong>remove</strong> the old FREE version prior to the <strong>Enhanced Media Library PRO</strong> activation. All your data will remain intact.', 'eml') . '<br /><br /><a href="' . admin_url( 'plugins.php' ) . '">&laquo; ' . __('Return to Plugins', 'eml') . '</a>' );
                }
            }
            return;
        }


        if ( is_network_admin() && $network_active > 1 ) {
            add_action( 'network_admin_notices', 'wpuxss_eml_pro_prevent_both_network_active_notice' );
            return;
        }

        if ( is_multisite() && ( $active + $network_active ) > 1 ) {
            add_action( 'admin_notices', 'wpuxss_eml_pro_prevent_one_network_active_notice' );
            return;
        }

        if ( $active > 1 ) {
            add_action( 'admin_notices', 'wpuxss_eml_pro_prevent_both_active_notice' );
            return;
        }
    }
}

if ( ! function_exists( 'wpuxss_eml_old_free_eml' ) ) {

    function wpuxss_eml_old_free_eml( $eml ) {
        return version_compare( $eml['Version'], '2.0.4', '<' );
    }
}

if ( ! function_exists( 'wpuxss_eml_preg_grep_keys' ) ) {

    function wpuxss_eml_preg_grep_keys( $pattern, $input, $flags = 0 ) {
        return array_intersect_key( $input, array_flip( preg_grep( $pattern, array_keys( $input ), $flags ) ) );
    }
}



/**
 *  wpuxss_eml_pro_prevent_both_network_active_notice
 *
 *  @since    2.1
 *  @created 05/11/15
 */

if ( ! function_exists( 'wpuxss_eml_pro_prevent_both_network_active_notice' ) ) {

    function wpuxss_eml_pro_prevent_both_network_active_notice() {

        echo '<div class="updated eml-admin-notice"><p>' . __( 'Both FREE and PRO versions of the Enhanced Media Library are network active. <strong>Enhanced Media Library PRO</strong> does not require free version to be active. Please network deactivate and delete the free versions of the plugin. All your data will remail intact.', 'eml' ) . '</p></div>';
    }
}



/**
 *  wpuxss_eml_pro_prevent_both_active_notice
 *
 *  @since    2.1
 *  @created 05/11/15
 */

if ( ! function_exists( 'wpuxss_eml_pro_prevent_both_active_notice' ) ) {

    function wpuxss_eml_pro_prevent_both_active_notice() {

        echo '<div class="updated eml-admin-notice"><p>' . __( '<strong>Enhanced Media Library PRO</strong> does not require free version to be active. Please deactivate and delete the free version of the plugin. All your data will remain intact.', 'eml' ) . '</p></div>';
    }
}



/**
 *  wpuxss_eml_pro_prevent_one_network_active_notice
 *
 *  @since    2.1
 *  @created 05/11/15
 */

if ( ! function_exists( 'wpuxss_eml_pro_prevent_one_network_active_notice' ) ) {

    function wpuxss_eml_pro_prevent_one_network_active_notice() {
        echo '<div class="updated eml-admin-notice"><p>' . __( 'Both FREE and PRO versions of the Enhanced Media Library are active for this site. <strong>Enhanced Media Library PRO</strong> does not require free version to be active. Please deactivate (or network deactivate) and delete the free version of the plugin for this site. All your data will remail intact.', 'eml' ) . '</p></div>';
    }
}

?>
