<?php
namespace Eunit\Traits;

/**
 * Trait Hooks
 */
trait Hooks {
	/**
	 * assert_action_registered
	 *
	 * @param string $action
	 * @param mixed|null|callable $callable
	 * @param int $priority
	 * @param mixed|null|string $message
	 */
	public function assert_action_registered( string $action = '', $callable = null, int $priority = 10, string $message = null ) : void {
		$message = $this->format_filter_message( $action, $callable, $priority, $message );
		$this->assertEquals( $priority, has_action( $action, $callable ), $message );
	}

	/**
	 * assert_action_not_registered
	 *
	 * @param string $action
	 * @param mixed|null|callable $callable
	 * @param int $priority
	 * @param mixed|null|string $message
	 */
	public function assert_action_not_registered( string $action = '', $callable = null, int $priority = 10, string $message = null ) : void {
		$message = $this->format_filter_message( $action, $callable, $priority, $message, false );
		$this->assertNotEquals( $priority, has_action( $action, $callable ), $message );
	}

	/**
	 * assert_filter_registered
	 * @param string $filter
	 * @param null $callable
	 * @param int $priority
	 * @param string $message
	 */
	public function assert_filter_registered( string $filter = '', $callable = null, int $priority = 10, string $message = '' ) : void {
		$message = $this->format_filter_message( $filter, $callable, $priority, $message );
		$this->assertEquals( $priority, has_filter( $filter, $callable ), $message );
	}

	/**
	 * assert_filter_not_registered
	 * @param string $filter
	 * @param null $callable
	 * @param int $priority
	 * @param string $message
	 */
	public function assert_filter_not_registered( string $filter = '', $callable = null, int $priority = 10, string $message = '' ) : void {
		$message = $this->format_filter_message( $filter, $callable, $priority, $message, false );
		$this->assertNotEquals( $priority, has_filter( $filter, $callable ), $message );
	}

	/**
	 * format_filter_message
	 *
	 * @param string $action
	 * @param mixed|null|callable $callable
	 * @param int $priority
	 * @param mixed|null|string $message
	 * @param bool $hooked
	 *
	 * @return string
	 */
	public function format_filter_message( string $action = '', $callable = null, int $priority = 10, string $message = null, $hooked = true ) : string {
		$callable_name = $callable;
		if ( is_array( $callable ) && isset( $callable[1] ) ) {
			$callable_name = $callable[1];
		}
		$not = $hooked ? '' : 'not ';
		return ! empty( $message ) ? $message : "Test {$callable_name} is {$not}hooked to '{$action}' with priority {$priority}";
	}
}
