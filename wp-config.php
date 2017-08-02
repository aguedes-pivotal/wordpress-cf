<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Read MySQL service properties from _ENV['VCAP_SERVICES']
$services = json_decode($_ENV['VCAP_SERVICES'], true);
$service = $services['p-mysql'][0];  // pick the first MySQL service

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', $service['credentials']['name']);

/** MySQL database username */
define('DB_USER', $service['credentials']['username']);

/** MySQL database password */
define('DB_PASSWORD', $service['credentials']['password']);

/** MySQL hostname */
define('DB_HOST', $service['credentials']['hostname'] . ':' . $service['credentials']['port']);

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'w{%Vqo,X#0A,])PC)?C3HCGIflUWw;tX}0MLU8H?=1ti<y}<Vl@U**osMl~jUQp`');
define('SECURE_AUTH_KEY',  '/HnEEk.35+z0x!^|j%2++h+.+z_/2RJL@3}b+;;tjtz>PU@LLPe!!H0!f47Htfci');
define('LOGGED_IN_KEY',    'nr4p1,ubz]Ry%D5JsyjQr;%m]UG]>lroE&=AQ$/eFB#<w6^Gx*;X^TlL22Mbn@#t');
define('NONCE_KEY',        'xg_wyF^?^ej1tjWAQOn~!Z&2Xp-BhQ7G w:DN-Hc,riFY|gd@&U6(T$&C,5H9:f0');
define('AUTH_SALT',        'x0:Lz#mR?o Qz!dc*T |Zm=0^vyp*wMM_Kk-?reII5ezBxn$R|-YLes~}r90tSy8');
define('SECURE_AUTH_SALT', 'whM~Lo;OW_|(qBm>YL-s C|C?f!-#otbTo8-+{$tyzH:V q~W9X+u{a+NB;sZBVr');
define('LOGGED_IN_SALT',   'k+0BchHMHUQFCF-_kG2aBE5{2`hmYALLZ!97)c!8*mBjtoF.`vhj>iC$Zml!Rfv9');
define('NONCE_SALT',       '&^i6]_fkcjQU>#pE!syLjE~4awY_2w+K`X57-L^8@sNmUR6## +C7B1 +uW`Z,5R');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');