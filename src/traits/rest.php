<?php
namespace Eunits\Traits;

use \WP_REST_Response;
/**
 * Trait Rest
 */
trait Rest {
	/**
	 * assert_response_status
	 *
	 * @param int $status
	 * @param WP_REST_Response $response
	 */
	public function assert_response_status( int $status, WP_REST_Response $response ) : void {
		$this->assertEquals( $status, $response->get_status(),
			'Test that the response status is correct'
		);
	}

	/**
	 * assert_response_code
	 *
	 * @param string $code
	 * @param WP_REST_Response $response
	 */
	public function assert_response_code( string $code, WP_REST_Response $response ) : void {
		$this->assertEquals( $code, $response->get_data()['code'],
			'Test that the response code is correct'
		);
	}

	/**
	 * assertResponseData
	 *
	 * @param array $data
	 * @param WP_REST_Response $response
	 */
	public function assert_response_data( array $data, WP_REST_Response $response ) : void {
		$response_data = $response->get_data();
		$tested_data = [];
		foreach ( $data as $key => $value ) {
			if ( isset( $response_data[ $key ] ) ) {
				$tested_data[ $key ] = $response_data[ $key ];
			} else {
				$tested_data[ $key ] = null;
			}
		}
		$this->assertEquals( $data, $tested_data,
			'Test response data as expected'
		);
	}

	/**
	 * dispatch_with_response
	 *
	 * @param array $response
	 *
	 * @return WP_REST_Response
	 */
	public function dispatch_response( array $response ) : WP_REST_Response {
		$response = array_merge( [
			'data' => [],
			'status' => 200,
			'headers' => [],
		], $response );
		return new WP_REST_Response( $response['data'], $response['status'], $response['headers'] );
	}
}
