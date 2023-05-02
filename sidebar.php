<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div class="right_section">
    <?php dynamic_sidebar( 'sidebar-2' ); ?>
    </div>
<?php endif; ?>