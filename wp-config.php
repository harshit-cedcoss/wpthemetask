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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define('AUTH_KEY',         'KKLSymC60oxR4mdXTYAq3D2km3j+nq+pfVQsLooAJp1PzfKFWtomMPAj7LQaECmISLAVaYqRcCxgOMUzYsJ3iA==');
define('SECURE_AUTH_KEY',  'KTt51eTCTIl5K7yZiwQzJyfFr3EuYWAsXVGR+gfsuHydkV2JFwV5mjIyw/mHT605pGTHmdv+7aolNl1652cM5w==');
define('LOGGED_IN_KEY',    'c89zo/Lf5I9mtYCh1tDwKHL3H7T0fZIbzj6vb1wNPC2oZT+XFTf/MI3m/Evq61HR+JNOZH9ZyQeH+tuCBKpMvQ==');
define('NONCE_KEY',        'B5fk3OpmuC5LDcnLd48gyq0UK6ZYo+qbcnvAtNe/DLK7bRGcUuBAfJOcrupd1LIZKWBeH5UwIa/8PO/FxFKPLg==');
define('AUTH_SALT',        'Vlxen3nWn333AKaTT1FP48BqACEKgYjJNXrtFLE1lpouhtyUCIp4D5lyVi/axcWAkZPcCVtsS2jFZrK/Bag63Q==');
define('SECURE_AUTH_SALT', 'UwATXmfn7ADKh6SlXwfvsoLC4j/C2OH6g5siG1b7YCRzurVCiORGqZ79plB6FOBZz0iPZzNBH6mZY30VOd+fGA==');
define('LOGGED_IN_SALT',   '8Sy4pQx+JLe1Jxt1md+9o25yFVimQRK80tvZkZoCavUYrfktUKkBjBjoy06bqp+pLK8lXuyBLt6Iwnu4OxrR5A==');
define('NONCE_SALT',       '8BTwLChjzvBYO8KgS69ja9xWEaG+/5w2OH2arTKBHnllP+u2EywINITnKOK6STYwO8SgvkHr0YfY8yPHP4p1nw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';






define( 'WP_ALLOW_MULTISITE', true );
define( 'MULTISITE', true );
define( 'SUBDOMAIN_INSTALL', false );
$base = '/';
define( 'DOMAIN_CURRENT_SITE', 'wpthemetask.local' );
define( 'PATH_CURRENT_SITE', '/' );
define( 'SITE_ID_CURRENT_SITE', 1 );
define( 'BLOG_ID_CURRENT_SITE', 1 );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
