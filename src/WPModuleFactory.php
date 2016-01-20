<?php

namespace WPModules;

class WPModuleFactory {
	public static function add(WPModule $module) {
		$module->register();
	}
}