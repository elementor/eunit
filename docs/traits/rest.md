# Rest Assertions/Helpers

`Eunit\Traits\Rest` Trait is to be used in your test suite class to allow rest API routes assertions.

!> This is subject to change

## Available Methods:
### assert_response_status
##### Description
Used to test the expected response status
##### Parameters
*`$status`*
(int) (Required) The expected response status

*`$response`*
(WP_REST_Response) (Required) The actual response containing the status
##### Failed assertion message
```
Test that the response status is correct
```
##### Example
See [Rest Test Example](test-cases/rest-route-test?id=example-full-route-test)

### assert_response_code
##### Description
Used to test the expected response code in case of `WP_Error` or response data contains a `code` element
##### Parameters
*`$code`*
(string) (Required) The expected response code string

*`$response`*
(WP_REST_Response) (Required) The actual response containing the response code
##### Failed assertion message
```
Test that the response code is correct
```
##### Example
See [Rest Test Example](test-cases/rest-route-test?id=example-full-route-test)

### assert_response_data
##### Description
Used to test the expected response data
##### Parameters
*`$data`*
(array) (Required) The expected response data

*`$response`*
(WP_REST_Response) (Required) The actual response
##### Failed assertion message
```
Test response data as expected
```
##### Example
See [Rest Test Example](test-cases/rest-route-test?id=example-full-route-test)

### dispatch_response
##### Description
Used to test and define the expected response
##### Parameters
*`$response`*
(array) (Optional) The response data as an array, you can overwrite the response `data`, `status` and `headers`
##### Example
```php
function eunit_test_custom_response() {
    $response = $this->dispatch_response( [
        'data' => [
            'message' => 'Some error message',
            'error' => true,
        ],
        'status' => 400,
    ] );
    // do you assertions against $response
}
```
