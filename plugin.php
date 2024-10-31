<?php

/*
Plugin Name: PClicks
Plugin URI: https://www.pclicks.com
Description: Automatically install Pclicks' tag in your blog.
Author: Pclicks
Version: 2.0
Author URI: https://www.pclicks.com
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

define("PCLICKS_PLUGIN_URL", WP_PLUGIN_URL . "/" . str_replace( basename( __FILE__ ), "", plugin_basename( __FILE__ ) ) );
define("PCLICKS_PLUGIN_DIR", str_replace( basename( __FILE__ ), "", plugin_basename( __FILE__ ) ) );
define("PC_PLUGIN_CLASS", "PClicks_Plugin");
define("RELATIVE_DIR", dirname( __FILE__ ) );

define("PCLICKS_KEY_OPTION", "pclicks_opt_key");
define("PCLICKS_PCID_OPTION", "pclicks_opt_pcid");
define("PCLICKS_MINUTES_OPTION", "pclicks_opt_minutes");
define("PCLICKS_MINUTES_OPTION_DEFAULT", '1d');

require_once( RELATIVE_DIR . '/PClicks_Plugin.php' );
require_once( RELATIVE_DIR . '/api/pclicks.php' );
require_once( RELATIVE_DIR . '/tag.php' );
require_once( RELATIVE_DIR . '/admin.php' );

add_action('admin_init', array(PC_PLUGIN_CLASS, "init"));
add_action('wp_footer', 'pclicks_tag_attach', 100);
add_action('admin_menu', 'pclicks_tag_menu');
add_action('admin_footer', 'pclicks_tag_attach_events');

$pclicks_api = new Api(get_option(PCLICKS_KEY_OPTION), get_option(PCLICKS_PCID_OPTION));

require(RELATIVE_DIR . '/dashboard.php');

?>