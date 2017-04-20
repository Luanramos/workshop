<?php

if ( ! function_exists( 'add_action' ) ) {
	exit( 0 );
}

if ( ! class_exists( 'GB\API\Core' ) ) {
	return;
}

use PL\Theme\Core;

include 'vendor/autoload.php';

new Core();
