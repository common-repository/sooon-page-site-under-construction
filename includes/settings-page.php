<?php
if (!defined('ABSPATH')) exit;
// includes/settings-page.php

// Función que muestra el contenido de la página de configuración
function soon_site_under_construction_settings_page()
{
    // Obtiene el valor actual de la opción "enabled"
    $enabled = boolval(get_option('sooon_site_under_construction_enabled', false));

    // Obtiene la URL del archivo ZIP actual, si existe
    $zip_url = esc_url(get_option('sooon_site_under_construction_zip_url', ''));

    // Obtiene los perfiles de usuario disponibles
    $roles = wp_roles()->get_names();

    // Obtiene los perfiles de usuario permitidos guardados
    $allowed_roles = get_option('sooon_site_under_construction_allowed_roles', array());
    // Scape Array
    if (!is_array($allowed_roles)) {
        $allowed_roles = array();
    }

?>

    <div class="wrap sooon-settings-wrap">
        <img src="<?php echo esc_url(SOOON_PAGES_URL); ?>/assets/brand/logo_sooon_240.png" class="settings_logo" />
        <?php if (isset($_GET['message']) && $_GET['message'] === 'success') : ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e("The ZIP file has been uploaded and the files of the page under construction have been successfully configured!", "sooon_site_under_construction"); ?></p>
            </div>
        <?php endif; ?>
        <div class="sooon-settings-container">
            <div class="sooon-settings-main-info">
                <div class="initial_guide">
                    <h1><?php _e("Quick guide", "sooon_site_under_construction"); ?></h1>
                    <p><?php _e("This plugin allows you to show your visitors the fantastic under construction page created at <a href=\"https://sooon.page/\" target=\"_blank\">Sooon.page</a>. To achieve this, follow these steps:", "sooon_site_under_construction"); ?></p>
                    <ol>
                        <li><?php _e("<a href=\"https://sooon.page/?lang=es&action=create\" target=\"_blank\">Create your page from sooon.page</a> and download the ZIP file with your \"Under Construction\" page.", "sooon_site_under_construction"); ?></li>
                        <li><?php _e("If you already have the file with your page, upload it using the form below.", "sooon_site_under_construction"); ?></li>
                        <li><?php _e("If you make changes to your page, simply re-upload the file.", "sooon_site_under_construction"); ?></li>
                        <li><?php _e("You can activate or deactivate the \"Under Construction\" mode at any time.", "sooon_site_under_construction"); ?></li>
                    </ol>
                </div>
                <div class="configuration">
                    <h1><?php _e("Configuration", "sooon_site_under_construction"); ?></h1>
                    <form method="post" action="" enctype="multipart/form-data">
                        <?php wp_nonce_field('soon_site_under_construction_settings', 'soon_site_under_construction_nonce'); ?>

                        <table class="form-table" role="presentation">
                            <tbody>
                                <tr>
                                    <th scope="row"><label for="soon_site_under_construction_file"><?php _e("Page file", "sooon_site_under_construction"); ?></label></th>
                                    <td>
                                        <?php if ($zip_url) : ?>
                                            <p><b><?php _e("A configured page file already exists", "sooon_site_under_construction"); ?></b> (<code><?php echo esc_url($zip_url); ?></code>).</p>
                                            <p class="note"><?php printf(
                                                                /* translators: %s: file url */
                                                                wp_kses(__('If you want <a href="%s">you can download it</a> to edit it in sooon.page and then upload it here, with the changes made', 'sooon_site_under_construction'), 'post'),
                                                                esc_url($zip_url)
                                                            ); ?>.</p>
                                            <hr />
                                        <?php endif; ?>
                                        <input type="file" id="soon_site_under_construction_file" name="soon_site_under_construction_file" />
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row"><?php _e("Under construction", "sooon_site_under_construction"); ?></th>
                                    <td>
                                        <fieldset>
                                            <legend class="screen-reader-text"><span><?php _e("Under construction", "sooon_site_under_construction"); ?></span></legend>
                                            <label for="sooon_site_under_construction_enabled">
                                                <input name="sooon_site_under_construction_enabled" type="checkbox" id="sooon_site_under_construction_enabled" value="1" <?php checked($enabled, true); ?>>
                                                <?php _e("Activate the \"Under Construction\" mode", "sooon_site_under_construction"); ?>
                                            </label>
                                        </fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row"><?php _e("Access", "sooon_site_under_construction"); ?></th>
                                    <td>
                                        <fieldset>
                                            <legend class="screen-reader-text"><span><?php _e("Full wordpress site access settings.", "sooon_site_under_construction"); ?></span></legend>
                                            <p><?php _e("User profiles that can access:", "sooon_site_under_construction"); ?></p>
                                            <select name="sooon_site_under_construction_allowed_roles[]" id="sooon_site_under_construction_allowed_roles" multiple>
                                                <?php
                                                foreach ($roles as $role => $name) {
                                                    echo '<option value="' . esc_attr($role) . '" ' . selected(in_array($role, $allowed_roles), true, false) . '>' . esc_html($name) . '</option>';
                                                }
                                                ?>
                                            </select>
                                            <p class="note"><?php _e("If none profile selected, every profile see the coming soon page. To deselct a profile press CTRL/CMD key and mouse click.", "sooon_site_under_construction"); ?></p>
                                        </fieldset>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="submit" name="soon_site_under_construction_submit" class="button button-primary" value="<?php _e("Save settings", "sooon_site_under_construction"); ?>">
                    </form>
                </div>

            </div>
            <div class="sooon-features">
                <div class="card sooon-no-padding">
                    <div class="sooon-card-content">
                        <h2 class="title"><?php _e("What Sooon.page has to offer", "sooon_site_under_construction"); ?></h2>
                        <ul class="sooon_featured_list">
                            <li><?php _e("Background sliders, with images, colors or gradients", "sooon_site_under_construction"); ?></li>
                            <li><?php _e("Newsletter forms, configuration in a minute.", "sooon_site_under_construction"); ?></li>
                            <li><?php _e("Super customizable buttons", "sooon_site_under_construction"); ?></li>
                            <li><?php _e("Check the <a target=\"_blank\" href=\"https://sooon.page/web/en/features-and-prices/\">features and prices in detail</a>", "sooon_site_under_construction"); ?></li>
                        </ul>
                    </div>
                    <div class="sooon-card-slideshow">
                        <div class="3mins_video"><a target="_blank" href="https://www.youtube.com/watch?v=X2MxPp1TjBY&t=5s">3min video</a></div>
                        <div class="news_prov"><a target="_blank" href="https://sooon.page/web/en/documentation/newsletter-forms-configuration/">provs newsletter</a></div>
                        <div class="no_reg_free"><a target="_blank" href="https://sooon.page/?lang=es&action=create">no reg free </a></div>
                        <div class="news_tpls"><a target="_blank" href="https://sooon.page/web/en/coming-soon-templates/?tpls_features=newsletter-form">plantillas newsletter</a></div>
                        <div class="all_tpls"><a target="_blank" href="https://sooon.page/web/en/coming-soon-templates/">plantillas </a></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
}


function soon_site_under_construction_settings_submited()
{

    // Verifica si el formulario ha sido enviado y actualiza la configuración
    if (isset($_POST['soon_site_under_construction_submit'])) {
        // Verifica el nonce para mayor seguridad
        if (wp_verify_nonce(sanitize_text_field($_POST['soon_site_under_construction_nonce']), 'soon_site_under_construction_settings')) {
            // Llamada a la función de subida de archivos ZIP
            soon_site_under_construction_handle_file_upload();
            // Sanitize checkbox
            if (null !== (filter_var($_POST['sooon_site_under_construction_enabled'], FILTER_SANITIZE_NUMBER_INT))) {
                $sooon_under_construction_enabled_boolean = filter_var($_POST['sooon_site_under_construction_enabled'], FILTER_SANITIZE_NUMBER_INT);
            } else {
                $sooon_under_construction_enabled_boolean = 0;
            }
            update_option('sooon_site_under_construction_enabled',  $sooon_under_construction_enabled_boolean);


            // Validate Roles Array - Set to empty and check if array contain real roles before updating into database.
            $sooon_under_construction_roles_with_access = [];
            $sooon_allowed_roles = isset($_POST['sooon_site_under_construction_allowed_roles']) ? (array) $_POST['sooon_site_under_construction_allowed_roles'] : array();
            $sooon_allowed_roles = array_map('esc_attr', $sooon_allowed_roles);
            if (is_array($sooon_allowed_roles) && count($sooon_allowed_roles) > 0) {
                $web_active_roles = wp_roles()->get_names();
                $all_ok = true;
                foreach ($sooon_allowed_roles as $key => $c_role) {
                    if (!array_key_exists($c_role, $web_active_roles)) {
                        $all_ok = false;
                    }
                }
                // If all values in array are existing roles, assign the original array to the inserted array. If fails, insert empty Array
                if ($all_ok) {
                    $sooon_under_construction_roles_with_access = $sooon_allowed_roles;
                }
            }
            update_option('sooon_site_under_construction_allowed_roles', $sooon_under_construction_roles_with_access); // Guarda los perfiles de usuario permitidos
        }
    }
}
add_action('wp_loaded', 'soon_site_under_construction_settings_submited');
