<?php
use Apiki\Theme\App;
use Apiki\Theme\Utils;

add_action( 'init', 'register_options_pages' );

function register_options_pages() {

	if ( is_admin() && function_exists( 'ot_register_settings' ) ) {

		ot_register_settings(
			array(
				array(
					'id'    => ot_options_id(),
					'pages' => array(
						array(
							'id'			  => 'theme_options',
							'parent_slug'	  => 'themes.php',
							'page_title'	  => __( 'Theme Options', App::TEXTDOMAIN ),
							'menu_title'	  => __( 'Theme Options', App::TEXTDOMAIN ),
							'capability'	  => 'edit_theme_options',
							'menu_slug'	      => 'theme-options',
							'updated_message' => __( 'Options updated.', App::TEXTDOMAIN ),
							'reset_message'   => __( 'Options reseted.', App::TEXTDOMAIN ),
							'button_text'	  => __( 'Save Changes', App::TEXTDOMAIN ),
							'show_buttons'	  => true,
							'sections'		  => array(
								array(
									'id'    => 'forms',
									'title' => __( 'Forms', App::TEXTDOMAIN )
								),
								array(
									'id'    => 'social-links',
									'title' => __( 'Social Links', App::TEXTDOMAIN )
								),
							),
							'settings' => array(
								array(
									'id'	  => 'newsletter',
									'label'	  => __( 'Newsletter', App::TEXTDOMAIN ),
									'desc'	  => __( 'Select a form', App::TEXTDOMAIN ),
									'type'    => 'gravityforms-form',
									'section' => 'forms',
								),
								array(
									'id'	  => 'social-links',
									'label'	  => __( 'Social Links', App::TEXTDOMAIN ),
									'desc'	  => __( 'Create and organize your social links', App::TEXTDOMAIN ),
									'type'    => 'list-item',
									'section' => 'social-links',
									'choices'	=> array(),
									'settings'	=> array(
										array(
											'id'		=> 'social-icon',
											'label'		=> __( 'Icon Name', App::TEXTDOMAIN ),
											'desc'		=> __( 'Ghost icon names', App::TEXTDOMAIN ) . ' [<a href="'.Utils::get_template_url().'/ghost/icons" target="_blank"><strong>'.__( 'View all', App::TEXTDOMAIN ).'</strong></a>]',
											'std'		=> 'icon-',
											'type'		=> 'text',
											'choices'	=> array()
										),
										array(
											'id'		=> 'social-link',
											'label'		=> 'Link',
											'desc'		=> __( 'Enter the full url for your icon button', App::TEXTDOMAIN ),
											'std'		=> 'http://',
											'type'		=> 'text',
											'choices'	=> array()
										),
										array(
											'id'		=> 'social-target',
											'label'		=> __( 'Link Options', App::TEXTDOMAIN ),
											'desc'		=> '',
											'std'		=> '',
											'type'		=> 'checkbox',
											'choices'	=> array(
												array(
													'value' => '_blank',
													'label' => __( 'Open in new window', App::TEXTDOMAIN )
												)
											)
										)
									),
								),
							)
						)
					)
				)
			)
		);
	}

}

add_filter( 'ot_list_item_title_label', 'filter_list_item_title_label' );

function filter_list_item_title_label() {
	return __( 'Title', App::TEXTDOMAIN );
}