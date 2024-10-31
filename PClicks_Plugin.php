<?php

class PClicks_Plugin {
  
  const HIGHCHARTS_JS = "highcharts-js";
  const STYLESHEET = "pclicks-stylesheet";
  const PROTOCOL = "https";
  
  public static function init() {
    PClicks_Plugin::_register_resources();
    PClicks_Plugin::_add_meta_box();
  }
  
  public static function add_stylesheet($page) {
    add_action("admin_print_styles-$page", PClicks_Plugin::get_callback("_enqueue_stylesheet"));
  }
  
  public static function add_highcharts_js($page) {
    add_action("admin_print_scripts-$page", PClicks_Plugin::get_callback("_enqueue_highcharts_js"));
  }
  
  public static function is_apikey_set() {
    return get_option(PCLICKS_KEY_OPTION) != "";
  }
  
  public static function get_minutes() {
    return get_option(PCLICKS_MINUTES_OPTION, PCLICKS_MINUTES_OPTION_DEFAULT);
  }
  
  public static function get_callback($name) {
    return array(__CLASS__, $name);
  }
  
  public static function get_redirect_uri($path) {
    return self::PROTOCOL . "://www.pclicks.com/redirect/" . get_option(PCLICKS_PCID_OPTION) . "?to=" . urlencode($path);
  }
  
  public static function _enqueue_stylesheet(){
    wp_enqueue_style(PClicks_Plugin::STYLESHEET);
  }
  
  public static function _enqueue_highcharts_js() {
    wp_enqueue_script(PClicks_Plugin::HIGHCHARTS_JS);
  }
  
  public static function _render_post_meta_box($post, $bar) {
    global $pclicks_api;
    
    $permalink = get_permalink($post->ID);
    $link_info = $pclicks_api->get_link_info($post->post_title, $permalink);
    
    include(RELATIVE_DIR . "/html/metabox.php");
  }
  
  private static function _register_resources() {
    wp_register_style(PClicks_Plugin::STYLESHEET, PCLICKS_PLUGIN_URL . '/css/pclicks.css');
    wp_register_script(PClicks_Plugin::HIGHCHARTS_JS, PCLICKS_PLUGIN_URL . '/thirdparty/highcharts/js/highcharts.js');
    
    add_action('admin_print_styles', PClicks_Plugin::get_callback("_enqueue_stylesheet"));
  }
  
  private static function _add_meta_box() {
    add_meta_box("pclicks-post-metabox", "PClicks Info", PClicks_Plugin::get_callback("_render_post_meta_box"), "post", "advanced", "high");
  }
}

?>