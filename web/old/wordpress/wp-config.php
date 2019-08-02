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
define( 'DB_NAME', 'aulavirtual' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '}m{gTg}Zd(;pCZ|@*-W1uP_)Lrq UR8ZU4a,LG4>(5}!ZaAcDc:5K!ErthOnN~U*' );
define( 'SECURE_AUTH_KEY',  'j]yo&t[#Q@GHfQ>y%GXqnTXAyf@r6w|2H 81!SM7plK?Aw3yu9h^VQ3Gl+9+j7>&' );
define( 'LOGGED_IN_KEY',    '#{>A^ &L&I]Oq~RUxq(/C[1N_02@In5|S4mlop0(^i`Uiuzm1`l^,M$`<C&K+(]|' );
define( 'NONCE_KEY',        '*@B.Gd,lq/I[J.5`A4NPEhT#N:1F5w kYLAzj7(uo6G=>tj!m*Zw:V`yN)oFL`jn' );
define( 'AUTH_SALT',        'KF[-|$&IGv8iczwnjhg@ r}*~8R+eq1e.9lj:IZv(*l.@k(5+yoC44G0)BeC;T?L' );
define( 'SECURE_AUTH_SALT', 'OB8Y&9I%*9#AR+Y@$p-qpqeF/-q,`{t4/IV],Q=Ln=SB,jV3~>|Az2]z)%2hG%7C' );
define( 'LOGGED_IN_SALT',   '-n>KZ#f)%7yQX_9HcXcr9i}},4TitT[ 8KrWVx$_)M!?|Mo2/++hJp #$JLPNy0@' );
define( 'NONCE_SALT',       '#@!369Z&v^)hnEkK)]cKRL9aoykkjH4_<Cud]@?487l c]Vc#H)FX8*A](@E%Ln0' );

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
