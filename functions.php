<?php
namespace Apiki\Theme;

// Avoid that files are directly loaded
if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

class App
{
	const TEXTDOMAIN = 'blanktheme';

	public static function uses( $class_name, $location )
	{
		$locations = array(
			'Controller',
			'View',
			'Helper',
			'Widget',
			'Vendor',
		);

		$extension = 'php';

		if ( in_array( $location, $locations ) )
			$extension = strtolower( $location ) . '.php';

		include "includes/{$location}/{$class_name}.{$extension}";
	}
}

App::uses( 'core', 'config' );

$core = new Core();