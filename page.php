<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>

    	<?php if(get_the_post_thumbnail_url()) {?>
            <div class="inner_banner_bar" style="background-image:url(<?php the_post_thumbnail_url('full'); ?>);">
            	<div class="centering">
                    <h1><?php if(get_field('banner_heading_icon')) {?><img src="<?php the_field('banner_heading_icon')?>" alt="" /><?php }?><span><?php the_title(); ?></span></h1>
                </div>
            </div>
		<?php } elseif(get_field('banner_background_color')) {?>
        <div class="inner_banner_bar bg_color" style="background-color:<?php the_field('banner_background_color')?>;">
            <div class="centering">
                <h1><?php if(get_field('banner_heading_icon')) {?><img src="<?php the_field('banner_heading_icon')?>" alt="" /><?php }?><span><?php the_title(); ?></span></h1>
            </div>
        </div>
		<?php } else {?>
            <div class="inner_banner_bar default" style="background-image:url(<?php the_field('default_banner','option'); ?>);">
            	<div class="centering">
                    <h1><?php if(get_field('banner_heading_icon')) {?><img src="<?php the_field('banner_heading_icon')?>" alt="" /><?php }?><span><?php the_title(); ?></span></h1>
                </div>
            </div>
		<?php }?>

        <!--content_bar-->
        <section class="content_bar">
            <div class="centering">
    
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; endif;?>
        

				<?php if( have_rows('default_page_options') ): ?>
                    <?php while( have_rows('default_page_options') ): the_row(); ?>
                        
                
                
                        <!--full content-->
                        <?php if( get_row_layout() == 'full_content' ): ?>
                            
                            <div class="flex-row">
                                <div class="text full">
                                    <?php the_sub_field('full_content'); ?>
                                </div>
                            </div>
                
                
                        <!--two columbn content-->
                        <?php elseif( get_row_layout() == 'two_col_content' ):?>
                            
                            <div class="flex-row">
                                <?php if(get_sub_field('left_content')) {?>
                                    <div class="left">
                                        <div class="text">
                                            <?php the_sub_field('left_content'); ?>
                                        </div>                    
                                    </div>
                                <?php }?>
                
                                <?php if(have_rows('right_list')) : ?>
                                    <div class="right">
                                        <ul class="listing">
                                        <?php while(have_rows('right_list')) : the_row(); 
                                        //vars
                                        $title = get_sub_field('title');
                                        $link = get_sub_field('link');
                                        ?>
                                            <?php if($link) {?>
                                                <li><a href="<?php echo $link;?>"><?php echo $title;?></a></li>                        
                                            <?php } else {?>
                                                <li><?php echo $title;?></li>                        
                                            <?php }?>
                                            
                                        <?php endwhile; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                
                                <?php if(get_sub_field('right_button')) {?>
                                    <div class="right">
                                        <?php $right_button = get_sub_field('right_button'); ?>
                                        <a href="<?php echo $right_button['url']; ?>" target="<?php echo $right_button['target']; ?>" class="button"><?php echo $right_button['title']; ?></a>
                                    </div>
                                <?php }?>
                
                            </div>
                            
                
                        <?php ?>
                
                
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
        
            </div>	
        </section>
        <!--content_bar-->

		<div class="featured_post_bar">
        	<div class="centering">
					<div class="solution_slider">
						<?php
                        $featured_posts = get_field('show_selected_post');
                        if( $featured_posts ): ?>
                            <?php foreach( $featured_posts as $post ): 
                                // Setup this post for WP functions (variable must be named $post).
                                setup_postdata($post); ?>
                                <div class="slides">
                                    
                                    <span class="subtitle"><?php the_field('subhead'); ?></span>
                                    
                                    <h3><?php the_title(); ?></h3>
                                    
                                    <?php if(get_field('read_more_pdf')) {?>
                                        <a target="_blank" href="<?php the_field('read_more_pdf')?>" class="more light"><?php the_field('read_more_title')?></a>
                                    <?php } else {?>
                                        <a target="_blank" href="<?php the_field('read_more_external_link')?>" class="more light"><?php the_field('read_more_title')?></a>
                                    <?php }?>
                                    
                                </div>
                            <?php endforeach; ?>
                            <?php 
                            wp_reset_postdata(); ?>
                        <?php endif; ?>
                </div>
            </div>
        </div>

<?php get_footer(); ?>