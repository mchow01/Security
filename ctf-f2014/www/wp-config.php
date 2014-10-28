<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'board');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'Wh@t3ver!Wh@t3ver!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^(D}S229zJ.(t-0-|&QZK*J-L28fuX8f})wJQX18.h26Xg}pj(<qBys3$DT&V&K[');
define('SECURE_AUTH_KEY',  '@_o3znQIywkgWSG^F#rTeZbQzH{(g?I&YrKefM$+sl!|[J&Fsbv5UJEO0k2%T%@h');
define('LOGGED_IN_KEY',    '<Y{/F;wY+nwK<gr,IgA|ye^}s>mdC`3Yk$!-__T@9IF1loOu]g@eM~;vh.`39&>8');
define('NONCE_KEY',        ' L~6X2Af#.#!U3nXpV]h?HiDPz<of{Gx6TmCj0n!a;IoaS| 3tb6MGI5G.+>iR]X');
define('AUTH_SALT',        '>%i(,$J(m-n:?B?X2D`VfYu:H+zt<e@Y)U%sgL(?;MW[L=7j_]IBT}1gN]/b|&)o');
define('SECURE_AUTH_SALT', 'pi(<Cf0_%`ri?$.h-*tJMF-#?@zz^l[DMfSvo?`-YH|2vNPE.b%}Fwse[Ur/TH+]');
define('LOGGED_IN_SALT',   '+1?V)pSD4aI_N$Dg&q8#VO8J6CW+WbL`<9QuPox%XvhGx cB1eR-wW$i%2afG$Wr');
define('NONCE_SALT',       '4l4eL@(0q{U]X9[p|*FNf-rTYI;|C/G@~q,c`c+ol(}:0-9uN$q)n@J2X|z{zI.2');

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

