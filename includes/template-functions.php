<?php
if (!defined('ABSPATH')) exit;
// Función para verificar si el modo "En Construcción" está activado
function soon_site_under_construction_is_enabled()
{
    $db_sooon_page_enabled = get_option('sooon_site_under_construction_enabled');
    if (!isset($db_sooon_page_enabled) || $db_sooon_page_enabled == '' || $db_sooon_page_enabled == "0") {
        return false;
    } else {
        return true;
    }
}

// Verifica si el modo "En Construcción" está activado y redirige a la página de construcción
function soon_site_under_construction_template_redirect($template)
{

    $allowed_roles = get_option('sooon_site_under_construction_allowed_roles', array());
    if (is_array($allowed_roles) && is_user_logged_in() && array_intersect($allowed_roles, wp_get_current_user()->roles)) {
        return $template;
    }

    if (soon_site_under_construction_is_enabled() && !is_admin() && $template !== locate_template('under-construction-template.php')) {

        return plugin_dir_path(__FILE__) . 'under-construction-template.php';
    }

    return $template;
}
add_filter('template_include', 'soon_site_under_construction_template_redirect');
