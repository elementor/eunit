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
	 *
	 * @param string $name
	 *
	 * @return Module_Base
	 */
	public function get_plugin_module( string $name ) {
		/**
		 * @var Module_Base $module
		 */
		$module = $this->get_namespace() . '\Modules\\' . $name . '\Module';
		return $module::instance();
	}

	/**
	 * assert_const
	 *
	 * @param string $const
	 * @param mixed $expected
	 * @param mixed $actual
	 */
	public function assert_const( string $const, $expected, $actual ) : void {
		$this->assertEquals( $actual, $expected,
			'Test const ' . $const . ' is not changed!!!'
		);
	}
}
