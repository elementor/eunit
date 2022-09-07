<?php
namespace Eunit\Cases;

use \WP_UnitTest_Factory;

/**
 * Class Eunit_Test_Case
 */
abstract class Unit_Test extends \WP_UnitTestCase {
	/**
	 * @var string
	 */
	public $namespace;
	/**
	 * @var int|WP_UnitTest_Factory
	 */
	public $subscriber;
	/**
	 * @var int|WP_UnitTest_Factory
	 */
	public $administrator;
	/**
	 * @var int|WP_UnitTest_Factory
	 */
	public $editor;
	/**
	 * @var WP_UnitTest_Factory|null
	 */
	protected $factory;

	public function get_namespace() {
		return getenv( 'EUNIT_TEST_CASE_NAMESPACE' );
	}
}
