<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>
	
    <!--page_banner_sec-->
		<?php  $default_banner = get_field('default_banner','option') ?>
        
        <?php if(is_home()) {
            $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_option('page_for_posts')),'full');
            $featured_image = $img[0];
        }?>
        
        <?php if($img) {?>
            <div class="inner_banner_bar" style="background-image: url( <?php echo $featured_image ?> );">
            	<div class="centering">
                	<h1>News</h1>
                </div>
            </div>
        <?php } else {?>
            <div class="inner_banner_bar default" style="background-image: url(	<?php echo $default_banner; ?>)">
            	<div class="centering">
                	<h1>News</h1>
                </div>
            </div>
        <?php }?>
    <!--page_banner_sec-->
    
	<!--recent news-->
	<div class="recent_news news_page">
    	<div class="centering">

			<?php echo do_shortcode('[ajax_load_more post_type="post" posts_per_page="4" scroll="false" button_label="Load More News"]');?>
        
        
        
        
        
        </div>
    </div>
	<!--recent news-->

<?php get_footer(); ?>