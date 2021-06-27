# Ajax Test

`Eunit\Cases\Ajax_Test` 

This class should be extended to test ajax handlers, and its the only test case that is not an extending class of `WP_UnitTestCase` but actually `WP_Ajax_UnitTestCase`.


!> This is subject to change

!> !!!! ONLY FOR AJAX CALL !!!!

### Example an ajax handler class
```php
<?php
namespace ElementorMainNameSpace\Modules\MyTestModule\Classes;
/**
 * Class Ajax
 */
class Ajax {
    const AJAX_ACTION = 'my_ajax_action';
    const OPTION_NAME = 'ajax_counter';
    /**
     * Class constructor.
     */
	public function __construct() {
	    add_action( 'wp_ajax_' . self::AJAX_ACTION, [ $this, 'handle_ajax_request' ] );
	}
	
	public function handle_ajax_request() {
	    if ( ! check_ajax_referer( self::AJAX_ACTION, false, false ) ) {
	        wp_send_json_error( [ 
	            'message' => 'Sorry, you are not allowed to do this',
            ], 401 );
	    }
	    update_option( self::OPTION_NAME, ( 1 + (int) get_option( self::OPTION_NAME, 0 ) ) );
	    wp_send_json_success( [ 'message' => 'All good!' ], 200 );
	}
}
```

Let's test this class by extending `Eunit\Cases\Ajax_Test`

```php
class Ajax_Test extends Eunit\Cases\Ajax_Test {
    var $ajax_handler;
	public function setup () {
		parent::setup();
		$this->ajax_handler = new \ElementorMainNameSpace\Modules\MyTestModule\Classes\Ajax();
		// set user to allow user only ajax
		wp_set_current_user( 1 );
	}

	public function tearDown() {
	    // reset user state 
		wp_set_current_user( 0 );
	}
}
```

We now added an instance of the class for quick access and to make sure we are registered wit the ajax action.

?> See Using Traits > Hooks to see how you can assert that actions are registered


Now lets test the actual ajax handler

```php
class Ajax_Test extends Eunit\Cases\Ajax_Test {
    var $ajax_handler;
	public function setup () {
		parent::setup();
		$this->ajax_handler = new \ElementorMainNameSpace\Modules\MyTestModule\Classes\Ajax();
		// set user to allow user only ajax
		wp_set_current_user( 1 );
	}

	public function tearDown() {
	    // reset user state 
		wp_set_current_user( 0 );
	}
	
	public function test_handle_ajax_request() {
	    // Fail on nonce
		$results1 = $this->trigger_ajax( $this->ajax_handler::AJAX_ACTION );
		$response1 = json_decode( $results1['response'] );
		$this->assertFalse( $response1->success,
			'Test ajax fails if nonce validation fails'
		);
		$this->assertEquals( 'Sorry, you are not allowed to do this', $response1->message,
			'Test message is correct on nonce fail'
		);
		
		// No lets pass nonce validation
		$results2 = $this->trigger_ajax( $this->ajax_handler::AJAX_ACTION, [
			'POST' => [
				'_wpnonce' => wp_create_nonce( $this->ajax_handler::AJAX_ACTION ),
			],
		] );
		$response2 = json_decode( $results2['response'] );
		$this->assertTrue( $response2->success,
            'Test response on ajax succeed'
		);
		$this->assertEquals( 'All good!', $response2->message,
			'Test message is correct on success'
		);
	}
}
```

If you look at the above you can see the use of `$this->trigger_ajax` which accepts Ajax action name and an array of super globals to overwrite, and you can see that in the second request, we use it to pass the nonce value in a parameter named `_wpnonce` under the super global $_POST to the Ajax request.

The `trigger_ajax` method returns an array of `response` with the response body, and exceptions in case any were thrown.
