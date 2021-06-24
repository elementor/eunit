<?php
namespace Eunit\Cases;

use Eunits\Traits\Plugin;

/**
 * Class Module_Test
 */
class Module_Test extends Unit_Test {
	use Plugin;

	public $name = '';
	/**
	 * @var mixed|\WP_UnitTest_Factory
	 */
	public $module;

	public function setUp(): void {
		// Support Modules named with more then one word
		// ex: Kits_Dashboard
		$module_class_name = explode( '-', $this->name );
		$module_class_name = array_map( function( $string ) {
			return ucwords( $string );
		}, $module_class_name );
		$module_class_name = implode( '', $module_class_name );
		$this->module = $this->get_plugin_module( $module_class_name );
		parent::setUp();
	}

	public function test_module_name() {
		$this->assertTrue( $this->name === $this->module->get_name() );
	}

	/**
	 * tearDown
	 */
	public function tearDown() : void {
		parent::tearDown();
		$this->name = null;
		$this->module = null;
	}
}