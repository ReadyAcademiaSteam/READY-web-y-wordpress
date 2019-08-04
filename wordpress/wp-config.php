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
define( 'DB_NAME', 'readyformacion_bdd' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'e6]!;px8/66kKz/AWj``+;Y1Tq3!u?OMVYpH!y$Lg?~Xu2SGyc&%IH;Wk%u3BB)l' );
define( 'SECURE_AUTH_KEY',  '8_Vt2GXvRsi&TMZk!N]rc^EZ=y@5;PD4 pBF]*|P#G |E=M`t|ix1ikFbBu>3H.%' );
define( 'LOGGED_IN_KEY',    'mI.Tj<1B^MzF=TmHtmdD#dG>hQq?e*#~TMV)~cR_)ph#8(7g2HZ.3z80SA.#j:C2' );
define( 'NONCE_KEY',        '_bbEVb1M^Av#nsb*ZRQ1J]/f)|H.B+lV?<BUp+X+u7g,5q= 9Whhi%_`WhF-7bHl' );
define( 'AUTH_SALT',        'nT+<aV2n5duJM,wP~V|9i1zx][Wpr7j*ZpQ!r(wCKp9F:?Tf=o(X^+Rw|bh!T=|o' );
define( 'SECURE_AUTH_SALT', 'D`G|[(udLhupLNm[[=S#^K31nINmbF.@Rv3Bu1M5]n`&K@&&}^~^P-}9[,,fXiTH' );
define( 'LOGGED_IN_SALT',   'fCISW?6YL~5U-zQ&-RD86i(_F1$AmrYZc,*FxSp]Pe %;c-NE2-0QG L8}btUf}t' );
define( 'NONCE_SALT',       'RqoZ-V<RO^cJk51bDqa+;O<:GTh4u59I4qSP&OymIY.WF.k41=HHl46DCvau[mt~' );
define( 'WP_MEMORY_LIMIT', '128M' );
define( 'WP_MAX_MEMORY_LIMIT', '256M' );

set_time_limit(300);

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
