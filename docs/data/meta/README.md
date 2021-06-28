# Using Meta Data helpers

The `Eunit\Data\Meta` class helps to work with Meta data API in bulk.

?> WIP could be subject to change

You should probably not want to use this class directly, but one of the extending classes:
- `Eunit\Data\Meta\User`
- `Eunit\Data\Meta\Post`
- `Eunit\Data\Meta\Comment`
- `Eunit\Data\Meta\Term`

## Available Methods:

### set_bulk
##### Description
Used to set meta data using the `update_metadata` function in bulk.
##### Parameters
*`$object_id`*
(int) (Required) object id to set the meta value for

*`$meta_data`*
(array) (Required) key value pairs of meta_key => meta_value to set


### delete_bulk
##### Description
Used to delete meta data using the `delete_metadata` function in bulk.
##### Parameters
*`$object_id`*
(int) (Required) object id to set the meta value for

*`$keys`*
(array) (Required) array of meta keys to delete.

#### Example usage
```php
// In this example we will test something with user meta
// so we will use `\Eunit\Data\Meta\User`
function test_something() {
    $user_id = 123;
    $meta_data = [
        'key_1' => 'value_1',
        'key_2' => 'value_2',
    ];
    \Eunit\Data\Meta\User::set_bulk( $user_id, $meta_data );
    
    // test something, ex:
    foreach ( $meta_data as $meta_key => $meta_value ) {
        $this->assertSame( $meta_value, \get_user_meta( $user_id, $meta_key, true ) );
    }
    
    \Eunit\Data\Meta\User::delete_bulk( array_keys( $meta_data ) );
}
```

This works the same with each of the `Eunit\Data\Meta` extending classes.
