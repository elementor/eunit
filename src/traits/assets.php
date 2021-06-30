<?php
namespace Eunit\Traits;

/**
 * Trait Assets
 */
trait Assets {
	/**
	 * assert_script_enqueued
	 * @param string $handle
	 */
	public function assert_script_enqueued( string $handle ) : void {
		$this->assertTrue( wp_script_is( $handle ),
			'Test ' . $handle . ' script is enqueued if needed'
		);
	}

	/**
	 * assert_script_not_enqueued
	 * @param string $handle
	 */
	public function assert_script_not_enqueued( string $handle ) : void {
		$this->assertFalse( wp_script_is( $handle ),
			'Test ' . $handle . ' script is enqueued if not needed'
		);
	}

	/**
	 * assert_style_enqueued
	 * @param string $handle
	 */
	public function assert_style_enqueued( string $handle ) : void {
		// phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
		$style_link_tag = "<link rel='stylesheet' id='${handle}-css'";
		$this->assertContains( $style_link_tag, get_echo( 'wp_print_styles' ),
			'Test ' . $handle . ' style is enqueued if needed'
		);
	}

	/**
	 * assert_style_not_enqueued
	 * @param string $handle
	 */
	public function assert_style_not_enqueued( string $handle ) : void {
		// phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet
		$style_link_tag = "<link rel='stylesheet' id='${handle}-css'";
		$this->assertNotContains( $style_link_tag, get_echo( 'wp_print_styles' ),
			'Test ' . $handle . ' style is not enqueued if not needed'
		);
	}

	/**
	 * assert_localized_script
	 * asserts and returns data array
	 *
	 * @param string $handle
	 * @param string $variable
	 * @param bool $return
	 *
	 * @return array
	 */
	public function assert_localized_script( string $handle, string $variable, bool $return = true ) : array {
		global $wp_scripts;
		$data = $wp_scripts->get_data( $handle, 'data' );
		$this->assertContains( 'var ' . $variable, $data,
			'Test that ' . $variable . ' var is enqueued'
		);
		if ( $return ) {
			$json_string = '{' . explode( '= {', $data, 2 )[1];
			$json_string = explode( '"}', $json_string, 2 )[0] . '"}';
			return json_decode( $json_string, true );
		}
		return [];
	}
}
