<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Paslaugos.
	 */

	$labels = [
		"name" => __( "Paslaugos", "twentytwenty" ),
		"singular_name" => __( "Paslauga", "twentytwenty" ),
	];

	$args = [
		"label" => __( "Paslaugos", "twentytwenty" ),
		"labels" => $labels,
		"description" => "",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "services_pro", "with_front" => true ],
		"query_var" => true,
		"menu_position" => 5,
		"supports" => [ "title", "editor", "thumbnail" ],
	];

	register_post_type( "services_pro", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Kategorijos (paslaugos).
	 */

	$labels = [
		"name" => __( "Kategorijos (paslaugos)", "twentytwenty" ),
		"singular_name" => __( "Kategorija (paslaugos)", "twentytwenty" ),
	];

	$args = [
		"label" => __( "Kategorijos (paslaugos)", "twentytwenty" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'services_pro_cat', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "services_pro_cat",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
	];
	register_taxonomy( "services_pro_cat", [ "services_pro" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
