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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'globa2fr_wp702' );

/** MySQL database username */
define( 'DB_USER', 'globa2fr_wp702' );

/** MySQL database password */
define( 'DB_PASSWORD', '99-p7[K39S' );

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
define( 'AUTH_KEY',         'owkawgrr3jws2zzeisle6gbazxzfejgi1ubyuqn0zihd5ykow1p1wmeopzdw4njk' );
define( 'SECURE_AUTH_KEY',  'a7jxij1yzgtm3qlhhe5xjwdq2diwlrteho2rzfr5yrgvrnffpdojnhlibladwkhl' );
define( 'LOGGED_IN_KEY',    'qsrkwew6uglf2zhee4eheat4sm6byyflewatnzwhtsvqfp9570vcxer31n7gwila' );
define( 'NONCE_KEY',        'nf1qvrr4uawvjzsbfl1dzijs1ttbluwockrhzw1ubta2mlriexlvgeysyra8wuie' );
define( 'AUTH_SALT',        'vbeffyuz7u7ufvdza4joxqcihr4egnqfjugy1bb8tnn3eujjgzihponody2hzsgh' );
define( 'SECURE_AUTH_SALT', 'oy61doejrck8rmhmm7jg8fhecfqvkwdnzho85pmbrn3pfuzjoid8bbmzymq3efwc' );
define( 'LOGGED_IN_SALT',   'zk9lfxoypnisqqkkpvrzmewzeu64ev6gq5bldt96cjdgb0zedi6u3qkfstgojuxc' );
define( 'NONCE_SALT',       'ebyznldplwgus6lifyubesdiggyvxgnskyt9oodyeiykgmafkvbv5ajyw32g0c3p' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpyi_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
