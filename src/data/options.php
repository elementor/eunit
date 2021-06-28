<?php

namespace Eunit\Data;

/**
 * Class Options
 */
class Options {
	/**
	 * set_options
	 * @param array $options key value pairs of option_name => option_value to set
	 */
	public static function set_options( array $options ) : void {
		foreach ( $options as $option_name => $option_value ) {
			\update_option( $option_name, $option_value );
		}
	}
	/**
	 * delete_options
	 *
	 * @param array $options array of option names to delete
	 */
	public static function delete_options( array $options ) : void {
		foreach ( $options as $option ) {
			\delete_option( $option );
		}
	}
}
