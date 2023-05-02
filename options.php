<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
	
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {
	
	
	$options_categories = array();
	$options_categories_obj = get_categories();
	$options_categories[''] = 'Select a category:';
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
		//print_r($options_pages_obj);
	foreach ($options_pages_obj as $page) {
	
		
		$options_pages[$page->ID] = $page->post_title;
	}
	//print_r($options_pages);
	
	
	
	$sliders = array();
	$options_slider_obj = array("fade","scrollHorz","fadeout","scrollUp","shuffle-left","toss");
	$sliders[''] = 'Select a effect:';
	
	foreach ($options_slider_obj as $val) {
		 
		$sliders[$val] = $val;
	}
	
	
	// Background Defaults
	$background_defaults = array(
		'color' => '#000000',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll');		
		
	// Header Typography Defaults
	$header_typography_defaults = array(
		'size' => '87px',
		'face' => 'Bebas_Neue_400.font.js',
		'color' => '#0d9cd9' );			
		
	
			
	// Typography Defaults
	$typography_defaults = array(
		'size' => '28px',
		'face' => 'Bebas_Neue_400.font.js',
		'color' => '#ffffff' );			
		

			
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';
	
	$options = array();

        /**********Body content typography**********/
	
	$options[] = array(
		'name' => 'General Options',
		'type' => 'heading');

        $options[] = array(
		'name' => 'Header Logo',
		'desc' => '',
		'id' => 'site_logo',
		'type' => 'upload');
	return $options;
}
?>
