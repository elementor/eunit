<?php
namespace Eunits\Traits;

/**
 * Trait Plugin
 */
trait Plugin {
	/**
	 * get_plugin
	 * @return mixed
	 */
	public function get_plugin() {
		$plugin = $this->get_namespace() . '\Plugin';
		return $plugin::instance();
	}

	/**
	 * get_plugin_module
	 * @param $name
	 *
	 * @return Module_Base
	 */
	public function get_plugin_module( $name ) {
		/**
		 * @var Module_Base $module
		 */
		$module = $this->get_namespace() . '\Modules\\' . $name . '\Module';
		return $module::instance();
	}
}
