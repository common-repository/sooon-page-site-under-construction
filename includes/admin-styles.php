<?php
if (!defined('ABSPATH')) exit;
// includes/admin-styles.php

// Agrega estilos CSS personalizados
function sooon_site_under_construction_admin_styles()
{
    wp_enqueue_style('sooon-site-under-construction-admin-styles', SOOON_PAGES_URL . '/admin-styles.css');
}
add_action('admin_enqueue_scripts', 'sooon_site_under_construction_admin_styles');
