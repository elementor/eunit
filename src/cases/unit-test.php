<?php
namespace Eunit\Cases;

use \WP_UnitTest_Factory;

/**
 * Class Eunit_Test_Case
 */
class Unit_Test extends \WP_UnitTestCase {
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
	private $factory;

	public function get_namespace() {
		return getenv( 'EUNIT_TEST_CASE_NAMESPACE' );
	}

	/**
	 * setUp
	 */
	public function setUp() : void {
		parent::setUp();
		// Users
		$this->subscriber = $this->factory->user->create( [ 'role' => 'subscriber' ] );
		$this->editor = $this->factory->user->create( [ 'role' => 'editor' ] );
		$this->administrator = $this->factory->user->create( [ 'role' => 'administrator' ] );
	}

	/**
	 * tearDown
	 */
	public function tearDown() : void {
		parent::tearDown();
	}
}
