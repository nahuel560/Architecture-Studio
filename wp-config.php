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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'omaarqui_wp538' );

/** MySQL database username */
define( 'DB_USER', 'omaarqui_wp538' );

/** MySQL database password */
define( 'DB_PASSWORD', 'pJnb)4]]8!sUM5.S' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'tvoh582aq1sjk9nx3lof53gtqsincwzjwjsejzkt6ybapts7b8pkipoelwh9vbvm' );
define( 'SECURE_AUTH_KEY',  'kuszxtuxjeid5uafjgs4cmnwnbnxw1ah738ek61mq1b2uzjiullamsb5l2az7otg' );
define( 'LOGGED_IN_KEY',    'fo9d8dnfry4exrsqobp6thve5iqf4braq327s6j91qjqkdrt6gdbmi4imgnnkzfp' );
define( 'NONCE_KEY',        'ivajfxplna3ykkag2onip86mqhmp6v7gsoilywu8yfmwphqmchil571g0hmbjh3g' );
define( 'AUTH_SALT',        '0dza042rlsjeeciosk340r00bkmtkleahwiy42pxfy5b58tn9nxvhqcrcn3qn3wl' );
define( 'SECURE_AUTH_SALT', 'ftqg5x4otrt8uh3nx6twkwnwoz6ydyhsvlxdyxefcq7ynjejxgjpxqqdhlcfprxp' );
define( 'LOGGED_IN_SALT',   'uqnxj48dqfqcsszmnw57kgt40fnn9vwgx3kvuste7jhaivfqsapcizze2skdrnop' );
define( 'NONCE_SALT',       'och0br4stzfqltww8q4yyi3owrskb92kcdsazdabtvhnkoyjw1qnldeqou7ewnpq' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wphm_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
