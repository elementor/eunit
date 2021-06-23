<?php
namespace Eunits\Traits;

/**
 * Trait Rest
 */
trait Rest {
	/**
	 * assert_response_status
	 *
	 * @param $status
	 * @param $response
	 */
	public function assert_response_status( $status, $response ) : void {
		$this->assertEquals( $status, $response->get_status() );
	}

	/**
	 * assert_response_code
	 *
	 * @param $code
	 * @param $response
	 */
	public function assert_response_code( $code, $response ) : void {
		$this->assertEquals( $code, $response->get_data()['code'] );
	}

	/**
	 * assertResponseData
	 *
	 * @param $data
	 * @param $response
	 */
	public function assert_response_data( $data, $response ) : void {
		$response_data = $response->get_data();
		$tested_data = [];
		foreach ( $data as $key => $value ) {
			if ( isset( $response_data[ $key ] ) ) {
				$tested_data[ $key ] = $response_data[ $key ];
			} else {
				$tested_data[ $key ] = null;
			}
		}
		$this->assertEquals( $data, $tested_data );
	}
}
