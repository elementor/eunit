<?php
namespace Eunit\Traits;

use WP_Error;
use WP_Http;

/**
 * Trait Remote_Request
 */
trait Remote_Request {
	/**
	 * @var mixed|array|WP_Error
	 */
	public $_mocked_response = [];

	/**
	 * @var bool
	 */
	public $mock_set = false;

	/**
	 * setup_mock_response
	 *
	 * @param array $response
	 * @param int $code
	 */
	public function setup_mock_response( array $response = [], int $code = WP_Http::OK ) : void {
		$this->_mocked_response = [
			'response' => array_merge(
				[
					'headers' => [],
					'cookies' => array(),
					'filename' => null,
					'status_code' => $code,
					'code' => $code,
					'success' => 1,
					'body' => '',
				],
				$response
			),
		];
		if ( isset( $response['body'] ) ) {
			$this->_mocked_response['body'] = $response['body'];
		}
		$this->set_mock_listener();
	}

	/**
	 * setup_mock_response_error
	 *
	 * @param string $error_message
	 * @param int $code
	 */
	public function setup_mock_response_error( string $error_message, int $code = WP_Http::OK ) : void {
		$this->_mocked_response = new WP_Error( 'mock_error', $error_message, [ 'status' => $code ] );
		$this->set_mock_listener();
	}

	/**
	 * set_mock_listener
	 */
	public function set_mock_listener() : void {
		if ( $this->mock_set ) {
			return;
		}
		add_action( 'pre_http_request', [ $this, 'mock_response' ] );
		$this->mock_set = true;
	}

	/**
	 * mock_response
	 * @return mixed|array|WP_Error
	 */
	public function mock_response() {
		return $this->_mocked_response;
	}

	/**
	 * tear_down_mock_response
	 */
	public function tear_down_mock_response() : void {
		$this->mock_set = false;
		$this->_mocked_response = null;
		remove_action( 'pre_http_request', [ $this, 'mock_response' ] );
	}
}
