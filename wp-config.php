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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'truck_transport' );

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
define( 'AUTH_KEY',         'Dg7{GN_TTOns4&Az6R5=n[5-qQq*0XGV4xL(<PF*K]+int#bx&T G+s6X)c<sswI' );
define( 'SECURE_AUTH_KEY',  'Hc@+]R6TXi;$EERaxu/h,_OLdc~5LP@|RF?*,+{#F8[m`k} n8y]_:Crlu_%p>ms' );
define( 'LOGGED_IN_KEY',    'J1zi^1V*I:!+p$GG1Dog549Q!t8_@QPF9M=R2IPzc.2]kiHk[IY1? ,sbY0/0h$Q' );
define( 'NONCE_KEY',        '`S|%87O##!N,O)!wKnM(+PC@@5nmo(cl.-|}`Gl(xb N^N`mLfS/&=kM!Dn]a:Wj' );
define( 'AUTH_SALT',        '7YpULwwCwNto{ D&l==F gI~tYC-gL97}.7>F&*B$Z|}AyJCdL)6H:*-CGH>,@,a' );
define( 'SECURE_AUTH_SALT', '-U%e>#(J/B0=sH0Vi_;[{~T7;qoTbRuMuz~]jT< hrfXbRRWiP*AFYV~4l87+<Nq' );
define( 'LOGGED_IN_SALT',   'XNzPZ><.vC;YxC,E7Y<:~vD#FDTB:NU,j_~O~:*j3taB2Z=QdI/So9vgcjN8[2 >' );
define( 'NONCE_SALT',       'hog>L#M8%oRv]RJf/o38id@=d8>>y~1A;X /LledRspU3PLM{X#Y1p6UX,*n(j2+' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
