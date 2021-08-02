<?php
namespace Eunit\Traits;

/**
 * Trait Taxonomy
 */
trait Taxonomy {

	/**
	 * assert_taxonomy_registered
	 * @param string $taxonomy
	 */
	public function assert_taxonomy_registered( string $taxonomy ) : void {
		$this->assertTrue( \taxonomy_exists( $taxonomy ),
			'Test Taxonomy ' . $taxonomy . ' is registered'
		);
	}

	/**
	 * assert_taxonomy_registered_for_object
	 * @param string $taxonomy
	 * @param string $object
	 */
	public function assert_taxonomy_registered_for_object( string $taxonomy, string $object ) {
		$this->assertTrue( in_array( $taxonomy, \get_object_taxonomies( $object ) ),
			'Test Taxonomy ' . $taxonomy . ' is registered for' . $object
		);
	}
}
