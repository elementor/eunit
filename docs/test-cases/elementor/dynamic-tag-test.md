# Dynamic Tag Test

`Eunit\Cases\Elementor\Dynamic_Tag_Test` 

This class should be extended to test an elementor dynamic tags, doing so will run a few tests out of the box and will reduce code repetition.


!> This is subject to change

### Example dynamic tag class
```php
<?php
namespace ElementorMainNameSpace\Modules\MyTestModule\Tags;

use Elementor\Core\DynamicTags\Tag;
/**
 * Class My_Tag
 */
class My_Tag extends Tag {
	public function get_name() {
	    return 'my-tag';
	}

	public function get_title() {
        return 'My Tag';
	}

	public function get_group() {
		return 'site';
	}

	public function get_categories() {
		return [ 'text' ];
	}

	protected function _register_controls() {
		$this->add_control(
			'title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => 'Title',
				'placeholder' => 'Enter your title',
			]
		);
	}

	protected function render() {
		$title = $this->get_settings( 'title' );
		echo '<h3>' . $title . '</h3>';
	}
}
```

### Base dynamic tag class tests
Let's test this Widget by extending `Eunit\Cases\Elementor\Dynamic_Tag_Test`.
Make sure to use import your actual tag class and alias it as `Tag_Class` this step is crucial and required. 

```php
<?php
use Eunit\Cases\Elementor\Dynamic_Tag_Test;
// this next line is important
use \ElementorMainNameSpace\Modules\MyTestModule\Tags\My_Tag as Tag_Class;

class My_Tag_Test extends Dynamic_Tag_Test {
	public $name = 'my-tag';
	public $title = 'My Tag';
	public $tag_category = 'site';
	public $tag_group = [ 'text' ];
}
```
Just by doing so our dynamic tag will be tested for the default `Tag` methods automatically, including:
* `get_name`
* `get_title`
* `get_categories`
* `get_group`


But we want to do a little more, lets test that the dynamic tag controls are registered correctly.
### Testing `_register_controls`
```php
<?php
use Eunit\Cases\Elementor\Dynamic_Tag_Test;
// this next line is important
use \ElementorMainNameSpace\Modules\MyTestModule\Tags\My_Tag as Tag_Class;

class My_Tag_Test extends Dynamic_Tag_Test {
	
	public function test_register_controls() {
	    // First we get a special instance of our tag
	    // with assertion helpers and utils.
	    $testable_controls_instance = $this->get_testable_register_controls_instance();
	    
	    // Next we can call run_register_controls to access the protected
	    // register_controls method of the widget class.
	    $testable_controls_instance->run_register_controls();
	    
	    // and now we can run our assertions, for example:
	    $this->assertArrayHasKey( 'title', $testable_controls_instance->controls,
			'Test controls section registered correctly'
		);

	    $this->assertEquals( 1, $testable_controls_instance->controls,
			'Test controls count is correct'
		);
	}
}
```

### Testing `render`
And last we want to test our `render` method so:
```php
<?php
use Eunit\Cases\Elementor\Dynamic_Tag_Test;
// this next line is important
use \ElementorMainNameSpace\Modules\MyTestModule\Tags\My_Tag as Tag_Class;

class My_Tag_Test extends Dynamic_Tag_Test {

	public function test_render() {
	    // First we create a special instance of our tag
	    // with an ability to manipulate settings 
	    $testable_render_instance = new class extends Tag_Class {
	        public $settings = [];
	        public function get_settings( $setting = '' ) {
	            if ( '' !== $setting ) {
	                return $this->settings[ $setting ] ?? '';
	            } 
	            return $this->settings;
	        }
	    }
	    
	    // Next we can set the test settings of our widget class
	    $testable_render_instance->controls = [ 'title' => 'this works' ]; 
	    
	    // Next we can call render to assert the render method.
	    
	    // strip all whitespace
		$expected = '<h3>thisworks</h3>';
		$this->assertSame( $expected, preg_replace('/\s+/', '', get_echo( [ $testable_render_instance, 'render' ] ) ),
			'Test tag render'
		);
	}
}
```
