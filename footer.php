<?php
// Avoid that files are directly loaded
if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

use Apiki\Theme\Menu;

	wp_nav_menu(
		array(
			'theme_location' => Menu::FOOTER,
			'container'      => '',
			'menu_class'     => 'menu',
			'fallback_cb'    => '',
		)
	);

	wp_footer();
?>
	</body>
</html>