<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'new_vashi' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Jxn8oq7*-Z;}zu%3ng#?ujn8xEj`$K5MAk5}R*Ka/sWf9xMl49E@BZ#uKFX:ZYC4' );
define( 'SECURE_AUTH_KEY',  '5e~?:BD*KW/Wn/mh|Z#7!n{SI$RAU]Hd(lfukXT;hhhQoT_Nkcd~F-D|Z4;`E4Hp' );
define( 'LOGGED_IN_KEY',    '>}|Dv:RPa{rtJo:^rZMUl&XQ%C&fDmXU&m~[(qvYpL5BKbF`g]VvH1@@jc_EN1QE' );
define( 'NONCE_KEY',        'a}<IqkH*Lqnue1Ons)T^7$FT*(Xj+H`knT/oJe@C,*AOtST`#?5uT){<~{}4)wy7' );
define( 'AUTH_SALT',        'abNmy-t=ssi%| itm|_w+_)TUeaSflU[L7HqVtuh4V7$LdQLkpcIL#Qf9kA8ndu ' );
define( 'SECURE_AUTH_SALT', 'mfTA5<M*sM>.Ery*j9wTF1#d4y%w-y|!IX3sB=ZjH4k[/2xa`stU-6b},l)UCo<f' );
define( 'LOGGED_IN_SALT',   '.~sw,H{44T19_j#C`.Nl2e0P,^bfP|wp!_{6r.fl(yOlTGktF+||hciEzSZ^-klw' );
define( 'NONCE_SALT',       '_1D=>&+&92I{lU rm;/9U=@nVRs?zAA7_!e{p3}|PSUt^nvyiTc~PRCq 3P0{:r7' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
