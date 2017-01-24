<?php



/**
 *  wpuxss_eml_pro_on_admin_init
 *
 *  @since    2.0
 *  @created  01/10/14
 */

add_action( 'admin_init', 'wpuxss_eml_pro_on_admin_init' );

function wpuxss_eml_pro_on_admin_init() {

    // plugin settings: bulk edit
    register_setting(
        'wpuxss_eml_taxonomies', //option_group
        'wpuxss_eml_pro_bulkedit_savebutton_off', //option_name
        'wpuxss_eml_pro_bulkedit_savebutton_off_validate'
    );

    // plugin settings: updates
    register_setting(
        'wpuxss_eml_pro_updates', //option_group
        'wpuxss_eml_pro_license_key', //option_name
        'wpuxss_eml_pro_license_key_validate'
    );
}



/**
 *  wpuxss_eml_pro_bulkedit_savebutton_off_validate
 *
 *  @type     callback function
 *  @since    2.0
 *  @created  01/10/14
 */

if ( ! function_exists( 'wpuxss_eml_pro_bulkedit_savebutton_off_validate' ) ) {

    function wpuxss_eml_pro_bulkedit_savebutton_off_validate( $input ) {

        $input = isset( $input ) && !! $input ? 1 : 0;

        return $input;
    }
}



/**
 *  wpuxss_eml_pro_license_key_validate
 *
 *  @type     callback function
 *  @since    2.0
 *  @created  13/10/14
 */

if ( ! function_exists( 'wpuxss_eml_pro_license_key_validate' ) ) {

    function wpuxss_eml_pro_license_key_validate( $input ) {

        if ( empty( $input ) ) {

            if ( isset( $_POST['eml-license-deactivate'] ) ) {

                add_settings_error(
                    'wpuxss_eml_pro_updates',
                    'eml_license_deactivated',
                    __( 'Your license has been deactivated.', 'eml' ),
                    'updated'
                );
            }

            if ( isset( $_POST['eml-license-activate'] ) ) {

                add_settings_error(
                    'wpuxss_eml_pro_updates',
                    'eml_empty_license',
                    __( 'Please check if your license key is correct and try again.', 'eml' ),
                    'error'
                );
            }

            return $input;
        }

        if ( ! wpuxss_eml_pro_remote_info( 'is-license-active', $input ) )  {

            add_settings_error(
                'wpuxss_eml_pro_updates',
                'eml_wrong_license',
                __('Wrong license key or a server error occured. Please check your license key and try again.', 'eml'),
                'error'
            );

            return '';
        }

        add_settings_error(
            'wpuxss_eml_pro_updates',
            'eml_license_activated',
            __('You license has been activated.', 'eml'),
            'updated'
        );

        return $input;
    }
}



/**
 *  wpuxss_eml_pro_update_transient_on_license_key_update
 *
 *  @since    2.1.5
 *  @created  13/01/16
 */

add_action( 'update_option_wpuxss_eml_pro_license_key', 'wpuxss_eml_pro_update_transient_on_license_key_update', 10, 2 );

if ( ! function_exists( 'wpuxss_eml_pro_update_transient_on_license_key_update' ) ) {

    function wpuxss_eml_pro_update_transient_on_license_key_update( $old_value, $license_key ) {

        if ( $old_value === $license_key ) {
            return;
        }

        $wpuxss_eml_pro_basename = wpuxss_get_eml_basename();
        $transient = get_site_transient( 'update_plugins' );

        set_site_transient( 'update_plugins', wpuxss_eml_pro_update_transient( $transient, $license_key ) );
    }
}



/**
 *  wpuxss_eml_pro_extend_taxonomies_option_page
 *
 *  adds Bulk Edit options to taxonomies options page
 *
 *  @since    2.0.4
 *  @created  30/01/15
 */

add_action( 'wpuxss_eml_extend_taxonomies_option_page', 'wpuxss_eml_pro_extend_taxonomies_option_page' );

if ( ! function_exists( 'wpuxss_eml_pro_extend_taxonomies_option_page' ) ) {

    function wpuxss_eml_pro_extend_taxonomies_option_page() { ?>

        <h2><?php _e('Bulk Edit','eml'); ?></h2>

        <div class="postbox">

            <div class="inside">

                <table class="form-table">
                    <tr>
                        <th scope="row"><?php _e('Turn off \'Save Changes\' button','eml'); ?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><span><?php _e('Turn off \'Save Changes\' button','eml'); ?></span></legend>
                                <label for="wpuxss_eml_pro_bulkedit_savebutton_off"><input name="wpuxss_eml_pro_bulkedit_savebutton_off" type="checkbox" id="wpuxss_eml_pro_bulkedit_savebutton_off" value="1" <?php checked( true, get_option('wpuxss_eml_pro_bulkedit_savebutton_off'), true ); ?> /> <?php _e('Save changes on the fly','eml'); ?></label>
                                <p class="description"><?php _e( 'Any click on a taxonomy checkbox during media files bulk edition will lead to an <strong style="color:red">immediate saving</strong> of the data. Please, be careful! You have much greater chance to <strong style="color:red">accidentally perform wrong re-assigning</strong> of a lot of your media files / taxonomies with this option turned on.', 'eml' ); ?></p>
                                <p class="description"><?php _e( 'Strongly NOT recommended option if you work with more than hundred of files at a time.', 'eml' ); ?></p>
                            </fieldset>
                        </td>
                    </tr>
                </table>

                <?php submit_button(); ?>

            </div>

        </div>

        <?php
    }
}



/**
 *  wpuxss_eml_pro_print_updates_options
 *
 *  adds License Key options to Settings > EML page
 *
 *  @since    2.1
 *  @created  25/10/15
 */

add_action( 'wpuxss_eml_extend_settings_page', 'wpuxss_eml_pro_extend_settings_page' );

if ( ! function_exists( 'wpuxss_eml_pro_extend_settings_page' ) ) {

    function wpuxss_eml_pro_extend_settings_page() { ?>

        <form method="post" action="options.php" id="wpuxss-eml-form-updates">

            <?php settings_fields( 'wpuxss_eml_pro_updates' ); ?>

            <div class="postbox">

                <h3 class="hndle" id="eml-license-key-section"><?php _e('License Key','eml'); ?></h3>

                <?php
                $license_key = get_option( 'wpuxss_eml_pro_license_key', '' );
                $site_transient = get_site_transient('update_plugins'); ?>

                <div class="inside">

                    <?php if ( ! wpuxss_eml_pro_remote_info( 'is-license-active', $license_key ) ) : ?>

                        <p><?php echo sprintf(
                            __('To unlock updates please enter your license key below. You can get your license key in <a href="%s">Your Account</a>. If you do not have a license, you are welcome to <a href="%s">purchase it</a>.', 'eml'),
                            'http://www.wpuxsolutions.com/account/',
                            'http://www.wpuxsolutions.com/pricing/'
                        ); ?></p>

                        <table class="form-table">
                            <tr>
                                <th scope="row"><label for="wpuxss_eml_pro_license_key"><?php _e('License Key','eml'); ?></label></th>
                                <td>
                                    <input name="wpuxss_eml_pro_license_key" type="text" id="wpuxss_eml_pro_license_key" value="" />
                                    <?php submit_button( __( 'Activate License', 'eml' ), 'primary', 'eml-license-activate' ); ?>
                                </td>
                            </tr>
                        </table>

                    <?php else : ?>

                        <h4><?php _e('Your license is active!','eml'); ?></h4>

                        <input name="wpuxss_eml_pro_license_key" type="hidden" id="wpuxss_eml_pro_license_key" value="" />

                        <?php submit_button( __('Deactivate License','eml'), 'primary', 'eml-license-deactivate' ); ?>

                    <?php endif; ?>

                </div>
            </div>

        </form>

    <?php
    }
}



/**
 *  wpuxss_eml_pro_get_settings
 *
 *  @since    2.1
 *  @created  25/10/15
 */

add_filter( 'wpuxss_eml_pro_get_settings', 'wpuxss_eml_pro_get_settings' );

if( ! function_exists('wpuxss_eml_pro_get_settings') ) {

    function wpuxss_eml_pro_get_settings( $settings ) {

        $wpuxss_eml_pro_bulkedit_savebutton_off = get_option( 'wpuxss_eml_pro_bulkedit_savebutton_off' );

        $settings['bulkedit_savebutton_off'] = $wpuxss_eml_pro_bulkedit_savebutton_off;

        return $settings;
    }
}



/**
 *  wpuxss_eml_pro_import_settings
 *
 *  @since    2.1
 *  @created  25/10/15
 */

add_action( 'wpuxss_eml_pro_import_settings', 'wpuxss_eml_pro_import_settings' );

if ( ! function_exists( 'wpuxss_eml_pro_import_settings' ) ) {

    function wpuxss_eml_pro_import_settings( $settings ) {

        update_option( 'wpuxss_eml_pro_bulkedit_savebutton_off', $settings['bulkedit_savebutton_off'] );
    }
}

?>
