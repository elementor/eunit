<?php
namespace Eunit\Cases\Elementor;

use Eunit\Cases\Unit_Test;
use Eunit\Mocks\Elementor;
use Mockery;

/**
 * Class Widget_Test
 */
abstract class Widget_Test extends Unit_Test {
	/**
	 * @var string widget name
	 */
	public $name = '';
	/**
	 * @var string widget title
	 */
	public $title = '';
	/**
	 * @var string widget icon
	 */
	public $icon = '';
	/**
	 * @var array widget categories
	 */
	public $categories = [];
	/**
	 * @var array widget keywords
	 */
	public $keywords = [];
	/**
	 * @var null tested dynamic tag class
	 */
	public $widget = null;

	/**
	 * setUp
	 */
	public function setUp(): void {
		parent::setUp();
		$this->widget = $this->get_widget();
	}

	public function tearDown() {
		$this->widget = null;
		Mockery::close();
	}

	/**
	 * get_widget
	 * @return Widget_Class|null
	 */
	public function get_widget() {
		if ( null === $this->widget ) {
			Elementor::widget_base();
			$this->widget = new Widget_Class( [] );
		}
		return $this->widget;
	}

	/**
	 * get_testable_register_controls_instance
	 */
	public function get_testable_register_controls_instance() {
		$class_with_controls = new class extends Widget_Class {
			public $controls = [];
			public $sections_end_calls = 0;
			public $group_controls_calls = 0;
			public $sections = [];

			public function add_control( $id, $args, $options = [] ) {
				$this->controls[ $id ] = $args;
			}

			public function start_controls_section( $section_id, $args = [] ) {
				$this->sections[ $section_id ] = $args;
			}

			public function add_group_control( $group_name, $args = [], $options = [] ) {
				$this->group_controls_calls++;
			}

			public function end_controls_section() {
				$this->sections_end_calls ++;
			}

			/**
			 * run_register_controls
			 * give access to private / protected method
			 */
			public function run_register_controls() {
				$this->register_controls();
			}
		};
		Elementor::controls_manager();
		return $class_with_controls;
	}
	
	public function get_testable_render_instance() {
		return new class extends Widget_Class {
			public $settings = [];
			public function get_settings_for_display() {
				return $this->settings;
			}
			// grant access to protected method
			public function run_render() {
				$this->render();
			}
		};
	}

	/**
	 * test_widget_defaults
	 * used to test widget default methods:
	 * get_name()
	 * get_title()
	 * get_icon()
	 * get_categories()
	 * get_keywords()
	 */
	public function test_widget_defaults() {
		$widget = $this->get_widget();
		$this->assertSame( $this->name, $widget->get_name(),
			'Test Widget Name'
		);
		$this->assertSame( $this->title, $widget->get_title(),
			'Test Widget Title'
		);
		$this->assertSame( $this->icon, $widget->get_icon(),
			'Test Widget Icon'
		);
		$this->assertSame( $this->categories, $widget->get_categories(),
			'Test Widget Categories'
		);
		$this->assertSame( $this->keywords, $widget->get_keywords(),
			'Test Widget Keywords'
		);
	}
}
