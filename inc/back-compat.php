<?php
/**
 * SSXTHEME back compat functionality.
 *
 * Prevents SSXTHEME from running on WordPress versions prior to 3.6,
 * since this theme is not meant to be backwards compatible and relies on
 * many new functions and markup changes introduced in 3.6.
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

/**
 * Prevent switching to SSXTHEME on old versions of WordPress. Switches
 * to the default theme.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'ssxtheme_upgrade_notice' );
}
add_action( 'after_switch_theme', 'ssxtheme_switch_theme' );

/**
 * Prints an update nag after an unsuccessful attempt to switch to
 * SSXTHEME on WordPress versions prior to 3.6.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_upgrade_notice() {
	$message = sprintf( __( 'SSXTHEME requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ssxtheme' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevents the Customizer from being loaded on WordPress versions prior to 3.6.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_customize() {
	wp_die( sprintf( __( 'SSXTHEME requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ssxtheme' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'ssxtheme_customize' );

/**
 * Prevents the Theme Preview from being loaded on WordPress versions prior to 3.4.
 *
 * @since SSXTHEME 1.0
 *
 * @return void
 */
function ssxtheme_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'SSXTHEME requires at least WordPress version 3.6. You are running version %s. Please upgrade and try again.', 'ssxtheme' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'ssxtheme_preview' );