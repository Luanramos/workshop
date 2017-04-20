<?php
namespace Apiki\Theme;

// Avoid that files are directly loaded
if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

App::uses( 'autoload', 'vendor' );
App::uses( 'loader', 'config' );
App::uses( 'utils', 'helper' );
App::uses( 'theme-options', 'config' );

App::uses( 'menus', 'Controller' );
App::uses( 'images', 'Controller' );
App::uses( 'supports', 'Controller' );
App::uses( 'sidebars', 'Controller' );

Class Core extends Loader
{
	public function initialize()
	{
		$this->load_controllers(
			array(
				'Menus',
				'Images',
				'Supports'
			)
		);
	}

	public function enqueue_scripts()
	{
		$dependencies = array();
		$global_vars  = array();

		Utils::enqueue_scripts( $dependencies, $global_vars );
	}

	public function register_required_plugins()
	{
		$additional_plugins = array(
			array(
				'name'               => 'WP Awesome Login',
				'slug'               => 'wp-awesome-login',
				'source'             => '',
				'required'           => false,
				'version'            => '0.2.0',
				'force_activation'   => false,
				'force_deactivation' => false,
			)
		);

		Utils::register_required_plugins( $additional_plugins );
	}
}