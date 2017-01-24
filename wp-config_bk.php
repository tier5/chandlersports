<?php
# Database Configuration
define( 'DB_NAME', 'chandlersports' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '123456' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         ']_dG9t,Pg:Ip|UDNg<?=,j&i4ovx`#|Ph;u992V}3Q-:p-}KlwQyy4!wS?e<)Gl~');
define('SECURE_AUTH_KEY',  '`{fU6`3jB-Ywvbn-4*Y#eV0W{qK0y$!!4DjS6+Pqt#j):;h@&s&r8ivP-1&aY[b$');
define('LOGGED_IN_KEY',    'wV={CfVEH,A1}7MkK|}hsaDxx@|&ZcuG+-aW>x28UA]0&u.4wX^Ab(h-(7|qm-&.');
define('NONCE_KEY',        'IdY`h5VNlu{klo|AWv~-Q+F.$sE^KH7a(3c7Ga ?YUv~s:2gof{w8.|;mdr/`6V:');
define('AUTH_SALT',        'gCP;1y aD@Wd|Zfk^3W9e}=fN+apDX~B9e%S*PhW-NEGsCW7H;8OGx[<05At_TV+');
define('SECURE_AUTH_SALT', '^J7d?UUPM~`$8B6ScGT:zKpU.oqz10!t+CTv{|.uW@$IjhPuA=@oJ#ku+Na.+b;P');
define('LOGGED_IN_SALT',   '[8}IE8;lPSd<6Pg>>/Y1rp4>yJwTI#3:~xNE%DM+8coK=d1)CQ<^#{|tBx$B&9EO');
define('NONCE_SALT',       'wsxW OMV{>UyEuDLgbQ+3J^U3M5+[AWtk22)/7(S5lua^~0sW0v;=-UJWT!FQrVs');

//define('WP_DEBUG', true);


# Localized Language Stuff

define('WP_CACHE', false); // Added by WP Rocket

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'chandlersports' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '1f58e8c69bac587552a7db7c8b171e80a94e309e' );

define( 'WPE_FOOTER_HTML', "" );

define( 'WPE_CLUSTER_ID', '34438' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', false );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'chandlersports.wpengine.com', 1 => 'www.chandlersports.co.uk', 2 => 'chandlersports.co.uk', );

$wpe_varnish_servers=array ( 0 => 'pod-34438', );

$wpe_special_ips=array ( 0 => '134.213.219.113', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings

define('WP_MEMORY_LIMIT', '512M'); 

define( 'WP_MAX_MEMORY_LIMIT', '512M' );




# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
