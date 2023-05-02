<?php
/**
 * SSXTHEME functions and definitions.
 *
  */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Adds support for a custom header image.
 */
#require get_template_directory() . '/inc/custom-header.php';

/**
 * SSXTHEME only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Sets up theme defaults and registers the various WordPress features that
  * @return void
 */
function ssxtheme_setup() {
	/*
	 * Makes SSXTHEME available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on SSXTHEME, use a find and
	 * replace to change 'ssxtheme' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'ssxtheme', get_template_directory() . '/languages' );

	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Navigation Menu', 'ssxtheme' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 300, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'ssxtheme_setup' );
/**
 * Enqueues scripts and styles for front end.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_scripts_styles() {
	// Adds JavaScript to pages with the comment form to support sites with
	// threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to SSXTHEME.
	wp_enqueue_script( 'ssxtheme-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), date('Y-m-d'), true );
	wp_enqueue_script( 'Custom Js', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), date('Y-m-d'), true );
	wp_enqueue_script( 'slick Js', get_template_directory_uri() . '/js/slick.js', array( 'jquery' ), date('Y-m-d'), true );
	wp_enqueue_script( 'tab Js', get_template_directory_uri() . '/js/easy-responsive-tabs.js', array( 'jquery' ), date('Y-m-d'), true );

	// Loads our main stylesheet.
	wp_enqueue_style( 'ssxtheme-style', get_stylesheet_uri(), array(), date('Y-m-d') );
	wp_enqueue_style( 'responsive-css', get_template_directory_uri()."/css/responsive.css", array(), date('Y-m-d') );
	wp_enqueue_style( 'tab-css', get_template_directory_uri()."/css/easy-responsive-tabs.css", array(), date('Y-m-d') );
	wp_enqueue_style( 'slick-css', get_template_directory_uri()."/css/slick.css", array(), date('Y-m-d') );
	wp_enqueue_style( 'icon-css', get_template_directory_uri()."/icons/icons.css", array(), date('Y-m-d') );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'ssxtheme-ie', get_template_directory_uri() . '/css/ie.css', array( 'ssxtheme-style' ), date('Y-m-d') );
	wp_style_add_data( 'ssxtheme-ie', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'ssxtheme_scripts_styles' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since SSXTHEME 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function ssxtheme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'ssxtheme' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'ssxtheme_wp_title', 10, 2 );

/**
 * Registers two widget areas.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'ssxtheme' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'ssxtheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Mobile Blog Sidebar', 'ssxtheme' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Appears in the footer section of the site.', 'ssxtheme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'ssxtheme_widgets_init' );

if ( ! function_exists( 'ssxtheme_paging_nav' ) ) :
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'ssxtheme' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'ssxtheme' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'ssxtheme' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'ssxtheme_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
*
* @since SSXTHEME 1.0
*
* @return void
*/
function ssxtheme_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'ssxtheme' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'ssxtheme' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'ssxtheme' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'ssxtheme_entry_meta' ) ) :
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own ssxtheme_entry_meta() to override in a child theme.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . __( 'Sticky', 'ssxtheme' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		ssxtheme_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'ssxtheme' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'ssxtheme' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'ssxtheme' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'ssxtheme_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own ssxtheme_entry_date() to override in a child theme.
 *
 * @since SSXTHEME 1.0
 *
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function ssxtheme_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'ssxtheme' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'ssxtheme' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'ssxtheme_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'ssxtheme_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since SSXTHEME 1.0
 *
 * @return string The Link format URL.
 */
function ssxtheme_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Extends the default WordPress body classes.
 */
function ssxtheme_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'ssxtheme_body_class' );

/**
 * Binds JavaScript handlers to make Customizer preview reload changes
 * asynchronously.
 *
 * @since SSXTHEME 1.0
 */
function ssxtheme_customize_preview_js() {
	wp_enqueue_script( 'ssxtheme-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}
add_action( 'customize_preview_init', 'ssxtheme_customize_preview_js' );

//remove_filter ('the_content', 'wpautop');



/* Read  More Filter  */
function new_excerpt_more( $more ) {
	return ' ';
}
add_filter('excerpt_more', 'new_excerpt_more');
function the_excerpt_filter($output) {
 global $post;
 $output .=' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More...', 'ssxtheme') . '</a>';
 $output=wpautop($output);
 return $output;
}
add_filter('the_excerpt', 'the_excerpt_filter');


add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
return '<a class="more-link" href="' . get_permalink() . '">Read More...</a>';
}

/* */
include_once "includes/custom.php";

//Theme option file include
if ( !function_exists( 'optionsframework_init' ) ) {
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/theme_inc/' );
	require_once dirname( __FILE__ ) . '/theme_inc/options-framework.php';
}

function new_excerpt_length($length) {
	return 5;
}
//add_filter('excerpt_length', 'new_excerpt_length');



if( function_exists('acf_add_options_page') ) {	
acf_add_options_page(array(
	'page_title'     => 'Theme Option',
	'menu_title'    => 'Theme Option',
	'menu_slug'     => 'theme-general-settings',
	'capability'    => 'edit_posts',
	'redirect'        => false
 ));
}



function create_posttype() {
register_post_type('solutions', 
 array(
        'label' => __('Solutions'),
        'supports' => array( 'title', 'editor', 'thumbnail', 'revisions' ),
        'menu_icon' => 'dashicons-admin-tools',
		'show_ui' => true,
  'public' => true,
  'has_archive' => false,
  'rewrite' => array('slug' => 'solutions'),
  'supports' => array( 'title','editor', 'thumbnail'),
   ));
}
add_action( 'init', 'create_posttype' );


function event_taxonomy() {
    register_taxonomy(
    'solutions-categories',
    'solutions',
    array(
        'hierarchical' => true,
        'label' => 'Solutions Category',
        'query_var' => true,
        'rewrite' => array('slug' => 'solutions-categories')
        )
    );
}
add_action('init', 'event_taxonomy');
