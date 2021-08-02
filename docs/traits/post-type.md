# Post Type Assertions/Helpers

`Eunit\Traits\Post_Type` Trait is to be used in your test suite class to allow post type assertions.

!> This is subject to change


## Available Methods:
### assert_post_type_registered
##### Description
Used to test that a given post type was registered correctly
##### Parameters
*`$name`*
(string) (Required) The name of the post type to test against
##### Example code to test
```php
// code to test
function eunit_example_register_post_type() {
    register_post_type( 'book', [
        'public'    => true,
        'label'     => __( 'Books', 'textdomain' ),
        'supports' => [ 'editor', 'title' ],
        'menu_icon' => 'dashicons-book',
    ] );
}
```
##### Example usage
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunit\Traits\Post_Type;

    function test_eunit_example_register_post_type() {
        // Call registering function
        \eunit_example_register_post_type();
        // Assert that registration was successful
        $this->assert_post_type_registered( 'book' );
    }
}
```

### assert_post_type_supports
##### Description
Used to test if a registered post type supports was registered correctly
##### Parameters
*`$name`*
(string) (Required) The name of the post type to test against

*`$supports`*
(string|array) (Required) string or array of string of features to test against

##### Example usage
```php
class Test_Class extends \Eunit\Cases\Unit_Test {
    use \Eunit\Traits\Post_Type;

    function test_eunit_example_register_post_type() {
        // Call registering function
        \eunit_example_register_post_type();
        // Assert that registration was successful
        $this->assert_post_type_supports( 'book'. [ 'editor', 'title' ] );
    }
}
```
