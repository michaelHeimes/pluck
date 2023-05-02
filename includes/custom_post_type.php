<?php

#add_action( 'init', 'registerposttype');
function registerposttype() {
	   /* ***Register Post Type** */
		$post_type_name="event";
		$label_name="Events";
		$singular_name="Event";
		$supports=array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments');
		$labels=array();
		$labels = array(
		'name'               => _x( $label_name, 'post type general name', 'ssxtheme' ),
		'singular_name'      => _x( $singular_name, 'post type singular name', 'your-plugin-textdomain' ),
		'menu_name'          => _x( $label_name, 'admin menu', 'your-plugin-textdomain' ),
		'name_admin_bar'     => _x( $singular_name, 'add new on admin bar', 'your-plugin-textdomain' ),
		'add_new'            => _x( 'Add New', $post_type_name, 'your-plugin-textdomain' ),
		'add_new_item'       => __( 'Add New '.$singular_name, 'your-plugin-textdomain' ),
		'new_item'           => __( 'New '.$singular_name, 'your-plugin-textdomain' ),
		'edit_item'          => __( 'Edit '.$singular_name, 'your-plugin-textdomain' ),
		'view_item'          => __( 'View '.$singular_name, 'your-plugin-textdomain' ),
		'all_items'          => __( 'All '.$label_name, 'your-plugin-textdomain' ),
		'search_items'       => __( 'Search '.$label_name, 'your-plugin-textdomain' ),
		'parent_item_colon'  => __( 'Parent :'.$label_name, 'your-plugin-textdomain' ),
		'not_found'          => __( "No $label_name found.", 'your-plugin-textdomain' ),
		'not_found_in_trash' => __( "No $label_name found in Trash.", 'your-plugin-textdomain' )
	);
		$args=array();	
		$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => $post_type_name),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           =>$supports 
	);
		register_post_type( $post_type_name, $args );
		 
	
	/* ***End Register Post Type** */
	
	
	
	/* ***Register Taxonomy** */
		$post_type_slug="event";
		$label_name="Event Categories";
		$singular_name="Event category";
		$register_taxonomy_slug="event_category";
		$hierarchical=$value['hierarchical'];
		$labels=array();
		$labels = array(
		'name'              => _x( $label_name, 'taxonomy general name' ),
		'singular_name'     => _x( $singular_name, 'taxonomy singular name' ),
		'search_items'      => __( "Search $label_name" ),
		'all_items'         => __( "All $label_name" ),
		'parent_item'       => __( "Parent $singular_name" ),
		'parent_item_colon' => __( "Parent $singular_name:" ),
		'edit_item'         => __( "Edit $singular_name" ),
		'update_item'       => __( "Update $singular_name" ),
		'add_new_item'      => __( "Add New $singular_name" ),
		'new_item_name'     => __( "New $singular_name" ),
		'menu_name'         => __( "$singular_name" ),
	);
		$args = array(
		'hierarchical'      => $hierarchical,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => $rewrite,
	);


		 register_taxonomy( $register_taxonomy_slug, array($post_type_slug), $args );
	
	
	/* ***End Register Taxonomy** */
	
	
}	
#include "metabox.php";	
	
?>