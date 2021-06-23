<?php
namespace Eunits\Traits;

/**
 * Trait Mock
 */
trait Mock {
	public static function include_mock( $filename ) {
		$full_path = __DIR__ . '/../../mock/' . $filename;
		if ( file_exists( $full_path ) ) {
			include_once( $full_path );
		}
	}
}
