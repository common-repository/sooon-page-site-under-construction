<?php
/*
Plugin Name: Sooon.page - Site Under Construction
Plugin URI: https://sooon.page
Description: Activa o desactiva el modo "En Construcción" para tu sitio web. Sube tu página
Version: 0.2
Author: cabohe
Requires at least: 5.5
Text Domain: sooon_site_under_construction
Domain Path: /languages
*/

if (!defined('ABSPATH')) exit;

define('SOOON_PAGES_PATH', plugin_dir_path(__FILE__));
define('SOOON_PAGES_URL', plugin_dir_url(__FILE__));

// Añade una página de configuración al menú de administración
function sooon_site_under_construction_admin_menu()
{
    add_options_page('Sooon.page - Under Construction', 'Sooon.page', 'manage_options', 'soon-site-under-construction', 'soon_site_under_construction_settings_page');
}
add_action('admin_menu', 'sooon_site_under_construction_admin_menu');

function sooon_page_load_textdomain()
{
    $domain = 'sooon_site_under_construction';
    $locale = apply_filters('plugin_locale', get_locale(), $domain);
    $mofile = SOOON_PAGES_PATH . 'languages/' . $domain . '-' . $locale . '.mo';

    // Carga el archivo MO si existe
    if (file_exists($mofile)) {
        load_textdomain($domain, $mofile);
    }
}

add_action('init', 'sooon_page_load_textdomain');

// Incluye los archivos necesarios
require_once plugin_dir_path(__FILE__) . 'includes/admin-styles.php';
require_once plugin_dir_path(__FILE__) . 'includes/settings-page.php';
require_once plugin_dir_path(__FILE__) . 'includes/template-functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/file-upload.php';
