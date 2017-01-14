<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'woat_dev');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '*rtih`UF]o59<n&;V)Y!C0y$lC}1[ztoK>5]*Hu(Vi52VR3}ju_..6:Y0Y$3 VX]');
define('SECURE_AUTH_KEY',  'CAR8ue1{<AfukwC;(rOqhT#d?2(Bt}%GLR2A}C:=G6O|=,NA#M7o]PrK]{zbgcE!');
define('LOGGED_IN_KEY',    'a~,/P8v-Sk9NS&.GMqS4e21%&L3)<k{FKt$%^bAKF7W]81++o0j-@X7xr0,h|kcJ');
define('NONCE_KEY',        '$w9JsdXUQIO3s}wKT[ S1z6V/8$~qpwDq;S]~/QS:SiIxf/&H~]{4sz(L3[Z^.xD');
define('AUTH_SALT',        '_;[!Q~4|KY`wk^RJ(Cmq!fS(|,&h q6NXAcWjc-33|FU-5}cf/X%y#L0I&Uj fTx');
define('SECURE_AUTH_SALT', '8^+m,974a~xbzxSoFGQ;<`|-OcTbyuzJbo+!V*l[?jBK@_F$[pD^)cDWQvC)bqcP');
define('LOGGED_IN_SALT',   '&!3)S#_9JP~O_S*^.pobnx;mfu2)))Ml847{}*qT>?snJwx:4P*t[w% !r|9]Fca');
define('NONCE_SALT',       'LG(f]|t:fZ&{}jM;Y0knO5<8#BfYE4*F7TJz;o)z>I./n7#@O6&(9OAhPjh^R7WM');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'woat_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
