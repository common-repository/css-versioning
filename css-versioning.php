<?php
/**
 * Plugin Name: CSS & JS Versioning
 * Description: Aggiunge un parametro di versione ai file CSS e JavaScript.
 * Version: 1.1
 * Author: Agarinto - Soluzioni Digitali
 * Tested up to: 6.5.3
 */

// Aggiungi il menu di impostazioni e la pagina di guida
add_action('admin_menu', 'css_js_versioning_menu');
function css_js_versioning_menu() {
    add_menu_page('CSS & JS Versioning Settings', 'CSS & JS Versioning', 'administrator', 'css-js-versioning-settings', 'css_js_versioning_settings_page', 'dashicons-admin-generic');
    add_submenu_page('css-js-versioning-settings', 'Guida su CSS & JS Versioning', 'Guida', 'administrator', 'css-js-versioning-help', 'css_js_versioning_help_page');
}

// Crea la pagina di impostazioni
function css_js_versioning_settings_page() {
    // Verifica i permessi dell'utente
    if (!current_user_can('administrator')) {
        wp_die(__('Non hai il permesso di accedere a questa pagina.', 'css-js-versioning'));
    }

    css_js_versioning_menu_style();

    // Verifica il nonce e se il pulsante 'Aggiorna CSS' o 'Aggiorna JS' è stato premuto
    if (isset($_POST['css_js_versioning_nonce']) && wp_verify_nonce($_POST['css_js_versioning_nonce'], 'css_js_versioning_update_version')) {
        if (isset($_POST['update_css'])) {
            $current_css_version = get_option('css_version_number', '1');
            $new_css_version = ++$current_css_version; // Incrementa la versione CSS
            update_option('css_version_number', $new_css_version);
        }
        if (isset($_POST['update_js'])) {
            $current_js_version = get_option('js_version_number', '1');
            $new_js_version = ++$current_js_version; // Incrementa la versione JS
            update_option('js_version_number', $new_js_version);
        }
    }

    // Ottieni le versioni correnti
    $current_css_version = get_option('css_version_number', '1');
    $current_js_version = get_option('js_version_number', '1');

    // Aggiungi CSS personalizzato
    ?>
    <style>
        .css-js-versioning-wrap {
            font-family: 'Arial', sans-serif;
            max-width: 700px;
            margin: 20px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .css-js-versioning-header {
            background-color: #f1f1f1;
            padding: 10px 15px;
            border-radius: 5px 5px 0 0;
            border-bottom: 1px solid #ccc;
        }
        .css-js-versioning-footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ccc;
        }
    </style>
    <div class="wrap css-js-versioning-wrap">
        <div class="css-js-versioning-header">
            <h1>CSS & JS Versioning</h1>
        </div>
        <form method="post">
            <?php wp_nonce_field('css_js_versioning_update_version', 'css_js_versioning_nonce'); ?>
            <input type="hidden" name="css_version_number" value="<?php echo esc_attr($current_css_version); ?>">
            <input type="hidden" name="js_version_number" value="<?php echo esc_attr($current_js_version); ?>">
            <p>Versione CSS attuale: <?php echo esc_html($current_css_version); ?></p>
            <button type="submit" class="button button-primary" name="update_css">Aggiorna CSS</button>
            <p>Versione JS attuale: <?php echo esc_html($current_js_version); ?></p>
            <button type="submit" class="button button-primary" name="update_js">Aggiorna JS</button>
        </form>
        <div class="css-js-versioning-footer">
            <p>Agarinto - Soluzioni Digitali</p>
            <a href="https://agarinto.it/" target="_blank">Visita il nostro sito</a>
        </div>
    </div>
    <?php
}

// Crea la pagina di guida
function css_js_versioning_help_page() {
    css_js_versioning_menu_style();
    // Aggiungi CSS personalizzato anche per la pagina di guida
    ?>
    <style>
        /* Stili CSS per la pagina di guida */
        h1, h2, p, ul, ol, li {
            color: #333; /* Colore del testo */
            font-family: 'Arial', sans-serif;
        }
        a {
            text-decoration: underline; /* Sottolinea i link */
            color: #0073e6; /* Colore dei link */
            transition: color 0.3s ease; /* Transizione per l'animazione del colore del link */
        }
        a:hover {
            color: #005bb9; /* Colore del link al passaggio del mouse */
        }
    </style>
    <div class="wrap">
        <h1>Guida sul Plugin CSS & JS Versioning</h1>

        <h2>Descrizione</h2>

        <p>Il plugin "CSS & JS Versioning" è uno strumento essenziale per i gestori di siti WordPress che desiderano assicurarsi che le modifiche ai loro fogli di stile CSS e JavaScript siano riconosciute e applicate immediatamente dai browser dei visitatori. Questo plugin facilita l'aggiornamento automatico dei file CSS e JavaScript, evitando problemi di caching e assicurando che i visitatori del tuo sito vedano sempre la versione più recente dei tuoi stili e script.</p>

        <h2>Caratteristiche Principali</h2>

        <ul>
            <li><strong>Aggiornamento Automatico del Versioning</strong>: Con un semplice clic, la versione dei tuoi CSS e JavaScript viene incrementata automaticamente, assicurando che i cambiamenti siano immediatamente visibili.</li>
            <li><strong>Facilità di Uso</strong>: Grazie alla sua interfaccia semplice e intuitiva, il plugin è accessibile anche a utenti senza competenze tecniche avanzate.</li>
            <li><strong>Integrazione con WordPress</strong>: Il plugin è progettato per lavorare in armonia con qualsiasi tema o plugin, garantendo che le modifiche ai CSS e JavaScript siano sempre riconosciute, indipendentemente dalla configurazione del tuo sito.</li>
        </ul>

        <h2>Uso</h2>

        <p>Dopo aver attivato il plugin:</p>

        <ol>
            <li>Vai alla pagina di impostazioni del plugin, accessibile dal menu principale di WordPress.</li>
            <li>Clicca sul pulsante "Aggiorna CSS" o "Aggiorna JS" per incrementare automaticamente la versione dei tuoi CSS o JavaScript.</li>
        </ol>

        <h2>Supporto</h2>

        <p>Se hai bisogno di supporto, hai domande, o desideri inviare feedback, visita la pagina di supporto di <a href="https://agarinto.it/support" target="_new">Agarinto - Soluzioni Digitali</a>.</p>

        <h2>Informazioni Aggiuntive</h2>

        <ul>
            <li>Sito Web: <a href="https://agarinto.it/" target="_new">Agarinto.it</a></li>
            <li>Autore: Agarinto - Soluzioni Digitali</li>
            <li>Versione corrente del plugin: 1.1</li>
        </ul>
    </div>
    <?php
}

// Stili CSS per il menu laterale
function css_js_versioning_menu_style() {
    ?>
   <style>
        .css-js-versioning-sidebar {
            float: left;
            width: 200px;
            padding: 10px;
        }
        .css-js-versioning-content {
            margin-left: 220px;
            padding: 10px;
        }
        .css-js-versioning-sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #fff;
            background-color: #0073e6; /* Colore di sfondo del pulsante */
            margin-bottom: 5px;
            border-radius: 5px; /* Border radius per angoli arrotondati */
            transition: background-color 0.3s ease; /* Transizione per l'animazione del colore */
        }
        .css-js-versioning-sidebar a:hover {
            background-color: #005bb9; /* Colore di sfondo del pulsante al passaggio del mouse */
            color: #fff; /* Mantieni il testo in bianco al passaggio del mouse */
        }
    </style>
    <div class="css-js-versioning-sidebar">
        <a href="?page=css-js-versioning-settings">Impostazioni</a>
        <a href="?page=css-js-versioning-help">Guida</a>
    </div>
    <div class="css-js-versioning-content">
    <?php
}

// Aggiungi il numero di versione ai CSS
add_filter('style_loader_tag', 'css_js_versioning_add_version_query_string', 10, 4);
function css_js_versioning_add_version_query_string($html, $handle, $href, $media) {
    $version = get_option('css_version_number', '1');
    if (strpos($href, '.css')) {
        $new_href = add_query_arg('v', $version, $href);
        return "<link rel='stylesheet' id='{$handle}-css' href='{$new_href}' media='{$media}' />";
    }
    return $html;
}

// Aggiungi il numero di versione ai JavaScript
add_filter('script_loader_src', 'css_js_versioning_add_js_version_query_string', 10, 2);
function css_js_versioning_add_js_version_query_string($src, $handle) {
    $version = get_option('js_version_number', '1');
    if (strpos($src, '.js')) {
        $new_src = add_query_arg('v', $version, $src);
        return $new_src;
    }
    return $src;
}

// Aggiungi i collegamenti alle azioni dei plugin
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'css_js_versioning_add_action_links');
function css_js_versioning_add_action_links($links) {
    $settings_link = '<a href="admin.php?page=css-js-versioning-settings">' . __('Impostazioni') . '</a>';
    $support_link = '<a href="https://agarinto.it/support" target="_blank">' . __('Supporto') . '</a>';
    array_unshift($links, $settings_link, $support_link);
    return $links;
}

// Aggiungi metadati personalizzati alla riga del plugin
add_filter('plugin_row_meta', 'css_js_versioning_add_plugin_row_meta', 10, 2);
function css_js_versioning_add_plugin_row_meta($links, $file) {
    if (strpos($file, plugin_basename(__FILE__)) !== false) {
        $new_links = array(
            'agarinto' => '<a href="https://agarinto.it/" target="_blank">Agarinto</a>',
            'details' => '<a href="https://agarinto.it/dettagli-plugin" target="_blank">Visualizza i dettagli</a>'
        );
        $links = array_merge($links, $new_links);
    }
    return $links;
}