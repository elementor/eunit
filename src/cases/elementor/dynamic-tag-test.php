<?php
namespace Eunit\Cases\Elementor;

use Eunit\Cases\Unit_Test;
use Eunit\Mocks\Elementor;
use Mockery;

/**
 * Class Dynamic_Tag_Test
 */
abstract class Dynamic_Tag_Test extends Unit_Test {
	/**
	 * @var string tag name
	 */
	public $tag_name = '';
	/**
	 * @var string tag title
	 */
	public $tag_title = '';
	/**
	 * @var string tag group
	 */
	public $tag_group = '';
	/**
	 * @var array tag categories
	 */
	public $tag_category = [];
	/**
	 * @var null tested dynamic tag class
	 */
	public $tag = null;

	/**
	 * setUp
	 */
	public function setUp(): void {
		parent::setUp();
		$this->tag = $this->get_tag();
	}
	
	public function tearDown() {
		$this->tag = null;
		Mockery::close();
	}

	/**
	 * get_tag
	 * @return Tag_Class|null
	 */
	public function get_tag() {
		if ( null === $this->tag ) {
			$this->tag = new Tag_Class( [] );
		}
		return $this->tag;
	}

	/**
	 * get_testable_register_controls_instance
	 * @return Tag_Class
	 */
	public function get_testable_register_controls_instance() {
		$controls_override = new class extends Tag_Class {
			public $controls = null;
			public function add_control( $id, array $args, $options = [] ): void {
				$this->controls[ $id ] = $args;
			}

			/**
			 * run_register_controls
			 * wrapper around protected _register_controls
			 */
			public function run_register_controls() {
				$this->_register_controls();
			}
		};
		Elementor::controls_manager();
		return new $controls_override( [] );
	}

	/**
	 * test_get_name
	 */
	public function test_get_name() {
		$this->assertSame( $this->tag_name, $this->getTag()->get_name(),
			'Test tag name is correct'
		);
	}

	/**
	 * test_get_title
	 */
	public function test_get_title() {
		$this->assertSame( $this->tag_title, $this->getTag()->get_title(),
			'Test tag title is correct'
		);
	}

	/**
	 * test_get_category
	 */
	public function test_get_category() {
		Elementor::dynamic_tags_module();
		Elementor::pro_dynamic_tags_module();
		$this->assertSame( $this->tag_category, $this->get_tag()->get_categories(),
			'Test tag categories'
		);
	}

	/**
	 * test_get_group
	 */
	public function test_get_group() {
		Elementor::dynamic_tags_module();
		Elementor::pro_dynamic_tags_module();
		$this->assertSame( $this->tag_group, $this->get_tag()->get_group(),
			'Test tag group'
		);
	}
}
