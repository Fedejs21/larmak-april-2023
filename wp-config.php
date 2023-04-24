<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u279553735_tando' );

/** Database username */
define( 'DB_USER', 'u279553735_tando' );

/** Database password */
define( 'DB_PASSWORD', '!i#Zj1dX' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         'V9ZO4?A_mTOuP;hA?K]o5Kd*/JEmk[M>aI<k9[K2Adq^,|-Pak$2`+SHtyZxR8[(' );
define( 'SECURE_AUTH_KEY',  '19x(VSAT~S9fBwDJI.2SCtmU~_54Zf<yx[;#I63O|!C)2,:V5^AE[ >kH.NrqXy1' );
define( 'LOGGED_IN_KEY',    'pO*3>dGI#kI9.Rykr>([QXK#F*u|2= _Z9-,gwwY$p_3_qDkKT8sQvk: ^umu#*w' );
define( 'NONCE_KEY',        '2>kW:!;0u]+|:5V:QIPgO*@)Zu9rBMFh}OJvysU&F2oJ%@e/DEgf?j0<u 16/L%Q' );
define( 'AUTH_SALT',        ':A4n6CbAm{e{. o12qc}z7ir.:h.g_JTKW064K9|4:W,BXxA{J{r )PDSq;mygGi' );
define( 'SECURE_AUTH_SALT', '_/- ?Ql4.^pqX9fsSn/zmN@|MU</V};:7XPa]gAqjofAx$msmjkR}_d VuG4e#3p' );
define( 'LOGGED_IN_SALT',   'f;*7sM,N#b7x?A(<t~}Q9$I])~!ig4Wq6HQXscDy]NwZ#<%`{sB!pTo57  M92y.' );
define( 'NONCE_SALT',       ', uCBK(@q=C:)G+y?%9]7,zV=yde[<Bo3COS5-i&i=Q4F7zT8~v9X)w?{jKiJc5L' );

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
define( 'FS_METHOD', 'direct' );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
