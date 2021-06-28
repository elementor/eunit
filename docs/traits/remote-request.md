# Remote_Request Assertions/Helpers

`Eunit\Traits\Remote_Request` Trait is to be used in your test suite class to allow mocking and assertions for `wp_remote_*` methods.
This is done by using the `pre_http_request` filter hook to short-circuit the HTTP request and return a value instead of making the actual request  

!> This is subject to change

## Available Methods:
### setup_mock_response
##### Description
Used to setup a mock response for `wp_remote_*` function
##### Parameters
*`$response`*
(array) (Optional) The mocked/expected response

*`$code`*
(int) (Optional) The mocked/expected response code

### setup_mock_response_error
##### Description
Used to setup an WP_Error mock response for `wp_remote_*` function
##### Parameters
*`$message`*
(string) (Required) The mocked/expected response error message 

*`$code`*
(int) (Optional) The mocked/expected response code

### tear_down_mock_response
##### Description
Used to cleanup a mocked response for `wp_remote_*` function set by any of the above methods, should be used at `tearDown`

### Example
Lets say we have an API wrapper class to fetch Chuck Norris **Facts**
```php
<?php
namespace ElementorMainNameSpace\Modules\MyTestModule\Classes;

use \WP_Error;
use \WP_Http;
/**
 * Class API
 */
class Chuck_Norris_API {
    const API_URL = 'https://api.chucknorris.io/jokes/random';
	public static function fetch() {
	    $response = wp_remote_get( self::API_URL );
	    
	    if ( is_wp_error( $response ) ) {
			return $response;
		}
		$response_code = wp_remote_retrieve_response_code( $response );
		$result = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( WP_Http::OK !== $response_code ) {
			return new WP_Error( $response_code, 'API Error' );
		}

		return $result;
	}
}
```
Using the `Eunit\Traits\Remote_Request` we can easily test it
```php
use Chuck_Norris_API;
class Test_Chuck_Norris_API extends Eunit\Cases\Unit_Test {
    use Eunit\Traits\Remote_Request;
    
    public function test_fetch() {
        // failed request
        $error_message = 'mock error response';
		$this->setup_mock_response_error( $error_message, WP_Http::BAD_REQUEST );
        $response = Chuck_Norris_API::fetch();
		$this->assertSame( $error_message, $response->get_error_message,
			'Test error message returned correctly'
		);
		
		// successful request
		$this->setup_mock_response( [
			'body' => '{"categories":[],"created_at":"2020-01-05 13:42:29.569033","icon_url":"https://assets.chucknorris.host/img/avatar/chuck-norris.png","id":"dEDAxKQER_uk3nJcZa5AAA","updated_at":"2020-01-05 13:42:29.569033","url":"https://api.chucknorris.io/jokes/dEDAxKQER_uk3nJcZa5AAA","value":"Chuck Norris wrote his autobiography in Hexadecimal."}',
		] );
		$response = Chuck_Norris_API::fetch();
		$response_data = json_decode( $response['response'] );
		$this->assertTrue( is_array( $response_data ),
		    'Test response data is a valid JSON'
		);
		$this->assertArrayHasKey( 'value', $response_data,
		    'Test response contains expected data'
		);
    }

    public function tearDown() {
        parent::tearDown();
        // and cleanup
        $this->tear_down_mock_response();
    }
}
```
