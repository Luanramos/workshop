<?php
// Avoid that files are directly loaded
if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

get_header();
?>

<?php get_sidebar(); ?>
<!-- Put the html code for index here -->

<?php get_footer(); ?>