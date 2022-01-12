# Rest Route Test

`Eunit\Cases\Rest_Route_Test`
This class should be extended to test a rest route assuming you are extending `ElementorPlatform\Rest\Route_Base` 

!> This is subject to change

### Example route class to test
```php
<?php
namespace ElementorMainNameSpace\Modules\MyTestModule\Routes\Status;

use \WP_REST_Server;
/**
 * Class info
 */
class Info extends \ElementorPlatform\Rest\Route_Base {
    public $namespace = 'api/v1'; 
	/**
     * get_endpoint
     * @return string
     */
	public function get_endpoint() : string {
		return 'status/info';
	}

	/**
     * get_name
     * @return string
     */
	public function get_name() : string {
		return 'info';
	}

	/**
     * get_methods
     * @return array
     */
	public function get_methods() : array {
		return [
			WP_REST_Server::READABLE,
		];
	}

	/**
	 * Get details request information
	 *
	 * @param \WP_REST_Request $request
	 *
	 * @return mixed|void|\WP_Error|\WP_HTTP_Response|\WP_REST_Response
	 */
	public function get( WP_REST_Request $request ) {
		$response = [
			'server' => 'up',
		];

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			$data = [
				'method' => $request->get_method(),
				'route' => $request->get_route(),
				'headers' => $request->get_headers(),
				'params' => $request->get_params(),
			];

			$response = array_merge( $response, $data );
		}
		return rest_ensure_response( $response );
	}
}
```

### Example test route class
Now, let's test this module by extending `Eunit\Cases\Rest_Route_Test`

```php
class Info_Route_Test extends Eunit\Cases\Rest_Route_Test {
    public $namespace = 'api/v1';
    public $endpoint = 'status/info';
	public $name = 'info';
	public $methods = [ \WP_REST_Server::READABLE ];
	
	/**
	 * setUp
	 */
	public function setUp() : void {
		parent::setUp();
		// We must setup $this->route with an actual instance of the route class we are testing
		// for example, this is assuming you have a module called backend and the routes are registered as components
		$this->route = $this->get_plugin_module( 'backend' )->get_component( $this->name );
	}
}
```
This alone will preform a few tests for us:
 - Test that the route is registered
 - Test route name is correct
 - Test allowed methods are correct
 - Test Endpoint is configured correctly

### Example full route test
So all that is left for us to do is test the route methods, in this case the `get` method:
```php
class Info_Route_Test extends Eunit\Cases\Rest_Route_Test {
    public $namespace = 'api/v1';
    public $endpoint = 'status/info';
	public $name = 'info';
	public $methods = [ \WP_REST_Server::READABLE ];
	
	/**
	 * setUp
	 */
	public function setUp() : void {
		parent::setUp();
		// We must setup $this->route with an actual instance of the route class we are testing
		// for example, this is assuming you have a module called backend and the routes are registered as components
		$this->route = $this->get_plugin_module( 'backend' )->get_component( $this->name );
	}

    /**
     * test_get
     */
	public function test_get() {
	    // Call the route as an unauthorized user
		$unauthorized_response = $this->dispatch_unauthorized();
		// run assertions using the provided methods from \Eunit\Traits\Rest
		$this->assert_response_status( 401, $unauthorized_response );
		$this->assert_response_code( 'rest_forbidden', $unauthorized_response );
		$this->assert_response_data( [
			'code' => 'rest_forbidden',
			'message' => 'Sorry, you are not allowed to do that.',
			'data' => [ 'status' => 401 ],
		], $unauthorized_response );

        // Now call the route as an authorized user
		$authorized_response = $this->dispatch_authorized();
		$this->assert_response_status( 200, $authorized_response );
		$this->assert_response_data( [
			'server' => 'up',
		], $authorized_response );
		// Done!
	}
}
```
## Testing dynamic endpoint routes
In the case of testing a Route which declares a dynamic endpoint ex: `user/(?P<id>[\d]+)` which expects an integer to be used as an `id` param the provided methods (_dispatch_unauthorized_ and _dispatch_authorized_) will actually dispatch the request to the dynamic endpoint without phrasing meaning instead of using `user/12` it will use `user/(?P<id>[\d]+)`. This will always resolve to `404 Not found`. In order to get around it we can set the actual route and endpoint we want before dispatching the request using the `$test_url` property of `Rest_Route_Test` class, ex:

```php
class User_Info_Route_Test extends Eunit\Cases\Rest_Route_Test {
    public $namespace = 'api/v1';
    public $endpoint = 'user/(?P<id>[\d]+)';
	public $name = 'user-info';
	public $methods = [ \WP_REST_Server::READABLE ];
	
	/**
	 * setUp
	 */
	public function setUp() : void {
		parent::setUp();
		// We must setup $this->route with an actual instance of the route class we are testing
		// for example, this is assuming you have a module called backend and the routes are registered as components
		$this->route = $this->get_plugin_module( 'backend' )->get_component( $this->name );
	}

    /**
     * test_get
     */
	public function test_get() {
	    // Call the route as an unauthorized user without setting the dynamic endpoint
		// $unauthorized_response = $this->dispatch_unauthorized();
		// this will always respond with `404` because there is no real route at api/v1/user/(?P<id>[\d]+)
		
		// so we need to set the actual test route, luckily we can do that very easy
		// say we have a user with the id of 23 (Jordan fan here), so:
		$this->test_url = $this->namespaced_route . '/user/23';
        // so at this point every request should be dispatched to our test_url 

		$unauthorized_response = $this->dispatch_unauthorized();
		// run assertions using the provided methods from \Eunit\Traits\Rest
		$this->assert_response_status( 401, $unauthorized_response );
		$this->assert_response_code( 'rest_forbidden', $unauthorized_response );
		$this->assert_response_data( [
			'code' => 'rest_forbidden',
			'message' => 'Sorry, you are not allowed to do that.',
			'data' => [ 'status' => 401 ],
		], $unauthorized_response );

        // Now call the route as an authorized user
		$authorized_response = $this->dispatch_authorized();
		$this->assert_response_status( 200, $authorized_response );
		$this->assert_response_data( [
			'firstName' => 'Michael',
			'lastName' => 'Jordan',
			'nickName' => 'M.J',
		], $authorized_response );
		// Done!
		
		// just make sure to clean up after yourself
		$this->test_url = '';
	}
}
```

## Testing authorized request with different users and capabilities
When dispatching an authorized request using `dispatch_authorized`, unless defined otherwise the `Rest_Route_Test` class will use a user with the role of **editor**.
In some cases you need a specific user, user role or a user with a specific capability so again, luckily we can do that very easy, we can actually pass the `WP_User` object or the ID of the user we want to authenticate, ex:
```php
class User_Info_Route_Test extends Eunit\Cases\Rest_Route_Test {
    public $namespace = 'api/v1';
    public $endpoint = 'user/(?P<id>[\d]+)';
	public $name = 'user-info';
	public $methods = [ \WP_REST_Server::READABLE ];
	
	/**
	 * setUp
	 */
	public function setUp() : void {
		parent::setUp();
		// We must setup $this->route with an actual instance of the route class we are testing
		// for example, this is assuming you have a module called backend and the routes are registered as components
		$this->route = $this->get_plugin_module( 'backend' )->get_component( $this->name );
	}

    /**
     * test_get
     */
	public function test_get() {
	    // setup the user as we want
	    $admin_user = self::factory()->user->create( [
			'role' => 'administrator',
		] )
        // Now call the route as an authorized user
		$authorized_response = $this->dispatch_authorized( 'GET', null, $admin_user );
		$this->assert_response_status( 200, $authorized_response );
		// Done!
	}
}
```

## Available Methods:

### dispatch_unauthorized
##### Description
Used to test a route as unauthorized user
##### Parameters
*`$method`*
(string) (Optional) The request method to dispatch defaults to `GET`

*`$query`*
(array) (Optional) An array of query/body params to add to the request.

##### Example
See [Above example](test-cases/rest-route-test?id=example-full-route-test)

### dispatch_authorized
##### Description
Used to test a route as an authorized user
##### Parameters
*`$method`*
(string) (Optional) The request method to dispatch defaults to `GET`

*`$query`*
(array) (Optional) An array of query/body params to add to the request.

*`$user`*
(mixed|WP_user|Int) (Optional) The desired user to authenticate for the request, defaults to editor role user. since (0.0.7)
##### Example
See [Above example](test-cases/rest-route-test?id=example-full-route-test)

