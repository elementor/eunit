<?php

namespace Eunit\Data\Meta;

/**
 * class Meta
 */
class Meta {
	/**
	 * @var string
	 */
	public static $meta_type = '';

	public function delete_bulk( int $object_id, array $keys ) {
		foreach ( $keys as $key ) {
			delete_metadata( static::$meta_type, $object_id, $key );
		}
	}

	public function set_bulk( string $meta_type, int $object_id, array $meta_data ) {
		foreach ( $meta_data as $key => $value ) {
			update_metadata( static::$meta_type, $object_id, $key, $value );
		}
	}
}
