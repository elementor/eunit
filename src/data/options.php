<?php

namespace Eunit\Data;

/**
 * Class Options
 */
class Options {
	public function delete_options( $options ) {
		foreach ( $options as $option ) {
			delete_option( $option );
		}
	}
}
