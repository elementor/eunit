# Elementor Mocks

`Eunit\Mocks\Elementor` Class is to be used in your test suite class to allow easier creations of common mocks.

!> This is subject to change

## Available Methods:

### widget_base
##### Description
Used to mock \Elementor\Widget_Base
##### Example usage
```php
use use \Eunit\Mocks\Elementor;
class Test_Class extends \Eunit\Cases\Unit_Test {
    function test_eunit_example_set_globals() {
        Elementor::widget_base();
        // it is now safe to extend Widget_Base
        $custom_widget = new class extends Widget_Base {}         
    }
}
```

### controls_manager
##### Description
Used to mock \Elementor\Controls_Manager
##### Example
```php
use use \Eunit\Mocks\Elementor;
class Test_Class extends \Eunit\Cases\Unit_Test {
    function test_eunit_example_set_globals() {
        Elementor::widget_base();
        Elementor::controls_manager();
        // it is now safe to extend Widget_Base and use Controls_Manager
        $custom_widget = new class extends Widget_Base {
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
        }
                 
    }
}
```

### group_control_typography
##### Description
Used to mock \Elementor\Group_Control_Typography

### group_control_text_shadow
##### Description
Used to mock \Elementor\Group_Control_Text_Shadow

### dynamic_tags_module
##### Description
Used to mock \Elementor\Modules\DynamicTags\Module

### pro_dynamic_tags_module
##### Description
Used to mock \ElementorPro\Modules\DynamicTags\Module

### global_colors
##### Description
Used to mock \Elementor\Core\Kits\Documents\Tabs\Global_Colors

### global_typography
##### Description
Used to mock \ֿElementor\Core\Kits\Documents\Tabs\Global_Typography

### pro_form_widget
##### Description
Used to mock \ElementorPro\Modules\Forms\Widgets\Form

