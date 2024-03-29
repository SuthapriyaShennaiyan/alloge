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
define( 'DB_NAME', 'alloge' );

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
define( 'AUTH_KEY',         'vk*H%O><w&X5K?|9_qt=}<J;_h::2thN1Mu1;np_RSrF693#mL/H iwN_|(My-Qu' );
define( 'SECURE_AUTH_KEY',  '|b|<j`/:]<U/9/n2Rb|^L><-|}+NG]?Hqo.bNbF<MyqjW?6uTRML]ml47HCvuBVM' );
define( 'LOGGED_IN_KEY',    'Fs1m8{0- {eZ.As]5`_OFLN=ZmycFeN| }ID[X|2<ru|dcS{6wwFb):FS0UC(/A ' );
define( 'NONCE_KEY',        'K+M^&liU~4n| exk}IwbM6EJC)O/8#8sdzB@J[*?=YWcs/Z?}[|5N~j7fb$m!AO~' );
define( 'AUTH_SALT',        'j7|[qFT^>?orw t|{>?;5fcr7pHg85Vq>c2x!$Sq?sq${0(`;R7<6sKvr@4t|Ai:' );
define( 'SECURE_AUTH_SALT', 'Rqgcu{ 6c)h^3DJz{.}DQHyK/sP7U_A/ugu>.w2}Jnk;:L3}~hD}[r-@fX=Gv,,G' );
define( 'LOGGED_IN_SALT',   'q{w5.jvrc-(]o1#6IG-ps4w>)]Xg,SDzgO|$Pvm;<#QAXq_+`#hla%cAXp<spgUm' );
define( 'NONCE_SALT',       'Q4NeOJ1{1)ny  rYFFQF#A{z9K9en:qGCXQ#f9k95TQIzvL}D}Gt[SZqL%YnQ&m;' );

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
