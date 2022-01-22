# Widget Test

`Eunit\Cases\Elementor\Widget_Test` 

This class should be extended to test an elementor widget, doing so will run a few tests out of the box and will reduce code repetition.


!> This is subject to change

### Example widget class
```php
<?php
namespace ElementorMainNameSpace\Modules\MyTestModule\Widgets;

use \Elementor\Widget_base;
/**
 * Class My_Widget
 */
class My_Widget extends Widget_Base {
	public function get_name() {
	    return 'my-widget';
	}

	public function get_title() {
        return 'My Widget';
	}

	public function get_icon() {
	    return 'eicon-code';
	}

	public function get_categories() {
		return [ 'general' ];
	}

	public function get_keywords() {
		return [ 'keyword1', 'keyword2' ];
	}

	protected function register_controls() {
	    $this->start_controls_section(
			'content_section',
			[
				'label' => 'Content',
			]
		);

		$this->add_control(
			'title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => 'Title',
				'placeholder' => 'Enter your title',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo '<h3>' . $settings['title'] . '</h3>';
	}
}
```

### Base widget class tests
Let's test this Widget by extending `Eunit\Cases\Elementor\Widget_Test`.
Make sure to use import your actual widget class and alias it as `Widget_Class` this step is crucial and required. 

```php
<?php
use Eunit\Cases\Elementor\Widget_Test;
// this next line is important
use \ElementorMainNameSpace\Modules\MyTestModule\Widgets\My_Widget as Widget_Class;

class My_Widget_Test extends Widget_Test {
	public $name = 'my-widget';
	public $title = 'My Widget';
	public $icon = 'eicon-code';
	public $categories = [ 'general' ];
	public $keywords = [ 'keyword1', 'keyword2' ];
}
```
Just by doing so our widget will be tested for the default `Widget_Base` methods automatically, including:
* `get_name`
* `get_title`
* `get_icon`
* `get_categories`
* `get_keywords`


But we want to do a little more, lets test that the widget controls are registered correctly.
### Testing `register_controls`
```php
<?php
use Eunit\Cases\Elementor\Widget_Test;
// this next line is important
use \ElementorMainNameSpace\Modules\MyTestModule\Widgets\My_Widget as Widget_Class;

class My_Widget_Test extends Widget_Test {
	
	public function test_register_controls() {
	    // First we get a special instance of our widget
	    // with assertion helpers and utils.
	    $testable_controls_instance = $this->get_testable_register_controls_instance();
	    
	    // Next we can call run_register_controls to access the protected
	    // register_controls method of the widget class.
	    $testable_controls_instance->run_register_controls();
	    
	    // and now we can run our assertions, for example:
	    $this->assertArrayHasKey( 'content_section', $testable_controls_instance->sections,
			'Test controls section registered correctly'
		); 
	    $this->assertEquals( 1, $testable_controls_instance->sections_end_calls,
			'Test controls section closed balanced'
		);
		$this->assertArrayHasKey( 'title', $testable_controls_instance->controls,
		    'Test our title controls was registered correctly'
		);
	}
}
```

### Testing `render`
And last we want to test our `render` method so:
```php
<?php
use Eunit\Cases\Elementor\Widget_Test;
// this next line is important
use \ElementorMainNameSpace\Modules\MyTestModule\Widgets\My_Widget as Widget_Class;

class My_Widget_Test extends Widget_Test {

	public function test_render() {
	    // First we get a special instance of our widget
	    // with a `run_render` method 
	    $testable_render_instance = $this->get_testable_render_instance();
	    
	    // Next we can set the test settings of our widget class
	    $testable_render_instance->controls = [ 'title' => 'this works' ]; 
	    
	    // Next we can call run_render to access the protected
	    // render method of the widget class and assert the render method.
	    
	    // strip all whitespace
		$expected = '<h3>thisworks</h3>';
		$this->assertSame( $expected, preg_replace('/\s+/', '', get_echo( [ $testable_render_instance, 'run_render' ] ) ),
			'Test widget render'
		);
	}
}
```
