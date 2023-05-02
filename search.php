<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>

    <!-- blog-bar-->
    <div class="blog-bar"> 
    	<div class="centering">
    
            <div class="head"><h1><?php printf( __( 'Search Results for: %s', 'ssxtheme' ), get_search_query() ); ?></h1></div>

            <!-- start left blog box-->
            <div class="leftBlogBox">
    
                  <?php if ( have_posts() ) : ?>
    
                  <?php while ( have_posts() ) : the_post(); ?>
    
                  <?php get_template_part( 'content', get_post_format() ); ?>
    
                  <?php endwhile; ?>
    
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