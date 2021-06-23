<?php
namespace Eunits\Traits;

/**
 * Trait Globals
 */
trait Globals {
	/**
	 * set_global_vars
	 * @param $global
	 * @param $vars
	 */
	public function set_global_vars( $global, $vars ) {
		if ( ! $this->is_valid_global( $global ) ) {
			return;
		}
		foreach ( $vars as $key => $val ) {
			switch ( $global ) {
				case 'GLOBALS':
					$GLOBALS[ $key ] = $val;
					break;
				case 'SERVER':
					$_SERVER[ $key ] = $val;
					break;
				case 'GET':
					$_GET[ $key ] = $val;
					break;
				case 'POST':
					$_POST[ $key ] = $val;
					break;
				case 'FILES':
					$_FILES[ $key ] = $val;
					break;
				case 'COOKIE':
					$_COOKIE[ $key ] = $val;
					break;
				case 'SESSION':
					$_SESSION[ $key ] = $val;
					break;
				case 'REQUEST':
					$_REQUEST[ $key ] = $val;
					break;
				case 'ENV':
					$_ENV[ $key ] = $val;
					break;
			}
		}
	}

	/**
	 * clear_global_vars
	 * @param $global
	 * @param $vars
	 */
	public function clear_global_vars( $global, $vars ) {
		if ( ! $this->is_valid_global( $global ) ) {
			return;
		}
		foreach ( $vars as $key => $val ) {
			switch ( $global ) {
				case 'GLOBALS':
					unset( $GLOBALS[ $key ] );
					break;
				case 'SERVER':
					unset( $_SERVER[ $key ] );
					break;
				case 'GET':
					unset( $_GET[ $key ] );
					break;
				case 'POST':
					unset( $_POST[ $key ] );
					break;
				case 'FILES':
					unset( $_FILES[ $key ] );
					break;
				case 'COOKIE':
					unset( $_COOKIE[ $key ] );
					break;
				case 'SESSION':
					unset( $_SESSION[ $key ] );
					break;
				case 'REQUEST':
					unset( $_REQUEST[ $key ] );
					break;
				case 'ENV':
					unset( $_ENV[ $key ] );
					break;
			}
		}
	}

	/**
	 * is_valid_global
	 *
	 * @param string $global
	 *
	 * @return bool
	 */
	public function is_valid_global( string $global ) : bool {
		$valid_globals = [
			'GLOBALS',
			'SERVER',
			'GET',
			'POST',
			'FILES',
			'COOKIE',
			'SESSION',
			'REQUEST',
			'ENV',
		];
		return in_array( $global, $valid_globals );
	}
}
