<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mwae' );

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
define( 'AUTH_KEY',         '*.{2HxR)6`hYbq.Rz/M[qU_26O0LwIF?`%`2>U%pRspl+bqYpw+2%.GP+sxbv4<c' );
define( 'SECURE_AUTH_KEY',  'S[h$-V2qT$wCF9?7<Pe&bb@GWN+SDepq4$0#Y87rAnGXSP=giz!gPBiV*c/hr{K%' );
define( 'LOGGED_IN_KEY',    '&LNro[ H$WsWYDLHy6MP Z)k9LE@gct<jZy3TYDC?LDZ> p.>TQg~]ibqO}E[srt' );
define( 'NONCE_KEY',        'o!4szQf1]=]V]j5T.E6P1g/Fn6nuIYC]tFsKqTeudc;tFnDt%fbA*K`gn|G~#^3$' );
define( 'AUTH_SALT',        'Q}tup#ou,T2C21! <ae`.k)Qn/1b,!>EMMT/2{>Sni9=Cg.Q;L8~._FH-YaG;Im?' );
define( 'SECURE_AUTH_SALT', 'YLfB224UnAnq|k3|C)M2H7K2{,@w%qoI-DE33gc<pqL)0><gmX~UNW,sz*a&yK62' );
define( 'LOGGED_IN_SALT',   'iw.iKiU2|Iw^g5qRoJ%jmk1TkGC~Whn!nSSYMM+!(<T{ptL*s_tV W`xK^]XW_E3' );
define( 'NONCE_SALT',       '%+042@B48HfHEJw |OKbW@m*)_.N_UKNC#q/u7tlUgswDO0mv6iM=f9V`F0sF:Y&' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
