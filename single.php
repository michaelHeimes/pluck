<?php
/**
 * The Template for displaying all single posts.
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
            <div class="leftBlogBox single">
                
                <div class="mobilesidebar" >
            
                    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-5') ) : ?>
                    <?php endif; ?>
            
                 </div>
                  
                  <?php if ( have_posts() ) : ?>
                  <?php while ( have_posts() ) : the_post(); ?>
                  <h1><?php the_title(); ?></h1>
                  <ul class="dateBar">
                    <li><strong>Posted on</strong>
                      <?php the_time('M j, Y'); ?>
                    </li>
                  </ul>
                  <?php 
            if(has_post_thumbnail()){
            $bannerImgUrl = wp_get_attachment_image_src( get_post_thumbnail_id(), 'singleimage' ); ?>
                  <div class="singleimage"> <img src="<?php echo $bannerImgUrl[0] ?>" alt="" width="<?php echo $bannerImgUrl[1] ?>" height="<?php echo $bannerImgUrl[2] ?>"> </div>
                  <?php } ?>
                  <?php the_content(); ?>
                  <?php comments_template(); ?>
                  <?php endwhile; endif; ?>
                </div>
            <!-- end left blog box--> 
            
            <!-- start right blog box-->
            <div class="rightBlogBox">
                <?php if 
                    ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("sidebar-1") ) : ?>
                <?php endif; ?>
            </div>    
            <!-- end right blog box--> 
            
        </div>
    </div>
    <!-- blog-bar-->

<?php get_footer(); ?>