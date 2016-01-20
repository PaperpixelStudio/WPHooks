<?php

namespace WPHooks;

class WPHookLoader {
	public static function register($hook) {
		if(is_array($hook)) {
			foreach($hook as $item) {
				WPHookLoader::register($item);
			}
		} else if( $hook instanceof WPHook) {
			$hook->register();
		} else {
			throw new \Exception('Parameter must be either an instance of WPHook or an array containing instances of WPHook');
		}
	}
}