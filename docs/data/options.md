# Options

The `Eunit\Data\Options` class helps to work with options API in bulk.

!> This is subject to change

## Available Methods:

### set_options
##### Description
Used to set options using the `update_option` function
##### Parameters
*`$options`*
(array) (Required) key value pairs of option_name => option_value to set

### delete_options
##### Description
Used to set options using the `delete_option` function
##### Parameters
*`$options`*
(array) (Required) array of option names to delete

#### Example usage
```php
function test_something() {
    $options = [
        'option_1' => 'value_1',
        'option_2' => 'value_2',
    ];
    \Eunit\Data\Options::set_options( $options );
    
    foreach ( $options as $option_name => $option_value ) {
        $this->assertSame( $option_value, get_option( $option_name ) );
    }
    
    \Eunit\Data\Options::delete_options( array_keys( $options ) );
}
```
