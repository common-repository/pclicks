=== Plugin Name ===
Contributors: PClicks
Tags: pclicks, webanalytics
Requires at least: 2.6
Tested up to: 3.1.3
Stable tag: 2.0

Installs PClicks' javascript tracking code into the footer of your WordPress blog, enabling you to monitor visitors' behavior.

== Description ==

PClicks is a simple to use real-time click analysis tool. This means that with PClicks you are able to see users' behavior while browsing your website at almost the same time they are using it.

This plugin installs the necessary Javascript Code into the footer of your WordPress blog in order to track these clicks.
Before the javascript code is installed, you need to inform your profile PCID into the Settings page of PClicks plugin.

== Installation ==

1. Unzip 'pclicks-tag.zip' to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Go to the "PClicks" menu item under "Settings" in order to configure which profile you want to track.
4. At PClicks' Settings page, insert the desired Profile PCID. Promptly after inserting it, PClicks' tracking will be rendered into your WordPress blog.

PS: Some features of this plugin require PHP cURL lib (http://php.net/manual/en/book.curl.php).

== Frequently Asked Questions ==

= How can I use PClicks / PClicks plugin? =
Before using this plugin you will need a PClicks account; if you don't have one, visit us at https://www.pclicks.com and sign up for a free account! 
With your account you will be able to create a profile for you WordPress blog.

= What is a PCID? =

A PCID is an unique identifier for a profile you own inside PClicks; a profile refers to a web page you want to track. 

= What is an Api Key? =

In order to access our API you need to generate a key; this key will be linked to your account and will be necessary for any request you initiate with our services.

= Why I can't see my PClicks dashboard?

If you want to see the PClicks dashboard in your wordpress you need to install PHP cURL lib (http://php.net/manual/en/book.curl.php).



== Screenshots ==

1. PClicks
2. In this screenshot we see the PCID "PC-000093-A" assigned for the target URL "http://www.seibzhen.com/integration2.html", both in red outlines; this plugin will install the javascript tracking code in green.
3. This Dashboard is available when you set your Api Key in the PClicks settings.
4. ...

== Changelog ==

= 2.0 =
* Now you can see some information from PClicks directly in the admin section of your wordpress.


= 1.0 =
* Initial version.