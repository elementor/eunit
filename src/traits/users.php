<?php
namespace Eunit\Traits;

/**
 * Trait Users
 */
trait Users {
	/**
	 * get_plugin
	 * @return mixed
	 */
	public function init_users() : void {
		// Users
		$this->subscriber = $this->factory->user->create( [ 'role' => 'subscriber' ] );
		$this->editor = $this->factory->user->create( [ 'role' => 'editor' ] );
		$this->administrator = $this->factory->user->create( [ 'role' => 'administrator' ] );
	}

	/**
	 * cleanup_users
	 */
	public function cleanup_users() : void {
		\wp_delete_user( $this->subscriber );
		\wp_delete_user( $this->editor );
		\wp_delete_user( $this->administrator );
	}
}
