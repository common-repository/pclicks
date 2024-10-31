<?php

  function pclicks_tag_menu() {
    $page = add_options_page( 'PClicks', 'PClicks', 'manage_options', 'pclicks', 'pclicks_admin' );
    PClicks_Plugin::add_stylesheet($page);
    add_filter( 'plugin_action_links', 'pclicks_tag_add_action_link', 10, 2 );
  }
  
  function pclicks_tag_error( $msg ) {
    return "<div id='message' class='error'> <p>$msg</p> </div>";
  }
  
  function pclicks_tag_success($msg){
    return "<div id='message' class='updated'> <p>$msg</p> </div>";
  }
  
  function pclicks_tag_matches($tag){
    $reg = '/PC-\d+-A/';
    
    return preg_match($reg, $tag);
  }
  
  function pclicks_is_key_ok($key, $pcid) {
    if (!isset($key))
      return false;
    
    $len = strlen($key);
    
    switch($len) {
      case 0:
        return true;
      case 40:
        $pclicks_api = new Api($key, $pcid);
        $profile_info = $pclicks_api->get_profile_info();

        if (!($profile_info == Api::CONNECTION_ERROR)) {
          return true;
        }
    }
    
    return false;
  }
  
  function pclicks_admin() {
    
    $PCLICKS_TIMES_OPTS = array(
      '5m'  => '5 minutes',
      '10m' => '10 minutes',
      '15m' => '15 minutes',
      '30m' => '30 minutes',
      '1h'  => 'last hour',
      '3h'  => '3 hours',
      '12h' => '12 hours',
      '1d'  => 'last day',
      '2d'  => '2 days'
    );
    
    if (!current_user_can('manage_options')) {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    $currentPcid = get_option(PCLICKS_PCID_OPTION);
    $currentKey = get_option(PCLICKS_KEY_OPTION);
    $currentMinutes = PClicks_Plugin::get_minutes();
    
    $msg = "";

    if (isset($_POST['submitted'])) {      
      
      $currentPcid = trim($_POST[PCLICKS_PCID_OPTION]);
      $currentKey = trim($_POST[PCLICKS_KEY_OPTION]);
      $currentMinutes = trim($_POST[PCLICKS_MINUTES_OPTION]);
      $pcid_ok = false;
      
      if (!isset($currentPcid) || strlen($currentPcid) < 1) {
        $msg = pclicks_tag_error("Please input a PCID.");
      } else if( !pclicks_tag_matches($currentPcid) ){
        $msg = pclicks_tag_error("Please input a valid PCID. Examples of valid formats are: PC-000001-A, PC-000002-A ");
      } else {
        update_option(PCLICKS_PCID_OPTION, $currentPcid);
        $msg = pclicks_tag_success("Settings updated!");
        $pcid_ok = true;
      }
      
      if ($pcid_ok) {
        if (pclicks_is_key_ok($currentKey, $currentPcid)) {
          update_option(PCLICKS_KEY_OPTION, $currentKey);
          $msg = pclicks_tag_success("Settings updated! <a href='plugins.php?page=pclicks_dashboard'>Go to Dashboard<a/>.");
        } else {
          $msg = pclicks_tag_error("Invalid API Key");
        }
      }
      
      if (isset($currentMinutes) && $PCLICKS_TIMES_OPTS[$currentMinutes] != null) {
        update_option(PCLICKS_MINUTES_OPTION, $currentMinutes);
      }
    }
    
    include(RELATIVE_DIR . '/html/admin.php');
  }  
  
  function pclicks_tag_add_action_link( $links, $file ) {
    static $this_plugin;

    if( ! $this_plugin ) $this_plugin = PCLICKS_PLUGIN_DIR . 'plugin.php';

    if ( $file == $this_plugin ) {
      $settings_link = '<a href="' . 'options-general.php?page=pclicks' . '">' . __('Settings') . '</a>';
      array_unshift( $links, $settings_link );
    }
    return $links;
  }  
  
  function pclicks_tag_attach_events(){
  ?>
      <script type='text/javascript'>
      jQuery(function(){
       jQuery(".toggle-explanation").click(function(e){
         e.preventDefault();
         jQuery(this).parent().next().toggle();
         });
       });
      </script>
    <?php
  }
?>