# Unit Test

`Eunit\Cases\Unit_Test` class is the base test suite class which most Eunit implemented test cases extend it.
Any Test case you write should extend this class ( unless you need a more specific test case ).

!> This is subject to change


### Example class to test
```php
<?php
namespace ElementorMainNameSpace\Modules\MyTestModule\Classes;
/**
 * Class Login_Redirect
 */
class Login_Redirect {
	/**
	 * login_redirect
	 * This method redirects administrator to admin_url on login
	 *
	 * @param string $redirect_to               The redirect destination URL.
	 * @param string $requested_redirect_to     The requested redirect destination URL passed as a parameter.
	 * @param WP_User|WP_Error $user            WP_User object if login was successful, WP_Error object otherwise.
	 */
	public function login_redirect( string $redirect_to, string $requested_redirect_to, $user ) : string {
		// do we have a user?
		if ( ! isset( $user->roles ) || ! is_array( $user->roles ) ) {
			return $redirect_to;
		}
		// is this user an administrator ?
		if ( ! in_array( 'administrator', $user->roles ) ) {
			return $redirect_to;
		}
		// if we got this far then the user is an administrator so
		// lets redirect him to wp-admin
		return admin_url();
	}

	/**
	 * Login_Redirect constructor.
	 */
	public function __construct() {
		add_action( 'login_redirect', [ $this, 'login_redirect' ], 10, 3 );
	}
}
```

Let's test this module by extending `Eunit\Cases\Unit_Test` and start testing by creating an instance of the tested class:
```php
class Login_Redirect_Test extends Eunit\Cases\Unit_Test {
    public function setup () {
        parent::setup();
        $this->login_redirect = new \ElementorMainNameSpace\Modules\MyTestModule\Classes\Login_Redirect();
    }

    public function tearDown() {
        // reset user state 
        wp_set_current_user( 0 );
        // and cleanup
        $this->login_redirect = null;
    }
}
```

Now we can start testing the `login_redirect` method.

First we test that the same url is returned if no user was found or the roles list is in an invalid form:
```php
class Login_Redirect_Test extends Eunit\Cases\Unit_Test {
    ...
    /**
	 * test_login_redirect
	 * @covers Login_Redirect::login_redirect
	 */
    public function test_login_redirect() {
        $expected = 'https://some_url_which_should_be_returned.com';
	    $this->assertSame( $expected, apply_filters( 'login_redirect', $expected, null, new WP_Error() ),
		    ' Test login redirect url is not changed if user is not found'
	    );
    }
}
```

Next we want to test that the same url is returned if the user is not an administrator, so we setup a non-administrator user which is available for us in the class:

```php
class Login_Redirect_Test extends Eunit\Cases\Unit_Test {
    ...
    /**
	 * test_login_redirect
	 * @covers Login_Redirect::login_redirect
	 */
    public function test_login_redirect() {
        $expected = 'https://some_url_which_should be returned.com';
		$this->assertSame( $expected, apply_filters( 'login_redirect', $expected, null, new WP_Error() ),
			'Test login redirect url is not changed if user is not found'
		);

		$this->assertSame( $expected, apply_filters( 'login_redirect', $expected, null, get_user_by( 'ID', $this->subscriber ) ),
			'Test login redirect url is not changed if user is not an administrator'
		);
    }
}
```

And last we need to test that if the user is an administrator, he is redirected to 'wp-admin':
```php
class Login_Redirect_Test extends Eunit\Cases\Unit_Test {
    ...
    /**
	 * test_login_redirect
	 * @covers Login_Redirect::login_redirect
	 */
    public function test_login_redirect() {
        $expected = 'https://some_url_which_should be returned.com';
		$this->assertSame( $expected, apply_filters( 'login_redirect', $expected, null, new WP_Error() ),
			'Test login redirect url is not changed if user is not found'
		);

		$this->assertSame( $expected, apply_filters( 'login_redirect', $expected, null, get_user_by( 'ID', $this->subscriber ) ),
			'Test login redirect url is not changed if user is not an administrator'
		);

		$this->assertSame( admin_url(), apply_filters( 'login_redirect', 'not admin_url', null, get_user_by( 'ID', $this->administrator ) ),
			'Test login redirect url is changed if user is an administrator'
		);
    }
}
```

You can see that extending the `Unit_Test` class provides us a quick access to users with specific roles
