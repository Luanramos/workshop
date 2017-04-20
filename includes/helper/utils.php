<?php
/**
 * Helper Utils
 *
 * @package Apiki Theme
 * @subpackage Utils
 * @since 1.0
 */
namespace Apiki\Theme;

// Avoid that files are directly loaded
if ( ! function_exists( 'add_action' ) ) :
	exit(0);
endif;

class Utils
{
	private static $template_url;
	private static $template_directory;
	private static $site_url;
	private static $site_name;

	public static function get_template_url()
	{
		if ( ! isset( self::$template_url ) ) :
			self::$template_url = get_stylesheet_directory_uri();
		endif;

		return self::$template_url;
	}

	public static function get_template_directory()
	{
		if ( ! isset( self::$template_directory ) ) :
			self::$template_directory = get_stylesheet_directory();
		endif;

		return self::$template_directory;
	}

	public static function get_site_url()
	{
		if ( ! isset( self::$site_url ) ) :
			self::$site_url = get_site_url();
		endif;

		return self::$site_url;
	}

	public static function get_site_name()
	{
		if ( ! isset( self::$site_name ) ) :
			self::$site_name = get_bloginfo();
		endif;

		return self::$site_name;
	}

    public static function enqueue_scripts( $dependencies = array(), $global_vars = array() )
    {
		$dependencies = self::_get_scripts_dependencies( $dependencies );
		$global_vars  = self::_get_scripts_global_vars( $global_vars );

		wp_enqueue_script(
			'apiki-theme-script',
			self::get_template_url() . '/assets/javascripts/built.js',
			$dependencies,
			filemtime( self::get_template_directory() . '/assets/javascripts/built.js' ),
			true
		);

		wp_localize_script(
			'apiki-theme-script',
			'SiteGlobalVars',
			$global_vars
		);
    }

    public static function register_required_plugins( $additional_plugins )
    {
    	if ( ! function_exists( 'tgmpa' ) ) :
    		return;
    	endif;

		$defaults = array(
			array(
				'name'               => 'Apiki WP API',
				'slug'               => 'apiki-wp-api',
				'source'             => plugins_url(),
				'required'           => true,
				'version'            => '1.0.0',
				'force_activation'   => false,
				'force_deactivation' => false,
			)
		);

		$plugins = wp_parse_args( $additional_plugins, $defaults );

		tgmpa( $plugins );
    }

    public static function avoid_gform_confirmation_anchor()
    {
    	add_filter( 'gform_confirmation_anchor', '__return_false' );
    }

	public static function create_template_pages()
    {
    	$templates = get_page_templates();

    	foreach ( $templates as $page_name => $page_template ) :
    		$page_id = self::maybe_create_page( $page_name );
    		update_post_meta( $page_id, '_wp_page_template', $page_template );
		endforeach;
    }

	public static function maybe_create_page( $post_name, $postdata = array() )
	{
		$defaults = array(
			'post_status' => 'publish',
			'post_type'   => 'page',
			'post_title'  => isset( $postdata['title'] ) ? $postdata['title'] : $post_name,
			'post_name'   => $post_name,
		);
		$args = wp_parse_args( $postdata, $defaults );

		$obj_page = get_page_by_path( $post_name );

		if ( ! empty( $obj_page ) ) :
			return $obj_page->ID;
		endif;

		$new_page = wp_insert_post( $args );

		if ( is_wp_error( $new_page ) ) :
			return false;
		endif;

		return $new_page;
	}

    public static function the_stylesheet_uri()
    {
    	echo get_stylesheet_uri() . '?v=' . filemtime( self::get_template_directory() . '/style.css' );
    }

    public static function define_content_width( $width )
    {
    	global $content_width;

		if ( !isset( $content_width ) ) :
			$content_width = $width;
		endif;
    }

    public static function define_class_to_empty_menu_item( $classes, $item, $menu )
    {
    	if ( $item->url != '' ) :
			return $classes;
		endif;

		$classes[] = 'nohref';

		return $classes;
    }

	public static function load_child_theme_textdomain( $text_domain )
	{
		load_child_theme_textdomain( $text_domain, self::get_template_directory() . '/languages' );
	}

	public static function get_found_posts( $single = false, $plural = false, $empty = false )
	{
		global $wp_query;

		$found = $wp_query->found_posts;

		if ( ! $found )
			return $empty;

		if ( $found == 1 )
			return "{$found} {$single}";

		return "{$found} {$plural}";
	}

	public static function pagination( $obj_query = null, $args = array() )
	{
		global $wp_query;

		if ( is_null( $obj_query ) )
			$obj_query = $wp_query;

		$total_pages  = $obj_query->max_num_pages;
		$current_page = get_query_var( 'paged' );
		$big          = 999999999;

		if ( $total_pages == 1 )
			return;

		$defaults = array(
			'base'      => str_replace( $big, '%#%', get_pagenum_link( $big ) ), // need an unlikely integer cause the url can contains a number
			'format'    => '?paged=%#%',
			'current'   => max( 1, $current_page ),
			'total'     => $total_pages,
			'prev_next' => true,
			'end_size'  => 1,
			'mid_size'  => 2,
			'type'      => 'list',
		);

		echo paginate_links( wp_parse_args( $args, $defaults ) );
	}

    private static function _get_scripts_dependencies( $dependencies )
    {
		$defaults = array( 'jquery' );
		$new      = array_merge( $defaults, $dependencies );

    	return array_unique( $new );
    }

    private static function _get_scripts_global_vars( $global_vars )
    {
    	$defaults = array(
			'urlAjax'     => admin_url( 'admin-ajax.php' ),
			'urlTemplate' => self::get_template_url(),
		);

		return wp_parse_args( $global_vars, $defaults );
    }
}
