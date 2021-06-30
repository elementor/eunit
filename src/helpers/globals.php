<?php
namespace Eunit\Helpers;

/**
 * Class Globals
 */
class Globals {
	const GLOBAL_GLOBALS = 'GLOBALS';
	const GLOBAL_SERVER = 'SERVER';
	const GLOBAL_GET = 'GET';
	const GLOBAL_POST = 'POST';
	const GLOBAL_FILES = 'FILES';
	const GLOBAL_COOKIE = 'COOKIE';
	const GLOBAL_SESSION = 'SESSION';
	const GLOBAL_REQUEST = 'REQUEST';
	const GLOBAL_ENV = 'ENV';

	/**
	 * set_global_vars
	 *
	 * @param string $global
	 * @param array $key_value_pairs
	 */
	public static function set_global_vars( string $global, array $key_value_pairs ) {
		if ( ! self::is_valid_global( $global ) ) {
			return;
		}
		foreach ( $key_value_pairs as $key => $val ) {
			switch ( $global ) {
				case self::GLOBAL_GLOBALS:
					$GLOBALS[ $key ] = $val;
					break;
				case self::GLOBAL_SERVER:
					$_SERVER[ $key ] = $val;
					break;
				case self::GLOBAL_GET:
					$_GET[ $key ] = $val;
					break;
				case self::GLOBAL_POST:
					$_POST[ $key ] = $val;
					break;
				case self::GLOBAL_FILES:
					$_FILES[ $key ] = $val;
					break;
				case self::GLOBAL_COOKIE:
					$_COOKIE[ $key ] = $val;
					break;
				case self::GLOBAL_SESSION:
					$_SESSION[ $key ] = $val;
					break;
				case self::GLOBAL_REQUEST:
					$_REQUEST[ $key ] = $val;
					break;
				case self::GLOBAL_ENV:
					$_ENV[ $key ] = $val;
					break;
			}
		}
	}

	/**
	 * clear_global_vars
	 *
	 * @param string $global
	 * @param array $keys
	 */
	public static function clear_global_vars( string $global, array $keys ) {
		if ( ! self::is_valid_global( $global ) ) {
			return;
		}
		foreach ( $keys as $key ) {
			switch ( $global ) {
				case self::GLOBAL_GLOBALS:
					unset( $GLOBALS[ $key ] );
					break;
				case self::GLOBAL_SERVER:
					unset( $_SERVER[ $key ] );
					break;
				case self::GLOBAL_GET:
					unset( $_GET[ $key ] );
					break;
				case self::GLOBAL_POST:
					unset( $_POST[ $key ] );
					break;
				case self::GLOBAL_FILES:
					unset( $_FILES[ $key ] );
					break;
				case self::GLOBAL_COOKIE:
					unset( $_COOKIE[ $key ] );
					break;
				case self::GLOBAL_SESSION:
					unset( $_SESSION[ $key ] );
					break;
				case self::GLOBAL_REQUEST:
					unset( $_REQUEST[ $key ] );
					break;
				case self::GLOBAL_ENV:
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
	public static function is_valid_global( string $global ) : bool {
		$valid_globals = [
			self::GLOBAL_GLOBALS,
			self::GLOBAL_SERVER,
			self::GLOBAL_GET,
			self::GLOBAL_POST,
			self::GLOBAL_FILES,
			self::GLOBAL_COOKIE,
			self::GLOBAL_SESSION,
			self::GLOBAL_REQUEST,
			self::GLOBAL_ENV,
		];
		return in_array( $global, $valid_globals );
	}
}
