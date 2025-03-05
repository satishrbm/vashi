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
define( 'DB_NAME', 'vashi' );

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
define( 'AUTH_KEY',         '&;bq*Um<x|-l!jOe:2f&V`LqN]E[5Y^5&(CccisEIL{s8G2-7Qa2H;M4hma4V7)H' );
define( 'SECURE_AUTH_KEY',  '.JuKNeQ>SGD48ILzi|t][:$Fm|)f<Daoh]eo(?:4#@^sQ$.b28Z<~ce^koq)RF$1' );
define( 'LOGGED_IN_KEY',    'd>>I:xveEhPsKyDKVc0@p9A@3KAtK}w^M#JI`AD3U%fU[OsW,lAh*-kT]r5~}/Z$' );
define( 'NONCE_KEY',        '[;c~rN1d(F[b7i*j#4AATlkL*U/Snd.nh&}ENG^Q.9``!$a@Y^aZ~{+9IP2_=~3[' );
define( 'AUTH_SALT',        'G$#,]0s+*GfF<aQq};.7cn*9w4N[dLTMaD0$G;V7%KOG?G@lYtWX?ocYgECtWhi&' );
define( 'SECURE_AUTH_SALT', 'p?)S}zE1SZ=e)016!A=uw2y9$c-:Ko63lviKq*}0eJrUakCTt@{sC1)7UyEnwZ8)' );
define( 'LOGGED_IN_SALT',   '_*%/MO`K}w1Z-3nrh1Z2Cu$;(aqlTO@N7Dz[~]t G%pb|F&mvp+}e},Bv{/obwWD' );
define( 'NONCE_SALT',       '4wU0ADbHr=0vs7m`(Y(3eJR{#(8M&t=A@0=(G3qF6n(tHf+u$c4!osC=y.L3D_@8' );

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
