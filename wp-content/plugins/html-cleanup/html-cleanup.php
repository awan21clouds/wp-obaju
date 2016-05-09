<?php
/*
Plugin Name: HTML Cleanup
Plugin URI: https://davidlyness.com/html-cleanup
Description: A plugin to replace or remove lines of HTML generated by Wordpress and other plugins based on predefined regular expressions.
Version: 1.2.5
Author: David Lyness
Author URI: https://davidlyness.com
License: GPLv2
*/

// File to get / set administrative options
require_once(dirname(__FILE__) . '/settings.php');

// Do the actual filtering by performing regex search & replace operations
function html_cleanup_callback($buffer) {
	if ((!is_admin()) && ((!isset($_GET['cleanupoverride'])) || ($_GET['cleanupoverride'] !== get_option('cleanup_override'))) && (get_option('blacklisted_patterns'))) {
		if (get_option('blacklist_replace_flag')) {
			$replaceString = get_option('blacklist_replace_string');
			$patternNewline = '';
		} else {
			$replaceString = '';
			$patternNewline = "(\r*\n)*";
		}
		$badPatterns = split("\r\n", get_option('blacklisted_patterns'));
		foreach ($badPatterns as $pattern) {
			$buffer = preg_replace('/.*' . $pattern . '.*' . $patternNewline . '/', $replaceString, $buffer);
		}
	}
	return $buffer;
}

 // Begin filtering content from the time this script is loaded, buffering the HTML output of the page so that it can be filtered by the html_cleanup_callback function
add_action("init", "html_cleanup_buffer_start");
function html_cleanup_buffer_start() {
	ob_start("html_cleanup_callback");
	if (get_option('cleanup_comment') === "on") {
		echo "<!-- This is a sample line of HTML, added by the HTML Cleanup plugin (https://davidlyness.com/plugins/html-cleanup), so that you can try out the plugin's filtering functionality. Try blacklisting the following sequence of characters to remove it, or see the plugin's settings page for more information: 3UYbKPTEsahhppWL -->\r\n";
	}
}

 // End filtering after entire page has been generated, and perform the necessary filtering
register_shutdown_function('html_cleanup_buffer_end');
function html_cleanup_buffer_end() {
        if (ob_get_level()) {
                ob_end_flush();
        }
}

?>