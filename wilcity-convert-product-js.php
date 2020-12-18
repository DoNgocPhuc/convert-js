<?php
/*
 * Plugin Name: Wilcity Convert Product JS
 * Plugin URI: https://wilcity.com
 * Author: Wiloke
 * Author URI: https://wiloke.com
 *
 */

add_action('admin_menu', function () {
    add_menu_page(
      'Wilcity Convert JS',
      'Wilcity Convert JS',
      'administrator',
      'wilcity-convert-js',
      'wilcityConvertJS'
    );
});

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('wilcity-convert-product', plugin_dir_url(__FILE__).'script.js', ['jquery'], '1.0', true);
});

function wilcityConvertJS()
{
    ?>
    <div id="wilcity-convert-js">
        <div class="ui segment">
            <h1>Convert Wilcity JS</h1>
            <button class="wil-convert" data-action="wil_convert_wilcity_js">Do it now</button>
        </div>
    </div>
    <?php
}

add_action('wp_ajax_wil_convert_wilcity_js', function () {
    $aJSFolder = glob(get_template_directory().'/assets/production/js/*.js');
    
    foreach ($aJSFolder as $file) {
        $content = file_get_contents($file);
        $content = str_replace([
          '"https://demo.wilcityapp.com/wp-content/themes/wilcity/assets/production/js/"',
          '"http://127.0.0.1:8888/wilcity.com/wp-content/themes/wilcity/assets/production/js/"',
          '"http://localhost/wilcity2.0/wp-content/themes/wilcity/assets/production/js/"'
        ], [
          "webpack_public_path__",
          "webpack_public_path__",
          "webpack_public_path__"
        ], $content);
        
    
        file_put_contents($file, $content);
    }
    
    wp_send_json_success(['msg' => 'Converted']);
});
