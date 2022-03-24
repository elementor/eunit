<?php
namespace Eunit\Cases;

use Exception;
use WP_Ajax_UnitTestCase;
use Eunit\Traits\{
	Hooks, Remote_Request
};
use Eunit\Helpers\Globals;
use WPAjaxDieContinueException;
use WPAjaxDieStopException;

/**
 * Class Ajax_Test
 */
abstract class Ajax_Test extends WP_Ajax_UnitTestCase {
	use Hooks, Remote_Request;

	/**
	 * setup
	 */
	public function setup(): void {
		parent::setup();
	}

	/**
	 * trigger_ajax
	 *
	 * @param string $action
	 * @param array $super_globals
	 *
	 * @return array
	 */
	public function trigger_ajax( string $action = '', array $super_globals = [] ) : array {
		$this->_last_response = '';
		$exceptions = [];
		foreach ( $super_globals as $super_global => $args ) {
			Globals::set_global_vars( $super_global, $args );
		}
		try {
			$this->_handleAjax( $action );
		} catch ( WPAjaxDieStopException $es ) {
			$exceptions[] = $es->getMessage();
		} catch ( WPAjaxDieContinueException $ec ) {
			$exceptions[] = $ec->getMessage();
		} catch ( Exception $e ) {
			$exceptions[] = $e->getMessage();
		}
		foreach ( $super_globals as $super_global => $args ) {
			Globals::clear_global_vars( $super_global, $args );
		}
		return [
			'response' => $this->_last_response,
			'exceptions' => $exceptions,
		];
	}
}
