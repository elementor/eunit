# Plugin Assertions/Helpers

`Eunit\Traits\Hooks` Trait is to be used in your test suite class to allow action and filter hook assertions.

!> This is subject to change


## Available Methods:
### get_plugin
##### Description
Used to get an instance of a plugin, assuming the plugin is a singleton instance and has `instance` method
##### Return
A plugin instance
##### Example usage
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunit\Traits\Plugin;

    function test_eunit_example_plugin() {
        $plugin = $this->get_plugin();
        // do stuff with plugin instance
    }
}
```

### get_plugin_module
##### Description
Used to get an instance of a module, assuming the module is a singleton instance and has `instance` method
##### Parameters
*`$name`*
(string) (Required) The name of the plugin to get
##### Return
A module instance
##### Example usage
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunit\Traits\Plugin;

    function test_eunit_example_module() {
        $module = $this->get_plugin_module( 'my-test-module' );
        // do stuff with module instance
    }
}
```

### assert_const
##### Description
Used test that a const is not changed
##### Parameters
*`$const`*
(string) (Required) The name of the const
*`$expected`*
(mixed) (Required) The expected value of the const
*`$actual`*
(mixed) (Required) The actual value of the const
##### Failed assertion message
```
Test const {$const} is not changed!!!
```
##### Example usage
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunit\Traits\Plugin;

    function test_eunit_example_assert_const() {
        // Lets assume we have a const SomeClass::SPECIAL_ACTION
        // set to 'something_special'
        // and we have too much depended on it so we want to make
        // sure no one will change it
        $this->assert_const( 'SPECIAL_ACTION', 'something_special', SomeClass::SPECIAL_ACTION );
    }
}
```
