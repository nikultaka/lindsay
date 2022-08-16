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
define('DB_NAME', 'lindsay');
/** MySQL database username */
define('DB_USER', 'root');      
/** MySQL database password */
define('DB_PASSWORD', 'Testing@123');      
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
define('AUTH_KEY',         'b6MqFQbiY28yEkgFE4lQF2A2Kv1cIMZamfdAs7ZPo2QQvbDufVCHpxbqoVgbxwdJ');
define('SECURE_AUTH_KEY',  'fOwppV1KJ4RQAxO1zzGtAO8Q8zGDy7bPjn7yfIky8jTX9WOCYfNNVWZEJhu8LADI');
define('LOGGED_IN_KEY',    'ozvGqu2853dgmRQ1k2EaIXGdtQPUYokFoJ7zvB4lshT2BccaXCffWl1Rxry4cAEW');
define('NONCE_KEY',        'IFj3EkwFRWq0MZIjbBa1037o0vptdPMFEFlxzgTy0ZFHtCXy4tYgC0q2Xj81Juyo');
define('AUTH_SALT',        'fATHGI7OEi8MkZDt8S1QgL95mqtiFYHBrjGkSLcp9GVoBOIeCASWcFKR1cwEuN79');
define('SECURE_AUTH_SALT', 'UwQ0t0DLQ5aY5azd2crLQcsftAyPCGqd7KqrS8I69vRA6saAfCuUIUShooT7Q8ex');
define('LOGGED_IN_SALT',   'MXGTNyrdXssP6DORWSmGHZ4OFqYbVFBBeVQdLoAAgdxpHqKG7y7RS4T3Nhcr7GfV');
define('NONCE_SALT',       'HZu9ZsOh2ZAOd4H8gpLas55ODC8lQjWeLwrAjZIhXLQ6ThFgTia9e1Mke5RmFNfD');
/**
 * Other customizations.
 */
define('FS_METHOD','direct');
//define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');
/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
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
define('FORCE_SSL', false);
define('FORCE_SSL_ADMIN', false);  
define('FORCE_SSL_LOGIN',false);
define('WP_HOME','http://localhost/aspirecanada/');
define('WP_SITEURL','http://localhost/aspirecanada/'); 
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


