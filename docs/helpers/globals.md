# Global Helpers

`Eunit\Traits\Globals` Trait is to be used in your test suite class to allow easier setting and cleanup of super globals.

!> This is subject to change

## Available Methods:

### set_global_vars
##### Description
Used to set A super global variables at bulk
##### Parameters
*`$global`*
(string) (Required) The name of the super global, supported globals are: 
`GLOBALS`,`SERVER`,`GET`,`POST`,`FILES`,`COOKIE`,`SESSION`,`REQUEST`,`ENV`

*`$key_value_pairs`*
(array) (Required) An array of key => value pairs, to set in the super global

##### Example usage
```php
use \Eunits\Helpers\Globals; 
class Test_Class extends \Eunit\Cases\Unit_Test {
    
    function test_eunit_example_set_globals() {
        // lets set $_POST with some data for our test
        $key_value_pair = [
            'key1' => 'value1',
            'key2' => 'value2',
        ];
        Globals::set_global_vars( Globals::GLOBAL_POST, $key_value_pair );
        
        // do you tests, for example
        $this->assertArrayHasKey( 'key1', $_POST );
        $this->assertArrayHasKey( 'key2', $_POST );
        
        // now lets cleanup
        Globals::clear_global_vars( Globals::GLOBAL_POST, array_keys( $key_value_pair ) ); 
    }
}
```

### clear_global_vars
##### Description
Used remove A super global variables at bulk
##### Parameters
*`$global`*
(string) (Required) The name of the super global, supported globals are:
`GLOBALS`,`SERVER`,`GET`,`POST`,`FILES`,`COOKIE`,`SESSION`,`REQUEST`,`ENV`

*`$keys`*
(array) (Required) An array of keys to unset from the super global
##### Example
See [Above example](helpers/globals?id=example-usage)

