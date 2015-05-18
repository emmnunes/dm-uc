<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'dm2');

/** MySQL database username */
define('DB_USER', 'dm2_user');

/** MySQL database password */
define('DB_PASSWORD', '~$m%2Q_0r~*!r2I');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME','http://dm2.dei.uc.pt');

define('WP_SITEURL','http://dm2.dei.uc.pt');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '|TmtlIA@!M$`<+8I0`aaY|&NiHb<-/#w!4v-Cjz4wW(%aAs6JG;[f~Fl{;JtR/ra');
define('SECURE_AUTH_KEY',  '-l%>?uA5K,M>`X<v%%1d`.7+-A>nEdo@4OdSuqC|`u*N<(mK|du(OZE569B}%^wx');
define('LOGGED_IN_KEY',    '?R8wO0 T3L=>;+S!t-%+e,qr/w0usjZbUn,80[|Pj[%U-4eGR1dB}C2*g T>O/AE');
define('NONCE_KEY',        'a:uS_]_6Nd{Z+ cXN+~L{[4FU?ySOJEsU`+EoS+Ya132ym?Vb:Ec+>b9EcY5=D|$');
define('AUTH_SALT',        'E5R`<%%C67]TKnu#{M:IqZ&_&L:%Tp5f`4=ifVJ7;0;,^n2v:?D#];-#ox_+sgG>');
define('SECURE_AUTH_SALT', 'D~2(gOrm=] A<9+6KsaJZRk[@ODjiO,)xe0$G.*6cDkVtli`P%S_MP?6[~+2GW#~');
define('LOGGED_IN_SALT',   '|KE.cZ5.>h{#aXQUIL:|vekb}fdC&(#Rj,:|nDBnLn7TbMc]fAMjc_;m&k3dUR~&');
define('NONCE_SALT',       'e%%MQi4&dB+!2pH#Bi|[? ~#9T3Rf[961(QRyqmvSUawq@n]`5L%X>a|p[dKOj-a');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');