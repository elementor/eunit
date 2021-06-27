# Hooks Assertions

`Eunit\Traits\Hooks` Trait is to be used in your test suite class to allow action and filter hook assertions.

!> This is subject to change


## Available Methods:

### assert_action_registered
##### Description
Used to test that an action was registered correctly via `add_action`
##### Parameters
*`$action`*
(string) (Required) The name of the action

*`$callable`*
(callable) (Required) The name of the function you wish to be called

*`$priority`*
(int) (Optional) Used to specify the order in which the functions associated with a particular action are executed
__Default value__: 10

*`$message`*
(string) (Optional) Used to set a custom assertion message
##### Failed assertion message
```
Test {$callable_name} is hooked to {$action} with priority {$priority}
```
##### Example code to test
```php
// code to test
function eunit_example_add_action() {
    add_action( 'action_name', 'function_name' );
    add_action( 'another_action_name', [ SomeClass::class, 'static_class_method' ] );
    add_action( 'yet_another_action_name', [ $this, 'class_method' ], 50 );
}
```
##### Example test code
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunits\Traits\Hooks;
    
    function test_eunit_example_add_action() {
        $action1 = 'action_name';
        $callback1 = 'function_name';
        $action2 = 'another_action_name';
        $callback2 = [ SomeClass::class, 'static_class_method' ];
        $action3 = 'yet_another_action_name';
        $callback3 = [ $this, 'class_method' ];
        // make sure its not hooked if not needed
        $this->assert_action_not_registered( $action1, $callback1 );
        $this->assert_action_not_registered( $action2, $callback2 );
        // last one priority was 50 so:
        $this->assert_action_not_registered( $action3, $callback3, 50 );
        
        // call the actual function
        \eunit_example_add_action();
        // and now lets assert its all registered
        $this->assert_action_registered( $action1, $callback1 );
        $this->assert_action_registered( $action2, $callback2 );
        // last one priority was 50 so:
        $this->assert_action_registered( $action3, $callback3, 50 );
    }
}
```
### assert_action_not_registered
##### Description
Used to test that an action was not registered if not needed via `add_action`
##### Parameters
*`$action`*
(string) (Required) The name of the action

*`$callable`*
(callable) (Required) The name of the function you wish to be called

*`$priority`*
(int) (Optional) Used to specify the order in which the functions associated with a particular action are executed
__Default value__: 10

*`$message`*
(string) (Optional) Used to set a custom assertion message
##### Failed assertion message
```
Test {$callable_name} is not hooked to {$action} with priority {$priority}
```
##### Example
See [Above example](traits/hooks?id=example-code-to-test)

### assert_filter_registered
##### Description
Used to test that a filter was registered correctly via `add_filter`
##### Parameters
*`$filter`*
(string) (Required) The name of the action

*`$callable`*
(callable) (Required) The name of the function you wish to be called

*`$priority`*
(int) (Optional) Used to specify the order in which the functions associated with a particular action are executed
__Default value__: 10

*`$message`*
(string) (Optional) Used to set a custom assertion message
##### Failed assertion message
```
Test {$callable_name} is hooked to {$action} with priority {$priority}
```
##### Example code to test
```php
// code to test
function eunit_example_add_filter() {
    add_filter( 'filter_name', 'function_name' );
    add_filter( 'another_filter_name', [ SomeClass::class, 'static_class_method' ] );
    add_filter( 'yet_another_filter_name', [ $this, 'class_method' ], 50 );
}
```
##### Example test code
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunits\Traits\Hooks;
    
    function test_eunit_example_add_filter() {
        $filter1 = 'filter_name';
        $callback1 = 'function_name';
        $filter2 = 'another_filter_name';
        $callback2 = [ SomeClass::class, 'static_class_method' ];
        $filter3 = 'yet_another_filter_name';
        $callback3 = [ $this, 'class_method' ];
        // make sure its not hooked if not needed
        $this->assert_filter_not_registered( $filter1, $callback1 );
        $this->assert_filter_not_registered( $filter2, $callback2 );
        // last one priority was 50 so:
        $this->assert_filter_not_registered( $filter3, $callback3, 50 );
        
        // call the actual function
        \eunit_example_add_filter();
        // and now lets assert its all registered
        $this->assert_filter_registered( $filter1, $callback1 );
        $this->assert_filter_registered( $filter2, $callback2 );
        // last one priority was 50 so:
        $this->assert_filter_registered( $filter3, $callback3, 50 );
    }
}
```
### assert_filter_not_registered
##### Description
Used to test that a filter was not registered if not needed via `add_filter`
##### Parameters
*`$filter`*
(string) (Required) The name of the action

*`$callable`*
(callable) (Required) The name of the function you wish to be called

*`$priority`*
(int) (Optional) Used to specify the order in which the functions associated with a particular action are executed
__Default value__: 10

*`$message`*
(string) (Optional) Used to set a custom assertion message
##### Failed assertion message
```
Test {$callable_name} is not hooked to {$action} with priority {$priority}
```
##### Example
See [Above example](traits/hooks?id=example-code-to-test-1)

