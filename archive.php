<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, SSXTHEME
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>

    <!-- blog-bar-->
    <div class="blog-bar"> 
    	<div class="centering">
    
            <!-- start left blog box-->
            <div class="leftBlogBox">
            
            <h1> <?php

            if ( is_day() ) :

                printf( __( 'Daily Archives: %s', 'ssxtheme' ), get_the_date() );


            elseif ( is_month() ) :

                printf( __( 'Monthly Archives: %s', 'ssxtheme' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ssxtheme' ) ) );

            elseif ( is_year() ) :

                printf( __( 'Yearly Archives: %s', 'ssxtheme' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ssxtheme' ) ) );

            else :

                _e( 'Archives', 'ssxtheme' );

            endif;

            ?> </h1>

            <div class="mobilesidebar">

              <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-5') ) : ?>

              <?php endif; ?>

            </div>

            <?php if ( have_posts() ) : ?>

            <?php while ( have_posts() ) : the_post(); ?>

            <?php get_template_part( 'content', get_post_format() ); ?>

            <?php  endwhile; ?>

            <?php wp_pagenavi(); ?>

            <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

            <?php endif; ?>

          </div>
            <!-- end left blog box--> 
            
            <!-- start right blog box-->
            <div class="rightBlogBox">
              <div class="desktopsidebar" >
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-1') ) : ?>
                <?php endif; ?>
              </div>
            </div>
            <!-- end right blog box--> 
            
        </div>
    </div>
    <!-- blog-bar-->

<?php get_footer(); ?>