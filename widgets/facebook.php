<?php
// Avoid that files are directly loaded
if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

$title    = $this->get_property( $instance, 'title', 'Facebook' );
$title    = apply_filters( 'widget_title', $title );
$page_url = $this->get_property( $instance, 'page_url' );
$width    = $this->get_property( $instance, 'width', 300 );

if ( empty( $page_url ) ) :
	return;
endif;

printf( $args['before_widget'] );

printf( $args['before_title'] . $title . $args['after_title'] );
?>
	<div class="fb-page"
		data-href="<?php echo esc_url( $page_url ); ?>"
		data-width="<?php echo intval( $width ); ?>"
		data-small-header="true"
		data-adapt-container-width="true"
		data-hide-cover="false"
		data-show-facepile="true"
		data-show-posts="true">
	</div>
<?php
	printf( $args['after_widget'] );
?>