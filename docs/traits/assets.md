# Assets Assertions

`Eunit\Traits\Assets` Trait is to be used in your test suite class to allow `wp_enqueue_script`, `wp_enqueue_script`, and `wp_localize_script` assertions.

!> This is subject to change

## Available Methods:

### assert_script_enqueued
##### Description
Accepts the handle used in `wp_enqueue_script` which you are expecting to be enqueued.
##### Failed assertion message
```
Test {$handle} script is enqueued if needed
```
##### Example code to test
```php
// code to test
function eunit_example_enqueue_script() {
    wp_enqueue_script( 'my_handle', 'https://script/url/script.js' );
}
```
##### Example test code
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunits\Traits\Assets;
    
    function test_eunit_example_enqueue_script() {
        $script_handle = 'my_handle';
        // first assert its not enqueued
        $this->assert_script_not_enqueued( $script_handle );
        
        // Then call actual function we want to test
        \test_eunit_example_enqueue_script();
        
        // And now lets assert its enqueued correctly
        $this->assert_script_enqueued( $script_handle );
    }
}
```

### assert_script_not_enqueued
##### Description
Accepts the handle used in `wp_enqueue_script` which you are expecting to not be enqueued.
##### Failed assertion message
```
Test {$handle} script is enqueued if not needed
```
##### Example
See [Above example](traits/assets?id=example-code-to-test)


### assert_style_enqueued
##### Description
Accepts the handle used in `wp_enqueue_style` which you are expecting to be enqueued.
##### Failed assertion message
```
Test {$handle} style is enqueued if needed
```

##### Example code to test
```php
// code to test
function eunit_example_enqueue_style() {
    wp_enqueue_style( 'my_handle', 'https://style/url/style.css' );
}
```
##### Example test code
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunits\Traits\Assets;
    
    function test_eunit_example_enqueue_style() {
        $script_handle = 'my_handle';
        // first assert its not enqueued
        $this->assert_style_not_enqueued( $script_handle );
        
        // Then call actual function we want to test
        \eunit_example_enqueue_style();
        
        // And now lets assert its enqueued correctly
        $this->assert_style_enqueued( $script_handle );
    }
}
```

### assert_style_not_enqueued
##### Description
Accepts the handle used in `wp_enqueue_style` which you are expecting to not be enqueued.
##### Failed assertion message
```
Test {$handle} style is not enqueued if not needed
```
##### Example
See [Above example](/traits/assets?id=example-code-to-test-1)

### assert_localized_script
##### Description
Accepts the handle and the variable used in `wp_localize_script` which you are expecting to be enqueued.
This method returns an empty array by default but you can pass `true` as the 3rd parameter to get the values that were enqueued for deeper testing.
##### Failed assertion message
```
Test that {$variable} var is enqueued
```
##### Example code to test
```php
// code to test
function eunit_example_localize_script() {
    wp_localize_script( 'my_handle', 'myVariable', [
        'key1' => 'value1',
        'key2' => 'value2',
    ] );
}
```
##### Example test code
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunits\Traits\Assets;
    
    function test_eunit_example_localize_script() {
        $script_handle = 'my_handle';
        $localize_variable = 'myVariable';
        // Call actual function we want to test
        \eunit_example_localize_script();
        // and make sure to trigger the actuall enqueue
        do_action( 'wp_enqueue_scripts' );
        // Then a simple test for localized script
        $this->assert_localized_script( $script_handle, $localize_variable );
        // or if you want a deeper assertion you can retrieve that actual data
        // that was localized
        $localized_data = $this->assert_localized_script( $script_handle, $localize_variable );
        $this->assertCount( 2, $localized_data,
            'Test localized script data is the expected size'
        );
        $this->assertArrayHasKey( 'key1', $localized_data,
            'Test that localized data has the expected key'
        );
        $this->assertArrayHasKey( 'key2', $localized_data,
            'Test that localized data has the expected key'
        );
    }
}
```
 
