<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage SSX_THEME
 * @since SSXTHEME 1.0
 */

get_header(); ?>

        <div class="inner_banner_bar default" style="background-image:url(<?php the_field('default_banner','option'); ?>);">
        </div>
    
    <!--about_bar-->
    <div class="about_bar">
        <div class="centering">
        
            <div class="flex-row">
                <div class="left_side">
                     <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; endif;?>
                </div>                
    
                <div class="right_side">
                    <!--avatar image-->
                    <?php if( !empty( get_field('photo') ) ) {
                        $imgID = get_field('photo')['ID'];
                        $img_alt = trim( strip_tags( get_post_meta( $imgID, '_wp_attachment_image_alt', true ) ) );
                        $img = wp_get_attachment_image( $imgID, 'full', false, [ "class" => "avatar", "alt"=>$img_alt] );
                        echo '<div class="photo-wrap">';
                        echo $img;
                        echo '</div>';
                        
                    }?>
                    <!--avatar image-->
                    
                    <?php if( have_rows('about_sidebar_list') ): ?>
                        <ul class="sidebar">
                    <?php while( have_rows('about_sidebar_list') ): the_row(); ?>
                        
                        <!--short_info-->
                        <?php if( get_row_layout() == 'short_info' ): ?>
                            <li class="info_block">
                                <?php if(get_sub_field('name')) {?>
                                    <h3><?php the_sub_field('name')?></h3>
                                <?php }?>
    
                                <?php if(get_sub_field('description')) {?>
                                    <span class="desc"><?php the_sub_field('description')?></span>
                                <?php }?>
                                
                                <?php if(have_rows('social_list')) : ?>
                                    <ul class="social_list">
                                    <?php while(have_rows('social_list')) : the_row(); 
                                    //vars
                                    $icon = get_sub_field('icon');
                                    $link = get_sub_field('link');
                                    ?>
                                        <li>
                                            <a href="<?php echo $link; ?>" target="_blank"><?php echo $icon; ?></a>
                                        </li>
                                    <?php endwhile; ?>
                                    </ul>
                                <?php endif; ?>
                                
                            </li>
                
                        <!--other_info_list-->
                        <?php elseif( get_row_layout() == 'other_info' ):?>
                            
                                <?php if(have_rows('other_info_list')) : ?>
                                        <?php while(have_rows('other_info_list')) : the_row(); 
                                        //vars
                                        $list_title = get_sub_field('list_title');
                                        ?>
                                        <li class="info_block">
                                            <h6><?php echo $list_title; ?></h6>
                                        
                                            <?php if(have_rows('list_content')) : ?>
                                                <ul class="info_list">
                                                <?php while(have_rows('list_content')) : the_row(); 
                                                //vars
                                                $list_item = get_sub_field('list_item');
                                                ?>
                                                    <li><?php echo $list_item; ?></li>
                                                <?php endwhile; ?>
                                                </ul>
                                            <?php endif; ?>
    
                                        </li>
                                        <?php endwhile; ?>
                                <?php endif; ?>
    
    
                            </li>
                            
                        <?php ?>
    
                        <?php endif; ?>
                    <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
    
                </div>                
            </div>
        
        </div>    
    </div>
    <!--about_bar-->
    
    <!--cta_bar-->
    <div class="flex-row v-center cta_bar" style="background-image: url('<?php the_field('cta_banner','option')?>')">
        <div class="centering">
            
            <?php the_field('cta_content','option'); ?>
            <?php $cta_button = get_field('cta_banner_button','option'); ?>
            <a href="<?php echo $cta_button['url']?>" class="btn">Button</a>
        
        </div>
    </div>
    <!--cta_bar-->

<?php get_footer(); ?>