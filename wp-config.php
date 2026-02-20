<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** .env loader - Loads environment variables from .env file ** //
function loadEnv($path)
{
	if (!file_exists($path)) {
		return;
	}
	$lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	foreach ($lines as $line) {
		if (strpos(trim($line), '#') === 0)
			continue;
		list($name, $value) = explode('=', $line, 2);
		$name = trim($name);
		$value = trim($value);
		if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
			putenv(sprintf('%s=%s', $name, $value));
			$_ENV[$name] = $value;
			$_SERVER[$name] = $value;
		}
	}
}
loadEnv(__DIR__ . '/.env');

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', getenv('DB_NAME') ?: 'capitaly_12124654');

/** Database username */
define('DB_USER', getenv('DB_USER') ?: 'capitaly_deneme');

/** Database password */
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '0_v5Rd]hwJ@(.f0&');

/** Database hostname */
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', getenv('DB_COLLATE') ?: '');

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
define('AUTH_KEY', ',dCK^)=!Xbb@U!<kA~O u%yh4sQsoE48UL)/;;0Y-*m.rB%NR<J3:#Oe*3Ee+mO+');
define('SECURE_AUTH_KEY', '5ZO.^DG~K0`u%k7A:MIf_9i/ee#]ZBDr[<$:0GEc:%jF+HfqA5g&zjq>U;0qpl?5');
define('LOGGED_IN_KEY', 'iUTq?jEkDFfyB6OJkrP]^ugY@{.e8[4KHH_ M81^^h@XL%G7Tn8j!]vB<4H+u9^,');
define('NONCE_KEY', '(GQxfQoqu.(-IK?R)09W:f0+X5mbs&I>X*4>4(e6DIH9!rd#_|p%f59,5;QFmuE/');
define('AUTH_SALT', ' 0gCR`}|90n74T9GBT=/Q52O0Y[0`7)GT-D*16N1gpI{>HcyLTR?`:p @7TE*00J');
define('SECURE_AUTH_SALT', '`3f[K3H4t9+7=||QBAX{a!QH6DqwWEg-.n0Kv?d}%k,U+[_!oq@CT-lX)lYj)Qhp');
define('LOGGED_IN_SALT', '|d>Pc?bOjpCYrAu1SpT^f#FlHut5F~7.Pz%i,}+[+Yy05BP{eMBY&t@^RJU|jIO0');
define('NONCE_SALT', 'lvU4VtevYgWs$~l2/`1^7`{0tznu~H  5b=]xs6Q^`/unnf3S.tAD}2.JNu`!nQl');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'bd_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
