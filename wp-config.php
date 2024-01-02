<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'p5-laravel-artisans' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'Yd2eLWWPCAZcl8n25jiTisK7KR6mr7zwcpqOfG89JXSwjlzH6MDtJ7BgdbfXLqHh' );
define( 'SECURE_AUTH_KEY',  'AxBv2dWugqCro7nZxLTcrT3DshY2FErdlqfdB41epRB3uUEx1wkDzshlsF1tQwzq' );
define( 'LOGGED_IN_KEY',    'CXcc10NiROKOmWgSnBUjCr1EoFUmOL9z0XOpZ1t5z16F7gkW8nYci9841MLYDOFn' );
define( 'NONCE_KEY',        'XE4U5g4g5oehg0oRfO5FASAlMZyopGFs161GbROce3DDWHoOwkuyPAhjhNyae8sv' );
define( 'AUTH_SALT',        'yYDbky5VIeRwj8oPIgFYIiTTvor3Dfx007O6wfHhTWm08gtEq4bIEWXowgiGjdkE' );
define( 'SECURE_AUTH_SALT', 'vqXeYXlUWhNkQvXF0blmtlEQ5iV4P2LOQsSadXIHBMOXTfbNE918vidmtuRTWgsI' );
define( 'LOGGED_IN_SALT',   'zcFycX1JnYjvsKs1nJedOSMeiKwoRCDnbLKjtquBi3l4jhoqCCqp16dLosUgkc8h' );
define( 'NONCE_SALT',       'XhMAqp7EmdKDMciz8mELB9MabzWwpeccFUECIidH3S6RUXngYAlrCv8HLJ0wzmE0' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

// Agregamos un shortcode para mostrar información de la API
function display_api_data_shortcode($atts) {
    // Verificamos y asigna valores predeterminados para los atributos
    $atts = shortcode_atts(
        array(),
        $atts,
        'mostrar_api'
    );
    // Construimos la URL de la API con los parámetros proporcionados
    $api_url = "http://127.0.0.1:8000/api/all/actos";
    // Realizamos la llamada a la API
    $response = file_get_contents($api_url);
    // Verificamos si la llamada fue exitosa
    if ($response === false) {
        return "Error al obtener datos de la API";
    }
    // Decodificamos la respuesta JSON
    $data = json_decode($response, true);
    // Verificamos si la decodificación fue exitosa y si hay al menos un evento
    if ($data === null || empty($data)) {
        return "Error: No se encontraron datos válidos en la respuesta de la API.";
    }
    // Construimos la salida HTML con los parámetros indicados para todos los eventos
    $output = '<div class="api-data">';
    foreach ($data as $evento) {
        $output .= '<div class="api-event">';
        $output .= '<div class="api-parameter"><strong>ID Acto:</strong> ' . esc_html($evento['Id_acto']) . '</div>';
        $output .= '<div class="api-parameter"><strong>Fecha:</strong> ' . esc_html($evento['Fecha']) . '</div>';
        $output .= '<div class="api-parameter"><strong>Hora:</strong> ' . esc_html($evento['Hora']) . '</div>';
        $output .= '<div class="api-parameter"><strong>Descripción Corta:</strong> ' . esc_html($evento['Descripcion_corta']) . '</div>';
        $output .= '<div class="api-parameter"><strong>Descripción Larga:</strong> ' . esc_html($evento['Descripcion_larga']) . '</div>';
        $output .= '<div class="api-parameter"><strong>Número de Asistentes:</strong> ' . esc_html($evento['Num_asistentes']) . '</div>';
        $output .= '<div class="api-parameter"><strong>ID Ponente:</strong> ' . esc_html($evento['id_ponente']) . '</div>';
        $output .= '</div>';
        $output .= '<div style="margin-bottom: 20px;"></div>'; // Agrega espacio entre actos
    }
    $output .= '</div>';

    return $output;
}
// Registramos el shortcode
add_shortcode('mostrar_api', 'display_api_data_shortcode');







