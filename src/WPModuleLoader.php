<?php

namespace WPModules;

class WPModuleLoader {
	public static function register($module) {
		if(is_array($module)) {
			foreach($module as $item) {
				WPModuleLoader::register($item);
			}
		} else if($module instanceof WPModule) {
			$module->register();
		} else {
			throw new \Exception('Parameter must be either an instance of WPModule or an array containing instances of WPModule');
		}
	}
}