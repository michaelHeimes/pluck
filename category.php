<?php
/**
 * The template for displaying Category pages.
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
                
                 <h1><?php  echo single_cat_title( '', false); ?></h1>
                
                <div class="mobilesidebar" >
            
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-5') ) : ?>
                    <?php endif; ?>
            
                 </div>
          
            
              <?php if ( have_posts() ) : ?>
              <?php while ( have_posts() ) : the_post(); ?>
              <?php get_template_part( 'content', get_post_format() ); ?>
              <?php 
	
	  endwhile; ?>
              <?php wp_pagenavi(); ?>
              <?php else : ?>
              <?php get_template_part( 'content', 'none' ); ?>
              <?php endif; ?>
            </div>
            <!-- end left blog box--> 
            
            <!-- start right blog box-->
            <div class="rightBlogBox">
                  <div class="desktopsidebar" >
						<?php if 
                            ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("sidebar-1") ) : ?>
                        <?php endif; ?>
                  </div>
                </div>
            <!-- end right blog box--> 
            
        </div>
    </div>
    <!-- blog-bar-->

<?php get_footer(); ?>