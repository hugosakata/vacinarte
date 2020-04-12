<?php
define('WP_CACHE', true);
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

//desenv - producao comentar as duas linhas 23 e 24
// define ('WP_HOME', 'http://desenv.vacinarte-admin.com.br'); 
// define ('WP_SITEURL', 'http://desenv.vacinarte-admin.com.br');


// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define( 'DB_NAME', 'u414589721_0BIRA' );
//producao
define( 'DB_NAME', 'u414589721_vacinarte' );
//desenv
//define( 'DB_NAME', 'u414589721_dev_vacinarte' );

/** MySQL database username */
//define( 'DB_USER', 'u414589721_Pqmkc' );
//producao
define( 'DB_USER', 'u414589721_vacinarte' );
//desenv
//define( 'DB_USER', 'u414589721_dev_vacinarte' );

/** MySQL database password */
//define( 'DB_PASSWORD', '1ADFHgUesf' );
//producao
define( 'DB_PASSWORD', 'vacinarte' );
//define( 'DB_PASSWORD', 'vacinarte' );
//desenv
//define( 'DB_PASSWORD', '$ultraseven9708$' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'D(4CN94ZY&$uGNa!}]YD,&}Vcf=bqmTL)Po&:%Az4scNzmsp!X/G.V=vcj~m_6)M' );
define( 'SECURE_AUTH_KEY',   '2;pp,7b+--U?Hm4T0|*3qD+L)0ojBOV4&V!7,G$hm&BAjgJ.{j8dG)vwO)3nI+vL' );
define( 'LOGGED_IN_KEY',     'dE}zT&WL,8%b(R15j~f6};C9LB)_8`!wp4%VSOipkM ZlT39oAtZ+$h,|wA:[pBX' );
define( 'NONCE_KEY',         ',EKPrU8hl8R&EUmrOtddH]osg9Q<uv)z)qxi4CKpjz~O.h9a m3PZymMr.*U.=AA' );
define( 'AUTH_SALT',         '5YtuNa]%79ZjATmm4Kw-_8)6C7Jhv8mK^O7uNo>l Sz*IP)t#C@,[+woiwOKCXYU' );
define( 'SECURE_AUTH_SALT',  'uO+3BK [ He(Jl(T()BK[W5jQ9LmxL5 Yh94@:f9UkYB.%B!1hh:3Vd}na1&4_4;' );
define( 'LOGGED_IN_SALT',    'mzx-5k:vg#a~*8CeeN7PqDx:m:;-%q!T/j?Zrbz*ZNbK/O.UaCqx2V:dSdBx>+X0' );
define( 'NONCE_SALT',        'O`uGvY0E=d/.7)]c{y]7[t#wQ,.=.vJwi]h;61w*C#{egrc?9qwQ.-<;Y?,!fPl4' );
define( 'WP_CACHE_KEY_SALT', '+&d{uU)kYbTR@W${He_buMu7eGb,P(/L:T:yuJ}$<EE{E)qCzui@W[Pj!RnbP :M' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
