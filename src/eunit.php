<?php

namespace Eunit;

/**
 * Class Eunit
 */
class Eunit {
	/**
	 * Instance
	 *
	 * @access private
	 * @static
	 *
	 * @var Eunit $instance
	 */
	private static $instance = null;

	/**
	 * @var string
	 */
	public $dir = '';

	/**
	 * @var Autoloader
	 */
	private $autoloader;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @access public
	 *
	 * @return Eunit instance of the class.
	 */
	public static function instance() : ?Eunit {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		$this->setup();
		$this->autoloader = new Autoloader();
	}

	private function setup() {
		putenv( sprintf( 'EUNIT__DIR=%s', dirname( __FILE__ ) ) . '/' );
		$this->dir = getenv( 'EUNIT__DIR' );
	}
}

Eunit::instance();
