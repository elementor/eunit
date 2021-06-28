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

	/**
	 * delete_bulk
	 * @param int $object_id
	 * @param array $keys
	 */
	public static function delete_bulk( int $object_id, array $keys ) : void {
		foreach ( $keys as $key ) {
			delete_metadata( static::$meta_type, $object_id, $key );
		}
	}

	/**
	 * set_bulk
	 * @param int $object_id
	 * @param array $meta_data
	 */
	public static function set_bulk( int $object_id, array $meta_data ) : void {
		foreach ( $meta_data as $key => $value ) {
			update_metadata( static::$meta_type, $object_id, $key, $value );
		}
	}
}
