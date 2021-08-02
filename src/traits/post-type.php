<?php
namespace Eunit\Traits;

use \WP_Post_Type;
use \RuntimeException;
/**
 * Trait Post_Type
 */
trait Post_Type {

	/**
	 * assert_post_type_registered
	 *
	 * @param string  $post_type
	 */
	public function assert_post_type_registered( string $post_type ) : void {
		$this->assertTrue( in_array( $post_type, \get_post_types() ),
			'Test Post Type ' . $post_type . ' is registered'
		);
	}

	/**
	 * assert_post_type_supports
	 * @param string $post_type
	 * @param array|string $supports
	 */
	public function assert_post_type_supports( string $post_type, $supports ) : void {
		$post_type_obj = $this->get_post_type_object( $post_type );
		// Sometimes the supports property gets dropped so we fetch it again.
		$post_type_obj->supports = \get_all_post_type_supports( $post_type );
		$features = array_filter( $post_type_obj->supports,
			function( $feature, $enabled ) {
				return $enabled;
			},
			ARRAY_FILTER_USE_BOTH
		);
		$features = array_keys( $supports );
		foreach ( (array) $supports as $support ) {
			$this->assertArrayHasValue( $support, $features,
				'Test that Post Type ' . $post_type . ' supports ' . $support
			);
		}
	}

	/**
	 * get_post_type_object
	 * @param string $post_type
	 *
	 * @return \WP_Post_Type
	 */
	private function get_post_type_object( string $post_type ) {
		$post_type_object = \get_post_type_object( $post_type );

		if ( false === $post_type_object instanceof WP_Post_Type || ! is_object( $post_type_object ) ) {
			throw new RuntimeException('Post type ' . $post_type . ' Not found' );
		}
		return $post_type_object;
	}
}
