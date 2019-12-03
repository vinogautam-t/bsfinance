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
define( 'DB_NAME', 'bsfinance' );

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
define( 'AUTH_KEY',         'wM(/ane9SzYu*N{5%ea-=sjF,+:fn_meUB9v`3e~fWZisB%vI+(,us|iCsr$<BH)' );
define( 'SECURE_AUTH_KEY',  '@|g0;/aS<Jt2QrCx2{QIVBN:Y{wN31T=suU,F{51y2GNy@@0iCGrrlU+3MH@Ck#2' );
define( 'LOGGED_IN_KEY',    'X1 Q+Y+5eX7KSM;yb5,3&6/[do 2y(KJx_v.#*Yt3WaYZc/Hh{2N=,>zD?#T`FHv' );
define( 'NONCE_KEY',        ':n^I_Td5*t1bl41Zc*sF%S%/B1QnwFN$f:XZ)hI?YbDJ1VA>6@G|/Ng4+k4tu8vR' );
define( 'AUTH_SALT',        'jyD{dT`XSC $.u}urue>I*&E29d=$_-gSL-4Z[]YSTD~8m(e7lPs$Z$I+>NnfnYx' );
define( 'SECURE_AUTH_SALT', '[^8HZiwv4H=nvG2H-PE2dUnx+&G3PAOq8.g@_(iEr8:sn(N_5)ZeQY O1I4%X&ZP' );
define( 'LOGGED_IN_SALT',   'N)K- i=>i7KA(5YsPQS0YS~SaJ),M0G2U&H9jesY_xv1}kp(E1BuZ?0o_6Qw>y<t' );
define( 'NONCE_SALT',       'X$kJ=m=`7@ J-SS<2DmdFUYgG=<^_<gsZoi-cXNn:?2Bt1t18`2]/0uK]buOUl[v' );

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
