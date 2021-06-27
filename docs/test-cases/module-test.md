# Module Test

`Eunit\Cases\Module_Test` 

This class should be extended to test a module, doing so will run a few tests out of the box and will reduce code repetition.


!> This is subject to change

### Example module class
```php
<?php
namespace ElementorMainNameSpace\Modules\MyTestModule;
/**
 * Class Module
 */
class Module extends Module_Base {
	/**
	 * Get module name.
	 * Retrieve the module name.
	 * @access public
	 * @return string Module name.
	 */
	public function get_name() : string {
		return 'my-test-module';
	}
    /**
     * Module constructor.
     */
	public function __construct() {
	    $this->register_components( [
            'ComponnectA',
            'ComponnectB',
            'ComponnectC',
        ] );
	}
}
```

Let's test this module by extending `Eunit\Cases\Module_Test`

```php
class My_Module_Test extends Eunit\Cases\Module_Test {
    public $name = 'my-test-module';
}
```

Just by doing so our module will be tested and checked if its registered, named and loaded correctly to the `Modules_Manager`.
But we want to do a little more, and test that the module components are registered correctly. 

```php
<?php
class My_Module_Test extends Eunit\Cases\Module_Test {
    public $name = 'my-test-module';
    
    /**
     * test_constructor
     * @covers:Module::__construct 
     */
    public function test_constructor() {
        $expected_components = [
            'ComponnectA',
            'ComponnectB',
            'ComponnectC',
        ];
        /**
         * @var Module $module
         */
        $module = $this->module;

        $components = $module->get_components();

        $this->assertTrue( is_array( $components ),
            'Test that the components are returned as an array'
        );
        $this->assertCount( 3, count( $components ),
            'Test that the number of components are as expected'
        );
        foreach ( $expected_components as $component ) {
            $this->assertArrayHasKey( $component, $components,
                'Test that ' . $component . ' is registered'
            );
        }
    }
}
```

If you look at the above you can see that an instance of the actual module that we are testing is available for us as the `$this->module`  property which is very useful if we need to access it. 
