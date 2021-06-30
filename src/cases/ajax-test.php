<?php
namespace Eunit\Cases;

use Exception;
use WP_Ajax_UnitTestCase;
use Eunit\Traits\{
	Globals, Hooks, Remote_Request
};
use WPAjaxDieContinueException;
use WPAjaxDieStopException;

/**
 * Class Ajax_Test
 */
class Ajax_Test extends WP_Ajax_UnitTestCase {
	use Globals, Hooks, Remote_Request;

	/**
	 * setup
	 */
	public function setup() {
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
			$this->set_global_vars( $super_global, $args );
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
			$this->clear_global_vars( $super_global, $args );
		}
		return [
			'response' => $this->_last_response,
			'exceptions' => $exceptions,
		];
	}
}
