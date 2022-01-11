<?php

namespace Eunit\Cases;

use WP_REST_Request;
use WP_REST_Response;
use WP_REST_Server;
use Eunit\Traits\{
	Plugin, Rest
};
/**
 * Class Rest_Route
 */
abstract class Rest_Route_Test extends Unit_Test {
	use Plugin, Rest;
	/**
	 * @var string namespace of route
	 */
	public $namespaced_route = '';

	/**
	 * @var string endpoint
	 */
	public $endpoint = '';

	/**
	 * @var array methods
	 */
	public $methods = [];

	/**
	 * Test REST Server
	 * @var \WP_REST_Server
	 */
	protected $server;

	/**
	 * Route component instance
	 * @var $route
	 */
	public $route;

	/**
	 * route component name
	 * @var string
	 */
	public $name = '';

	/**
	 * Allows overriding dynamic params in endpoint
	 * @var string
	 */
	public $test_uri = '';

	/**
	 * setUp
	 */
	public function setUp(): void {
		global $wp_rest_server;
		parent::setUp();
		$wp_rest_server = new WP_REST_Server();
		$this->server = $wp_rest_server;
		do_action( 'rest_api_init' );
	}

	/**
	 * test_route_name
	 */
	public function test_route_name() {
		$this->assertTrue( $this->name === $this->route->get_name(),
			'Test route name is correct for this route'
		);
	}

	/**
	 * test_route_methods
	 */
	public function test_route_methods() {
		$methods = $this->route->get_methods();
		$this->assertEqualSets( $this->methods, $methods,
			'Test allowed methods are correct for this route'
		);
	}

	/**
	 * get_response
	 *
	 * @param bool $authorized
	 * @param string $method
	 * @param array $query
	 * @param null|WP_User|int $user
	 *
	 * @return WP_REST_Response
	 */
	public function get_response( bool $authorized = false, string $method = 'GET', array $query = [], $user = null ): WP_REST_Response {
		$uri = $this->test_url ?? ( $this->namespaced_route . '/' . $this->endpoint );
		$method = strtoupper( $method );
		if ( ! empty( $query ) && 'GET' === $method ) {
			$uri = add_query_arg( $query, $uri );
		}

		$request = new WP_REST_Request( $method, $uri );

		if ( ! empty( $query ) && in_array( $method, [ 'POST', 'PUT', 'PATCH' ] ) ) {
			$request->set_body_params( $query );
		}

		if ( $authorized ) {
			wp_set_current_user( $user ?? $this->editor );
			$request->set_header( 'X-WP-NONCE', wp_create_nonce( 'wp_rest' ) );
		} else {
			wp_set_current_user( 0 );
		}

		return $this->server->dispatch( $request );
	}

	/**
	 * dispatch_unauthorized
	 *
	 * @param string $method
	 * @param mixed|bool|array $query
	 *
	 * @return WP_REST_Response
	 */
	public function dispatch_unauthorized( string $method = 'GET', $query = null ) : WP_REST_Response {
		return $this->get_response( false, $method, $query );
	}

	/**
	 * dispatch_authorized
	 *
	 * @param string $method
	 * @param mixed|bool|array $query
	 * @param null|WP_User|int $user
	 *
	 * @return WP_REST_Response
	 */
	public function dispatch_authorized( string $method = 'GET', $query = null, $user = null ): WP_REST_Response {
		return $this->get_response( true, $method, $query );
	}

	/**
	 * test_register_route
	 * Test that the route is registered
	 */
	public function test_register_route() {
		$routes = $this->server->get_routes();
		$full_route_name = $this->namespaced_route . '/' . $this->endpoint;
		$this->assertArrayHasKey( $full_route_name, $routes,
			'Test that Route: ' . $full_route_name . ' is registered'
		);
	}

	/**
	 * test_endpoints
	 */
	public function test_endpoints() {
		$the_route = $this->namespaced_route;
		$routes = $this->server->get_routes();
		foreach ( $routes as $route => $route_config ) {
			if ( 0 !== strpos( $the_route, $route ) ) {
				continue;
			}
			$this->assertTrue( is_array( $route_config ) );
			foreach ( $route_config as $i => $endpoint ) {
				$this->assertArrayHasKey( 'callback', $endpoint );
				$this->assertArrayHasKey( 0, $endpoint['callback'], get_class( $this ) );
				$this->assertArrayHasKey( 1, $endpoint['callback'], get_class( $this ) );
				$this->assertTrue( is_callable( [ $endpoint['callback'][0], $endpoint['callback'][1] ] ) );
			}
		}
	}

	/**
	 * tearDown
	 */
	public function tearDown(): void {
		parent::tearDown();
		global $wp_rest_server;
		$wp_rest_server = null;
	}
}

