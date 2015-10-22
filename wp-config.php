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
define('DB_NAME', 'worldwoA8CydNqv5');

/** MySQL database username */
define('DB_USER', 'bf93b39237b49f');

/** MySQL database password */
define('DB_PASSWORD', 'd4c05f7a');

/** MySQL hostname */
define('DB_HOST', 'us-cdbr-azure-west-c.cloudapp.net');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'uwDn9|nR<e6Aw$;p}%hGYw/^DvcrfK+$8{4f7?QNY8o|cnm&@,@FW]k8-H4mjWT:');
define('SECURE_AUTH_KEY',  '(i)V!t$x:sdNY1+5wNF+3+PdFt)h$w2+/ye6_avwzt7L=w%HI-a(Pfbc1=Zub$j`');
define('LOGGED_IN_KEY',    'DfF 09SfvP?*ZQjn0Y!x-^sQlv-C_3]fqfZ8Z<7dG:+ni?>-b47LVF3Q#T%2l<N!');
define('NONCE_KEY',        'V~~CGUd.5J~MzmsgK>Y7xjn5BsSTo]mWAyHIFGqt4!a^;m+Quk<Pe|:sJH3F>-l_');
define('AUTH_SALT',        'RP<<^[B7OA1q|?aHt:]/2yX.&]H<v&/&k3PHEfL|6l{fffvQ>ZTcGg,:I.e:+znM');
define('SECURE_AUTH_SALT', '(6}&`qsZMTt|`LF]S@@ac[]. P3 ]K1pn@TBZkqPN;]l.d}G ;~.Abb+<FDn+{eV');
define('LOGGED_IN_SALT',   ')6RDM?+6%;#8eSy^?a_^d6R=,]DyZpX+{|bC*O(kP>v|A_2&`R^ea:kUA!~$m)3K');
define('NONCE_SALT',       'HZ9n]%i*B`{yR4R?ld=jQkU%k6-ZoY|}>edcvp]lh(mY]Q63ynRtd_KdZ* !eRnt');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
