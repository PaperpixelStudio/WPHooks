<?php

namespace WPModules;

/**
 * Created by Paperpixel
 * Inspired by Wordpress Plugin Boilerplate
 * https://github.com/DevinVinson/WordPress-Plugin-Boilerplate/blob/master/plugin-name/includes/class-plugin-name-loader.php
 */
abstract class WPModule {
	/**
	 * Obligatory method where you register actions or filters.
	 *
	 * @return null
	 */
	abstract function register();

	/**
	 * The array of actions registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $actions    The actions registered with WordPress to fire when the plugin loads.
	 */
	protected $actions;

	/**
	 * The array of filters registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $filters    The filters registered with WordPress to fire when the plugin loads.
	 */
	protected $filters;

	/**
	 * Register a new action with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress action that is being registered.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. he priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1.
	 */
	public function add_action( $hook, $callback, $priority = 10, $accepted_args = 1 ) {
		add_action( $hook, array( $this, $callback ), $priority, $accepted_args );
	}

	/**
	 * Register a new filter with WordPress.
	 *
	 * @since    1.0.0
	 * @param    string               $hook             The name of the WordPress filter that is being registered.
	 * @param    string               $callback         The name of the function definition on the $component.
	 * @param    int                  $priority         Optional. he priority at which the function should be fired. Default is 10.
	 * @param    int                  $accepted_args    Optional. The number of arguments that should be passed to the $callback. Default is 1
	 */
	public function add_filter( $hook, $callback, $priority = 10, $accepted_args = 1 ) {
		add_filter( $hook, array( $this, $callback ), $priority, $accepted_args );
	}
}