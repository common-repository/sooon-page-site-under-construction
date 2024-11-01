<?php
if (!defined('ABSPATH')) exit;
/*
Template Name: Under Construction Template
*/

// Obtiene la ruta del archivo index.html
$index_file = esc_url(get_option('sooon_under_construction_template'));


// Obtiene la ruta del archivo index.html relativa a la raíz de WordPress
$upload_dir = wp_upload_dir();
$index_file_relative_path = str_replace(trailingslashit($upload_dir['basedir']), '', $index_file);

// Obtiene la URL absoluta del directorio de uploads
$upload_dir_url = $upload_dir['baseurl'];

// Construye la URL relativa del archivo index.html
$index_file_url = trailingslashit($upload_dir_url) . $index_file_relative_path;

if ($index_file != '') {
    // Comprueba si el archivo index.html existe
    if (file_exists($index_file)) {
        // Muestra el contenido del archivo index.html en un iframe
        echo '<style>body,html{margin:0;padding:0;}</style>';
        echo '<iframe src="' . esc_url($index_file_url . '"?r="' . rand(100, 999)) . '" frameborder="0" width="100%" height="100%"></iframe>';
    } else {
        // Muestra un mensaje de error si el archivo no se encuentra
        echo 'Error: Index file not found.';
    }
} else {
    echo '<p>You must upload a file created from sooon.page if you activate your "under construction" page.</p>';
    echo '<p><strong>Check the plugin settings</strong></p>';
}
