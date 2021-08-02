# Taxonomy Assertions/Helpers

`Eunit\Traits\Post_Type` Trait is to be used in your test suite class to allow post type assertions.

!> This is subject to change


## Available Methods:
### assert_taxonomy_registered
##### Description
Used to test that a given taxonomy was registered correctly
##### Parameters
*`$name`*
(string) (Required) The name of the taxonomy to test against
##### Example code to test
```php
// code to test
function eunit_example_register_taxonomy() {
    register_taxonomy( 'genre', 'book', [
        'label' => 'Genre',
        'public' => false,
        'rewrite' => false,
        'hierarchical' => true,
    ] );
}
```
##### Example usage
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunit\Traits\Taxonomy;

    function test_eunit_example_register_taxonomy() {
        // Call registering function
        \eunit_example_register_taxonomy();
        
        // Assert that registration was successful
        $this->assert_taxonomy_registered( 'genre' );
    }
}
```

### assert_taxonomy_registered_for_object
##### Description
Used to test if a taxonomy is registered to a specific object ( post type, user, ... )
##### Parameters
*`$name`*
(string) (Required) The name of the taxonomy to test against

*`$object`*
(string) (Required) The name of the object to test against

##### Example usage
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunit\Traits\Post_Type;

    function test_eunit_example_register_post_type() {
        // Call registering function
        \eunit_example_register_post_type();
        // Assert that registration was successful
        $this->assert_taxonomy_registered_for_object( 'genre', 'book' );
    }
}
```
