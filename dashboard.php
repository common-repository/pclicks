<?php

define( "DASHBOARD_TITLE", "PClicks" );
define( "DASHBOARD_MENU", "PClicks" );
define( "DASHBOARD_CAP", "read" );
define( "DASHBOARD_SLUG", "pclicks_dashboard" );
define( "DASHBOARD_CB_FN", "_render_dashboard" );

define("CONN_ERROR_MESSAGE", "Sorry, we can't handle your request. Please, try again later.");

function _render_dashboard() {
  global $pclicks_api;
  
  if (!PClicks_Plugin::is_apikey_set()) {
    echo "<div id='pclicks-content' class='pclics-apikey-error updated'><p>You need to <a href='options-general.php?page=pclicks'>set your API Key</a>.</p></div>";
    return;
  }
  
  $toplinks = $pclicks_api->get_top_links();
  $topgroups = $pclicks_api->get_top_groups();
  $clicks_historical = $pclicks_api->get_clicks_historical();
  
  $clicks_historical_json_time = _to_json_list_notation(array_keys($clicks_historical["totalClicks"]), true, true);
  $clicks_historical_json_clicks = _to_json_list_notation(array_values($clicks_historical["totalClicks"]));
  
  require( RELATIVE_DIR . "/html/dashboard.php" );
}

function _to_json_list_notation($data, $string = false, $formatDate = false) {
  $strrepr = "[ ";
  $count = count($data);
  for ($i = 0; $i < $count; $i++) {
    $value = $formatDate ? date("d H:i", ($data[$i] / 1000)) : $data[$i];
    
    if ($i < $count - 1) {
      $strrepr .= $string ? "'$value', " : "$value, ";
    } else {
      $strrepr .= $string ? "'$value' ]" : "$value ]";
    }
  }
  return $strrepr;
}

function create_dashboard_page( ) {
  $dashboardPage = add_plugins_page( DASHBOARD_TITLE, DASHBOARD_MENU, DASHBOARD_CAP, DASHBOARD_SLUG, DASHBOARD_CB_FN );
  
  PClicks_Plugin::add_highcharts_js($dashboardPage);
}

add_action('admin_menu', 'create_dashboard_page');

?>