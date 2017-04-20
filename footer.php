<?php

if ( ! function_exists( 'add_action' ) ) {
	exit( 0 );
}
?>
	<ul class="navigation navigation-bar">
		<li>
			<img src="<?php echo get_template_directory_uri(); ?>/ghost/assets/images/realthors.svg" width="45" />
		</li>
		<li class="hamburger-wrapper"><span class="btn-menu"></span></li>
		<li><i class="icon-g-search"></i></li>
	</ul>

	<?php wp_footer(); ?>
</body>
</html>
