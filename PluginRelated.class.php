<?php

/* ---------------------------------------------------------------------------
 * @Plugin Name: Related
 * @Description: Plugin to display a list of related topics
 * @Author URI: http://chiliec.ru
 * @LiveStreet Version: 0.5.1
 * @Plugin Version:	1.0.0
 * @Taken From: PSNet Similarpopup plugin
 * ----------------------------------------------------------------------------
 */

if (!class_exists("Plugin")) {
		die ("Hacking attemp!");
}

class Pluginrelated extends Plugin {
		public function Activate() {
				return true;
		}
	
		public function Deactivate() {
				return true;
		}
	
		public function Init() {}
}