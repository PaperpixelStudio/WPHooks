<?php

namespace WPModules;

class WPModuleFactory {
	public static function add($module) {
		if(is_array($module)) {
			foreach($module as $item) {
				WPModuleFactory::add($item);
			}
		} else if($module instanceof WPModule) {
			$module->register();
		} else {
			throw new \Exception('Parameter must be either an instance of WPModule or an array containing instances of WPModule');
		}
	}
}