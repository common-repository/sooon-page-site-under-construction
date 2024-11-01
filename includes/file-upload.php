<?php
// includes/file-upload.php

// Maneja la subida del archivo ZIP y la extracción de los archivos
function soon_site_under_construction_handle_file_upload()
{
    if (isset($_FILES['soon_site_under_construction_file'])) {

        if (!function_exists('wp_handle_upload')) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
        }
        $file = $_FILES['soon_site_under_construction_file'];
        $file_name = $file['name'];
        $file_error = $file['error'];

        // Verifica si hay algún error en la subida del archivo
        if ($file_error === UPLOAD_ERR_OK) {
            // Verifica la extensión del archivo
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            if ($file_ext === 'zip') {
                // Ruta donde se almacenará el archivo ZIP
                $upload_dir = wp_upload_dir();
                $zip_upload_dir = trailingslashit($upload_dir['basedir']) . 'sooon-site-under-construction/';
                // Crea la carpeta de subida si no existe
                if (!file_exists($zip_upload_dir)) {
                    wp_mkdir_p($zip_upload_dir);
                }
                $upload_overrides = array(
                    'test_form' => false
                );
                $upload_result = wp_handle_upload($file, $upload_overrides);
                echo '<pre>';
                print_r($upload_result);
                echo '</pre>';
                if ($upload_result['file']) {
                    // Extrae el contenido del archivo ZIP
                    $extracted_dir = trailingslashit($upload_dir['basedir']) . 'sooon-site-under-construction-extracted/';
                    if (!file_exists($extracted_dir)) {
                        wp_mkdir_p($extracted_dir);
                    }
                    $extracted = soon_site_under_construction_extract_zip($upload_result['file'], $extracted_dir);

                    if ($extracted) {
                        // Verifica si se encontró el archivo index.html en el ZIP extraído
                        $index_file = $extracted_dir . 'index.html';
                        if (file_exists($index_file)) {
                            // Actualiza la opción "enabled" para activar el modo "En Construcción"
                            // update_option('sooon_site_under_construction_enabled', true);

                            // Actualiza la opción "sooon_under_construction_template" con la ruta del archivo index.html
                            update_option('sooon_under_construction_template', $index_file);

                            // Guarda la URL del archivo ZIP en la opción "sooon_site_under_construction_zip_url"
                            $zip_url = trailingslashit($upload_dir['baseurl']) . 'sooon-site-under-construction/' . $file_name;
                            update_option('sooon_site_under_construction_zip_url', $upload_result['url']);

                            // Elimina el archivo ZIP y el directorio extraído
                            // unlink($uploaded_file);
                            // Redirecciona a la página de configuración con un mensaje
                            $redirect_url = admin_url('options-general.php?page=soon-site-under-construction&message=success');
                            wp_redirect($redirect_url);
                            exit();
                        }
                    }
                }
            }
        }
    }
}

// Función para extraer un archivo ZIP
function soon_site_under_construction_extract_zip($zip_file, $extract_path)
{
    $zip = new ZipArchive;
    $extracted = $zip->open($zip_file);
    if ($extracted === true) {
        $zip->extractTo($extract_path);
        $zip->close();
        return true;
    } else {
        return false;
    }
}

// Función para eliminar un directorio y su contenido de forma recursiva
function soon_site_under_construction_delete_directory($directory)
{
    if (is_dir($directory)) {
        $files = glob($directory . '*', GLOB_MARK);
        foreach ($files as $file) {
            soon_site_under_construction_delete_directory($file);
        }
        rmdir($directory);
    } elseif (is_file($directory)) {
        unlink($directory);
    }
}
