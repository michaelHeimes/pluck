<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>

    <div class="content-bar">
        <div class="centering">

            <h1 class="page-title"><?php _e( 'Not found', 'ssxtheme' ); ?></h1>

            <h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'ssxtheme' ); ?></h2>
            <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'ssxtheme' ); ?></p>

        </div>
    </div>

<?php get_footer(); ?>